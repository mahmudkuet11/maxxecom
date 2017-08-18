<?php

namespace App\Service\Order;

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
            dd($orders);
            if($orders->Ack == 'Success'){
                self::_save($orders);
                while($orders->HasMoreOrders){
                    $current_page++;
                    $orders = self::_getPage($current_page, $store->auth_token, $store->site_id, $last_synced_time, $now);
                    if($orders->Ack == 'Success'){
                        self::_save($orders);
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
                <EntriesPerPage>100</EntriesPerPage>
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

    private function _save(\SimpleXMLElement $orders){

    }
}