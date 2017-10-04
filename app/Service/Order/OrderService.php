<?php

namespace App\Service\Order;

use App\Enum\InternalOrderStatus;
use App\Enum\TrackingNumberScope;
use App\Event\StoreSyncProgress;
use App\Models\Order\Invoice;
use App\Models\Order\Order;
use App\Models\Order\Sku;
use App\Models\Order\TrackingNumber;
use App\Models\Store;
use App\Service\Console;
use App\Service\eBay\CompleteSaleService;
use App\Service\eBay\GetOrderService;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

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
        $trackingNumberService = new TrackingNumberService();
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

                $trackingNumberService->updateOnSync($tracking_array, $transaction->id);

                $skus = Sku::parseSkus($transaction->sku);
                foreach ($skus as $sku){
                    $skuModel = Sku::where('transaction_id', $transaction->id)->where('sku', $sku)->first();
                    if($skuModel){
                        Sku::updateSkuStatus($orderModel, $skuModel);
                    }else{
                        Sku::create([
                            'transaction_id'    =>  $transaction->id,
                            'sku'   =>  $sku,
                            'status'    =>  Sku::parseInitialStatus($orderModel)
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

    public function saveTrackingNumber(Request $request){
        $sku_id = $request->get('sku_id');
        $trackings = $request->get('trackings');
        $sku = Sku::where('id', $sku_id)->with('tracking_numbers', 'transaction', 'transaction.order', 'transaction.order.store')->first();
        $order = $sku->transaction->order;
        $store = $sku->transaction->order->store;
        $completeSalesService = new CompleteSaleService();

        $response = $completeSalesService->saveTrackingNumber($store, $order, $sku->transaction->order_line_item_id, $trackings);
        $msg = '';
        if($response->Ack == 'Success'){
            foreach ($trackings as $tracking){
                TrackingNumber::updateOrCreate([
                    'scope' =>  TrackingNumberScope::SKU,
                    'reference_id'  =>  $sku_id,
                    'carrier'   =>  $tracking['carrier_used'],
                    'tracking_no'   =>  $tracking['tracking_no'],
                ]);
            }
            if(count($trackings) > 0){
                $sku->update([
                    'status'    =>  InternalOrderStatus::PAID_AND_SHIPPED
                ]);
            }
        }else{
            $msg = $response->Errors->LongMessage;
        }
        $trackingNumbers = Sku::where('id', $sku_id)->with('tracking_numbers')->first()->tracking_numbers;
        return [
            'status'    =>  $response->Ack == 'Success',
            'msg'   =>  (string)$msg,
            'tracking_numbers'  =>  $trackingNumbers
        ];
    }

    public function syncTrackingNumber(Request $request){
        $sku_id = $request->get('sku_id');
        $sku = Sku::where('id', $sku_id)->with('transaction', 'transaction.order', 'transaction.order.store')->first();
        $transactionModel = $sku->transaction;
        $getOrderService = new GetOrderService();
        $response = $getOrderService->getOrdersByOrderId($sku->transaction->order->store, [$sku->transaction->order->ebay_order_id]);
        $tracking_array = [];
        if($response->Ack == 'Success'){
            if(isset($response->OrderArray->Order)){
                $order_array = $response->OrderArray->Order;
                $order = $order_array[0];
                foreach($order->TransactionArray->Transaction as $transaction){
                    if((string)$transaction->TransactionID == $transactionModel->ebay_transaction_id){
                        $shipmentTrackingDetails = $transaction->ShippingDetails->ShipmentTrackingDetails;
                        foreach ($shipmentTrackingDetails as $tracking){
                            array_push($tracking_array, [
                                'tracking_no'   =>  (string)$tracking->ShipmentTrackingNumber,
                                'carrier'   =>  (string)$tracking->ShippingCarrierUsed,
                            ]);
                        }
                    }
                }
            }
        }
        $downloadedTrackingNumbers = collect($tracking_array);
        $savedTrackingNumbers = TrackingNumber::orWhere(function($query) use ($transactionModel){
            $query->where('scope', TrackingNumberScope::TRANSACTION)->where('reference_id', $transactionModel->id);
        })->orWhere(function($query) use ($transactionModel, $sku){
            $query->where('scope', TrackingNumberScope::SKU)->where('reference_id', $sku->id);
        })->get();
        $newTrackingNumbers = $downloadedTrackingNumbers->filter(function($downloaded) use ($savedTrackingNumbers){
            $found = $savedTrackingNumbers->search(function($saved) use ($downloaded){
                return $saved->carrier == $downloaded['carrier'] && $saved->tracking_no == $downloaded['tracking_no'];
            });
            return $found === false;
        });
        foreach ($newTrackingNumbers as $number){
            TrackingNumber::updateOrCreate([
                'scope' =>  TrackingNumberScope::SKU,
                'reference_id'  =>  $sku_id,
                'carrier'   =>  $number['carrier'],
                'tracking_no'   =>  $number['tracking_no'],
            ], []);
        }
        if($newTrackingNumbers->count() > 0){
            $sku->update([
                'status'    =>  InternalOrderStatus::PAID_AND_SHIPPED
            ]);
        }
        return true;
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

    public function prepareOrdersForDataTable(Builder $orderBuilder, Request $request){
        $start = $request->get('start');
        $length = $request->get('length');
        $draw = $request->get('draw');
        $search = $request->get('search')['value'];

        $orderBuilder = $orderBuilder->search($search);

        $all_orders = $orderBuilder->get();
        $orders = $orderBuilder->skip($start)->take($length)->get();
        $response = [
            'draw'  =>  $draw,
            'recordsTotal'  =>  $all_orders->count(),
            'recordsFiltered'  =>  $all_orders->count(),
            'data'  =>  []
        ];
        $orders->each(function($order) use (&$response){
            $response['data'][] = [
                $order->id,
                $order->buyer_user_id,
                $order->transactions->first()->buyer_email,
                $order->transactions->pluck('item_id')->implode(", "),
                $order->transactions->pluck('item_title')->implode(", "),
                $order->transactions->sum('quantity'),
                $order->sub_total,
                $order->total,
                $order->sold_date,
                $order->paid_date,
            ];
        });
        return $response;
    }
}