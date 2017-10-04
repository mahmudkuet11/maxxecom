<?php

namespace App\Service\eBay;


use App\Models\Store;
use Spatie\ArrayToXml\ArrayToXml;

class GetStoreService extends EbayRequest
{

    protected function getCallName(){
        return 'GetStore';
    }

    public function getStore(Store $store){
        $reqArray = [
            'RequesterCredentials'  =>  [
                'eBayAuthToken' =>  $store->auth_token
            ],
        ];

        $request_body = ArrayToXml::convert($reqArray, [
            'rootElementName'   =>  'GetStoreRequest',
            '_attributes'   =>  [
                'xmlns' =>  'urn:ebay:apis:eBLBaseComponents'
            ]
        ], false, 'UTF-8');
        return $this->fetch($store, $request_body);
    }
}