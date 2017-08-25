<?php

namespace App\Service\eBay;

use App\Models\Store;

class CompleteSaleService
{
    public function saveTrackingNumber(Store $store, $orderLineItemId, $shipmentTrackingDetails){
        /*$shipmentTrackingDetailsXml = "";
        foreach ($shipmentTrackingDetails as $trackingDetail){
            $tracking_no = $trackingDetail["tracking_no"];
            $carrier_used = $trackingDetail["carrier_used"];
            $shipmentTrackingDetails .= "\
                <ShipmentTrackingDetails>
                    <ShipmentTrackingNumber>". $tracking_no ."</ShipmentTrackingNumber>
                    <ShippingCarrierUsed>". $carrier_used ."</ShippingCarrierUsed>
                </ShipmentTrackingDetails>
            ";
        }*/
        $request_body = '\
            <?xml version="1.0" encoding="utf-8"?> 
            <CompleteSaleRequest xmlns="urn:ebay:apis:eBLBaseComponents">
                <RequesterCredentials>
                    <eBayAuthToken>'. $store->auth_token .'</eBayAuthToken>
                </RequesterCredentials>
                <OrderLineItemID>'. $orderLineItemId .'</OrderLineItemID>
                <Shipment>
                    
                </Shipment>
                <Shipped>false</Shipped>
            </CompleteSaleRequest>';
        $xml = simplexml_load_string($request_body);
        foreach ($shipmentTrackingDetails as $trackingDetail){
            $details = $xml->CompleteSaleRequest->Shipment->addChild('ShipmentTrackingDetails');
            $details->addChild('ShipmentTrackingNumber', $trackingDetail["tracking_no"]);
            $details->addChild('ShippingCarrierUsed', $trackingDetail["carrier_used"]);
        }
        dd($xml->asXML());
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