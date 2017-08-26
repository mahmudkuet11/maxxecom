<?php

namespace App\Service\eBay;

use App\Models\Order\Order;
use App\Models\Store;
use GuzzleHttp\Client;
use Spatie\ArrayToXml\ArrayToXml;

class CompleteSaleService
{
    public function saveTrackingNumber(Store $store, Order $order, $orderLineItemId, $shipmentTrackingDetails){

        $reqArray = [
            'RequesterCredentials'  =>  [
                'eBayAuthToken' =>  $store->auth_token
            ],
            'OrderLineItemID'   =>  $orderLineItemId,
            'Shipment'  =>  [],
        ];
        foreach ($shipmentTrackingDetails as $trackingDetail){
            $reqArray['Shipment']['ShipmentTrackingDetails'][] = [
                'ShipmentTrackingNumber'    =>  $trackingDetail["tracking_no"],
                'ShippingCarrierUsed'   =>  $trackingDetail["carrier_used"]
            ];
        }
        if($order->shipped_time){
            $reqArray['Shipment']['ShippedTime'] = $order->shipped_time;
        }else{
            $reqArray['Shipped'] = 'false';
        }
        $request_body = ArrayToXml::convert($reqArray, [
            'rootElementName'   =>  'CompleteSaleRequest',
            '_attributes'   =>  [
                'xmlns' =>  'urn:ebay:apis:eBLBaseComponents'
            ]
        ], false, 'UTF-8');
        return self::_fetch($store, $request_body);
    }

    private function _fetch($store, $request_body){
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
                'X-EBAY-API-CALL-NAME'  =>  'CompleteSale',
                'X-EBAY-API-SITEID'  =>  $store->site_id,
            ],
            'body'=>$request_body
        ]);
        $response = simplexml_load_string($request->getBody()->getContents());
        return $response;
    }
}