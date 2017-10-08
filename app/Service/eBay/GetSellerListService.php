<?php

namespace App\Service\eBay;


use App\Models\Store;
use Carbon\Carbon;
use Spatie\ArrayToXml\ArrayToXml;

class GetSellerListService extends EbayRequest
{

    protected function getCallName()
    {
        return 'GetSellerList';
    }

    public function getListingsBetweenEndTime(Store $store, Carbon $endFrom, Carbon $endTo, $pageNum){
        $reqArray = [
            'RequesterCredentials'  =>  [
                'eBayAuthToken' =>  $store->auth_token
            ],
            'EndTimeFrom'   =>  $endFrom->toIso8601String(),
            'EndTimeTo'     =>  $endTo->toIso8601String(),
            'Pagination'    =>  [
                'EntriesPerPage'    =>  200,
                'PageNumber'        => $pageNum

            ],
            'DetailLevel'   =>  'ReturnAll'
        ];

        $request_body = ArrayToXml::convert($reqArray, [
            'rootElementName'   =>  'GetSellerListRequest',
            '_attributes'   =>  [
                'xmlns' =>  'urn:ebay:apis:eBLBaseComponents'
            ]
        ], false, 'UTF-8');

        return $this->fetch($store, $request_body);
    }
}