<?php

namespace App\Service\Order;

use App\Models\Order\CheckoutStatus;
use App\Models\Order\Order;
use App\Models\Order\ShippingAddress;
use App\Models\Order\Transaction;
use App\Models\Store;
use App\Models\Synchronization;
use Carbon\Carbon;
use GuzzleHttp\Client;
use DB;

class OrderService
{

    public function fetchUnSynced($store_id){
        DB::beginTransaction();
        try{
            $store = Store::find($store_id);
            $sync = Synchronization::where('store_id', $store_id)->first();
            if($sync){
                $last_synced_time = $sync->last_synced_at;
            }else{
                $last_synced_time = Carbon::now()->subDays(90);
            }
            $now = Carbon::now();
            $current_page = 1;
            $orders = self::_getPage($current_page, $store->auth_token, $store->site_id, $last_synced_time, $now);
            if($orders->Ack == 'Success'){
                self::_saveOrders($store_id, $orders);
                while($orders->HasMoreOrders){
                    $current_page++;
                    $orders = self::_getPage($current_page, $store->auth_token, $store->site_id, $last_synced_time, $now);
                    if($orders->Ack == 'Success'){
                        self::_saveOrders($store_id, $orders);
                    }else{
                        break;
                    }
                }
            }
            DB::commit();
            return true;
        }catch (\Exception $e){
            DB::rollback();
            return false;
        }
    }

    /**
     *
     * @param int $page_no
     * @param string $auth_token
     * @param  int $site_id
     * @param \Carbon\Carbon $create_time_from
     * @param \Carbon\Carbon $create_time_to
     *
     * @return \SimpleXMLElement
     */
    private function _getPage($page_no, $auth_token, $site_id, $create_time_from, $create_time_to){
        $request_body = '\
            <?xml version="1.0" encoding="utf-8"?> 
            <GetOrdersRequest xmlns="urn:ebay:apis:eBLBaseComponents">
              <RequesterCredentials>
                <eBayAuthToken>'. $auth_token .'</eBayAuthToken>
              </RequesterCredentials>
            <CreateTimeFrom>'. $create_time_from->toIso8601String() .'</CreateTimeFrom>
            <CreateTimeTo>'. $create_time_to->toIso8601String() .'</CreateTimeTo>
            <Pagination>
                <EntriesPerPage>2</EntriesPerPage>
                <PageNumber>'. $page_no .'</PageNumber>
             </Pagination>
            </GetOrdersRequest>';

        $client = new Client(
            [
                "defaults" => [
                    "config"          => [
                        "curl"        => [
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_TIMEOUT_MS => 0,
                            CURLOPT_CONNECTTIMEOUT => 0,
                        ]
                    ],
                ]
            ]
        );
        $request = $client->request('POST', env('EBAY_API_ENDPOINT'), [
            'headers'   =>  [
                'Content-Type'  =>  'text/xml',
                'X-EBAY-API-COMPATIBILITY-LEVEL'  =>  env('EBAY_API_COMPATIBILITY_LEVEL'),
                'X-EBAY-API-DEV-NAME'  =>  env('EBAY_DEV_ID'),
                'X-EBAY-API-APP-NAME'  =>  env('EBAY_APP_ID'),
                'X-EBAY-API-CERT-NAME'  =>  env('EBAY_CERT_ID'),
                'X-EBAY-API-CALL-NAME'  =>  'GetOrders',
                'X-EBAY-API-SITEID'  =>  $site_id,
            ],
            'body'=>$request_body
        ]);
        $response = simplexml_load_string($request->getBody()->getContents());
        return $response;
    }

    private function _saveOrders($store_id, \SimpleXMLElement $orders){
        $order_array = $orders->OrderArray->Order;
        foreach ($order_array as $order){
            self::_save($store_id, $order);
        }
    }

    private function _save($store_id, $order){
        $orderModel = Order::create([
            'store_id' =>  $store_id,
            'ebay_order_id'    =>  (string)$order->OrderID,
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
        CheckoutStatus::create([
            'order_id'  =>  $orderModel->id,
            'ebay_payment_status'   =>  (string)$order->CheckoutStatus->eBayPaymentStatus,
            'status'    =>  (string)$order->CheckoutStatus->Status
        ]);
        ShippingAddress::create([
            'order_id'  =>  $orderModel->id,
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
            Transaction::create([
                'order_id'  =>  $orderModel->id,
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
    }
}