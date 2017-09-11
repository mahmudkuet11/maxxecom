<?php

namespace App\Service\Order;

use App\Enum\InternalOrderStatus;
use App\Event\StoreSyncProgress;
use App\Models\Order\Invoice;
use App\Models\Order\Order;
use App\Models\Order\Sku;
use App\Models\Order\Transaction;
use App\Models\Store;
use App\Service\eBay\CompleteSaleService;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class OrderService
{
    public function getAll(){
        return new Order();
    }

    public function get($id){
        return Order::where('id', $id);
    }

    public function saveOrders(Store $store, $orders, Callable $callback = null){
        $order_array = $orders->OrderArray->Order;
        foreach ($order_array as $order){
            $order = self::save($store->id, $order);
            if($order && $callback) call_user_func($callback, $order);
        }
        event(new StoreSyncProgress($orders, $store));
    }

    public function save($store_id, $order){
        DB::beginTransaction();
        try{
            $orderModel = Order::updateOrCreate([
                'store_id' =>  $store_id,
                'ebay_order_id'    =>  (string)$order->OrderID,
                'sales_record_no'   =>  (string)$order->ShippingDetails->SellingManagerSalesRecordNumber
            ], [
                'order_status' =>  (string)$order->OrderStatus,
                'adjustment_amount'    =>  (double)$order->AdjustmentAmount,
                'amount_paid'  =>  (double)$order->AmountPaid,
                'amount_saved' =>  (double)$order->AmountSaved,
                'created_time' =>  Carbon::parse($order->CreatedTime)->toDateTimeString(),
                'payment_method'   =>  (string)$order->PaymentMethods,
                'sub_total'    =>  (double)$order->Subtotal,
                'total'    =>  (double)$order->Total,
                'buyer_user_id'    =>  (string)$order->BuyerUserID,
                'paid_time'    =>  $order->PaidTime ? Carbon::parse($order->PaidTime)->toDateTimeString() : null,
                'shipped_time' =>  $order->ShippedTime ? Carbon::parse($order->ShippedTime)->toDateTimeString() : null,
                'payment_hold_status'  =>  (string)$order->PaymentHoldStatus,
                'extended_order_id'    =>  (string)$order->ExtendedOrderID,
                'sales_tax_percent'    =>  (double)$order->ShippingDetails->SalesTax->SalesTaxPercent,
                'sales_tax_state'    =>  (string)$order->ShippingDetails->SalesTax->SalesTaxState,
                'sales_tax_amount'    =>  (double)$order->ShippingDetails->SalesTax->SalesTaxAmount,
            ]);
            $orderModel->checkoutStatus()->updateOrCreate([
                'order_id'  =>  $orderModel->id
            ], [
                'ebay_payment_status'   =>  (string)$order->CheckoutStatus->eBayPaymentStatus,
                'status'    =>  (string)$order->CheckoutStatus->Status
            ]);
            $orderModel->shippingAddress()->updateOrCreate([
                'order_id'  =>  $orderModel->id
            ], [
                'name'  =>  (string)$order->ShippingAddress->Name,
                'street1'   =>  (string)$order->ShippingAddress->Street1,
                'street2'   =>  (string)$order->ShippingAddress->Street2,
                'city_name' =>  (string)$order->ShippingAddress->CityName,
                'state_or_province' =>  (string)$order->ShippingAddress->StateOrProvince,
                'country'   =>  (string)$order->ShippingAddress->Country,
                'country_name'  =>  (string)$order->ShippingAddress->CountryName,
                'phone' =>  (string)$order->ShippingAddress->Phone,
                'postal_code'   =>  (string)$order->ShippingAddress->PostalCode,
                'address_id'    =>  (string)$order->ShippingAddress->AddressID,
                'shipping_service_selected' =>  (string)$order->ShippingServiceSelected->ShippingService,
                'shipping_service_cost' =>  (double)$order->ShippingServiceSelected->ShippingServiceCost,
            ]);
            foreach($order->TransactionArray->Transaction as $transaction){
                $shipmentTrackingDetails = $transaction->ShippingDetails->ShipmentTrackingDetails;
                $tracking_array = [];
                foreach ($shipmentTrackingDetails as $tracking){
                    array_push($tracking_array, [
                        'tracking_no'   =>  (string)$tracking->ShipmentTrackingNumber,
                        'carrier_used'   =>  (string)$tracking->ShippingCarrierUsed,
                    ]);
                }
                $sales_record_no = (string)$transaction->ShippingDetails->SellingManagerSalesRecordNumber;
                self::updateSkuStatusBasedOnTrackingNumber($orderModel, $sales_record_no, $tracking_array);

                $transaction = $orderModel->transactions()->updateOrCreate([
                    'order_id'  =>  $orderModel->id,
                    'sales_record_no'   =>  $sales_record_no
                ], [
                    'buyer_email'   =>  (string)$transaction->Buyer->Email,
                    'buyer_user_first_name' =>  (string)$transaction->Buyer->UserFirstName,
                    'buyer_user_last_name'  =>  (string)$transaction->Buyer->UserLastName,
                    'transaction_created_at'    =>  Carbon::parse($transaction->CreatedDate)->toDateTimeString(),
                    'item_id'   =>  (string)$transaction->Item->ItemID,
                    'site'  =>  (string)$transaction->Item->Item->Site,
                    'item_title'    =>  (string)$transaction->Item->Title,
                    'sku'   =>  (string)$transaction->Item->SKU,
                    'condition' =>  (string)$transaction->Item->ConditionDisplayName,
                    'quantity'  =>  (double)$transaction->QuantityPurchased,
                    'ebay_transaction_id'   =>  (string)$transaction->TransactionID,
                    'transaction_price' =>  (double)$transaction->TransactionPrice,
                    'order_line_item_id'    =>  (string)$transaction->OrderLineItemID,
                    'shipment_tracking_details'  =>  json_encode($tracking_array)
                ]);
                $skus = Sku::parseSkus($transaction->sku);
                foreach ($skus as $sku){
                    $skuModel = Sku::where('transaction_id', $transaction->id)->where('sku', $sku)->first();
                    if($skuModel){
                        Sku::updateSkuStatus($orderModel, $skuModel);
                    }else{
                        Sku::create([
                            'transaction_id'    =>  $transaction->id,
                            'sku'   =>  $sku,
                            'status'    =>  Sku::parseInitilaStatus($orderModel)
                        ]);
                    }
                }
            }
            DB::commit();
            return $orderModel;
        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }

    private function updateSkuStatusBasedOnTrackingNumber(Order $order, $sales_record_no, $new_tracking_array){
        $transaction = $order->transactions()
            ->where('sales_record_no', $sales_record_no)
            ->with('skus')
            ->first();

        if($transaction){
            $tracking_numbers = json_decode($transaction->shipment_tracking_details, true);
            foreach ($new_tracking_array as $new_tracking){
                $found = false;
                foreach ($tracking_numbers as $tracking_number){
                    if(
                        $new_tracking['tracking_no'] == $tracking_number['tracking_no'] &&
                        $new_tracking['carrier_used'] == $tracking_number['carrier_used']
                    ){
                        $found = true;
                        break;
                    }
                }
                if(!$found){
                    $transaction->skus()->where('status', InternalOrderStatus::PRINT_LABEL)->update([
                        'status'    =>  InternalOrderStatus::PAID_AND_SHIPPED
                    ]);
                }
            }
        }
    }

    public function saveTrackingNumber(Request $request){
        $order_id = $request->get('order_id');
        $order_line_item_id = $request->get('order_line_item_id');
        $trackings = $request->get('trackings');
        $order = self::get($order_id)->with('store')->first();
        $store = $order->store;
        $completeSalesService = new CompleteSaleService();

        $response = $completeSalesService->saveTrackingNumber($store, $order, $order_line_item_id, $trackings);
        $msg = '';
        if($response->Ack == 'Success'){
            Transaction::where('order_line_item_id', $order_line_item_id)->update([
                'shipment_tracking_details' =>  json_encode($trackings)
            ]);
        }else{
            $msg = $response->Errors->LongMessage;
        }
        return [
            'status'    =>  $response->Ack == 'Success',
            'msg'   =>  (string)$msg
        ];
    }

    public function saveInvoice(Request $request){
        $sku_id = $request->get('sku_id');
        $store_type = $request->get('store_type');
        $store_name = $request->get('store_name');
        $next_state = $request->get('next_state');
        $sold_price = $request->get('sold_price');
        $product_cost = $request->get('product_cost');
        $shipping_cost = $request->get('shipping_cost');
        $handling_cost = $request->get('handling_cost');
        $fees = $request->get('fees');
        $profit = $request->get('profit');

        DB::beginTransaction();
        try{
            $invoice = Invoice::updateOrCreate([
                'sku_id'   =>  $sku_id,
            ],[
                'store_type'    =>  $store_type,
                'store_name'    =>  $store_name,
                'next_state'    =>  $next_state,
                'sold_price'    =>  $sold_price,
                'product_cost'  =>  $product_cost,
                'shipping_cost' =>  $shipping_cost,
                'handling_cost' =>  $handling_cost,
                'fees'  =>  $fees,
                'profit'    =>  $profit
            ]);
            Sku::where('id', $sku_id)->update([
                'status'    =>  InternalOrderStatus::AWAITING_ORDER
            ]);
            DB::commit();
            return $invoice;
        }catch(\Exception $e){
            DB::rollback();
            return false;
        }
    }

    public function orderSubmit(Request $request){
        $sku_id = $request->get('sku_id');
        $store_type = $request->get('store_type');
        $store_name = $request->get('store_name');
        $next_state = $request->get('next_state');
        $sold_price = $request->get('sold_price');
        $product_cost = $request->get('product_cost');
        $shipping_cost = $request->get('shipping_cost');
        $handling_cost = $request->get('handling_cost');
        $fees = $request->get('fees');
        $profit = $request->get('profit');
        $order_id = $request->get('order_id');
        $msg = $request->get('msg', '');

        DB::beginTransaction();
        try{
            $invoice = Invoice::updateOrCreate([
                'sku_id'   =>  $sku_id,
            ],[
                'store_type'    =>  $store_type,
                'store_name'    =>  $store_name,
                'next_state'    =>  $next_state,
                'sold_price'    =>  $sold_price,
                'product_cost'  =>  $product_cost,
                'shipping_cost' =>  $shipping_cost,
                'handling_cost' =>  $handling_cost,
                'fees'  =>  $fees,
                'profit'    =>  $profit,
                'order_id'    =>  $order_id,
                'message'   =>  $msg
            ]);
            $status = InternalOrderStatus::AWAITING_TRACKING;
            if($next_state == 'print_label'){
                $status = InternalOrderStatus::PRINT_LABEL;
            }
            Sku::where('id', $sku_id)->update([
                'status'    =>  $status
            ]);
            DB::commit();
            return [
                'status'    =>  'success',
                'msg'   =>  'Order submitted successfully!'
            ];
        }catch(\Exception $e){
            DB::rollback();
            return [
                'status'    =>  'failed',
                'msg'   =>  $e->getMessage()
            ];
        }
    }
}