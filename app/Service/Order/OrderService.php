<?php

namespace App\Service\Order;

use App\Event\StoreSyncProgress;
use App\Models\Order\CheckoutStatus;
use App\Models\Order\Order;
use App\Models\Order\ShippingAddress;
use App\Models\Order\Transaction;
use App\Models\Store;
use Carbon\Carbon;
use DB;

class OrderService
{
    public function getAll(){
        return new Order();
    }

    public function SaveOrders(Store $store, $orders){
        $order_array = $orders->OrderArray->Order;
        foreach ($order_array as $order){
            self::Save($store->id, $order);
        }
        event(new StoreSyncProgress($orders, $store));
    }

    public function Save($store_id, $order){
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
            ]);
            CheckoutStatus::updateOrCreate([
                'order_id'  =>  $orderModel->id
            ], [
                'ebay_payment_status'   =>  (string)$order->CheckoutStatus->eBayPaymentStatus,
                'status'    =>  (string)$order->CheckoutStatus->Status
            ]);
            ShippingAddress::updateOrCreate([
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
                Transaction::updateOrCreate([
                    'order_id'  =>  $orderModel->id,
                    'sales_record_no'   =>  (string)$transaction->ShippingDetails->SellingManagerSalesRecordNumber
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
                ]);
            }
            DB::commit();
            return true;
        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }
}