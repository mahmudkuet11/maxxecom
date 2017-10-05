<?php

namespace App\Service\eBay;


use GuzzleHttp\Client;
use Spatie\ArrayToXml\ArrayToXml;

class FindItemByKeywordsService
{
    protected function fetch($request_body){
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
        $request = $client->request('POST', 'http://svcs.ebay.com/services/search/FindingService/v1', [
            'headers'   =>  [
                'Content-Type'  =>  'text/xml',
                'X-EBAY-SOA-SERVICE-NAME'  =>  'FindingService',
                'X-EBAY-SOA-OPERATION-NAME'  =>  'findItemsByKeywords',
                'X-EBAY-SOA-SERVICE-VERSION'  =>  '1.0.0',
                'X-EBAY-SOA-GLOBAL-ID'  =>  'EBAY-US',
                'X-EBAY-SOA-SECURITY-APPNAME'  =>  'TagchopI-tagchop-PRD-f45f64428-9e59ef08',
                'X-EBAY-SOA-REQUEST-DATA-FORMAT'  =>  'XML',
            ],
            'body'=>$request_body
        ]);
        $response = simplexml_load_string($request->getBody()->getContents());
        return $response;
    }

    public function findItem($keyword){
        $reqArray = [
            'keywords'  =>  $keyword,
            'affiliate' =>  [
                'customId'  =>  '71-abid',
                'trackingId'    =>  '5338179196',
                'networkId' =>  '9'
            ],
            'sortOrder' =>  'PricePlusShippingLowest',
            'itemFilter'    =>  [
                'name'  =>  'Condition',
                'value'  =>  'New'
            ]
        ];

        $request_body = ArrayToXml::convert($reqArray, [
            'rootElementName'   =>  'findItemsByKeywordsRequest',
            '_attributes'   =>  [
                'xmlns' =>  'http://www.ebay.com/marketplace/search/v1/services'
            ]
        ], false, 'UTF-8');
        return $this->fetch($request_body);
    }

    public static function parseErrorMessage($response){
        $error_messages = [];
        if($response->Errors){
            foreach ($response->Errors as $error){
                $error_messages[] = (string)$error->LongMessage;
            }
        }
        return $error_messages;
    }
}