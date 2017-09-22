<?php

namespace App\Service\eBay;


use App\Models\Store;
use Spatie\ArrayToXml\ArrayToXml;

class GetItemService extends EbayRequest
{

    protected function getCallName()
    {
        return 'GetItem';
    }

    public function getItem(Store $store, $ebayItemId){
        $reqArray = [
            'RequesterCredentials'  =>  [
                'eBayAuthToken' =>  $store->auth_token
            ],
            'ItemID'    =>  $ebayItemId,
            'DetailLevel'   =>  'ReturnAll',
            'IncludeItemCompatibilityList'   =>  'true',
            'IncludeItemSpecifics'   =>  'true',
            'IncludeTaxTable'   =>  'true',
            'IncludeWatchCount'   =>  'true',
        ];

        $request_body = ArrayToXml::convert($reqArray, [
            'rootElementName'   =>  'GetItemRequest',
            '_attributes'   =>  [
                'xmlns' =>  'urn:ebay:apis:eBLBaseComponents'
            ]
        ], false, 'UTF-8');

        return $this->fetch($store, $request_body);
    }
}