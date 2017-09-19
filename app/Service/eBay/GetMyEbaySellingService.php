<?php

namespace App\Service\eBay;

use App\Models\Store;
use Spatie\ArrayToXml\ArrayToXml;

class GetMyEbaySellingService extends EbayRequest
{
    public function getActiveList(Store $store, $pageNo){
        $reqArray = [
            'RequesterCredentials'  =>  [
                'eBayAuthToken' =>  $store->auth_token
            ],
            'ActiveList'   =>   [
                'Pagination'    =>  [
                    'EntriesPerPage'    =>  200,
                    'PageNumber'    =>  $pageNo
                ]
            ]
        ];

        $request_body = ArrayToXml::convert($reqArray, [
            'rootElementName'   =>  'GetMyeBaySellingRequest',
            '_attributes'   =>  [
                'xmlns' =>  'urn:ebay:apis:eBLBaseComponents'
            ]
        ], false, 'UTF-8');

        return $this->fetch($store, $request_body);
    }

    public function getCallName()
    {
        return 'GetMyeBaySelling';
    }
}