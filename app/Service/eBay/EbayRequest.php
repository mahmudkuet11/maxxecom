<?php

namespace App\Service\eBay;

use App\Models\Store;
use GuzzleHttp\Client;

abstract class EbayRequest
{
    protected abstract function getCallName();

    protected function fetch(Store $store, $request_body){
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
                'X-EBAY-API-CALL-NAME'  =>  $this->getCallName(),
                'X-EBAY-API-SITEID'  =>  $store->site_id,
            ],
            'body'=>$request_body
        ]);
        $response = simplexml_load_string($request->getBody()->getContents());
        return $response;
    }

    public static function parseErrorMessage($response){
        $error_messages = [];
        foreach ($response->Errors as $error){
            $error_messages[] = (string)$error->LongMessage;
        }
        return $error_messages;
    }
}