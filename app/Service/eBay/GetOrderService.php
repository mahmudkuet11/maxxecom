<?php

namespace App\Service\eBay;

use App\Models\Store;
use Carbon\Carbon;
use GuzzleHttp\Client;

class GetOrderService
{
    public function getCreatedBetween(Store $store, Carbon $from, Carbon $to, $page_no){
        $request_body = '\
            <?xml version="1.0" encoding="utf-8"?> 
            <GetOrdersRequest xmlns="urn:ebay:apis:eBLBaseComponents">
                <RequesterCredentials>
                    <eBayAuthToken>'. $store->auth_token .'</eBayAuthToken>
                </RequesterCredentials>
                <CreateTimeFrom>'. $from->toIso8601String() .'</CreateTimeFrom>
                <CreateTimeTo>'. $to->toIso8601String() .'</CreateTimeTo>
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
                'X-EBAY-API-SITEID'  =>  $store->site_id,
            ],
            'body'=>$request_body
        ]);
        $response = simplexml_load_string($request->getBody()->getContents());
        return $response;
    }
}