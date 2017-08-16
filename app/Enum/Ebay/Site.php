<?php
namespace App\Enum\Ebay;

use MyCLabs\Enum\Enum;

class Site extends Enum{
    const EBAY_US = [
        'site_id'   =>  0,
        'site_name'   =>  'eBay United States',
        'global_id'   =>  'EBAY-US'
    ];
    const EBAY_GB = [
        'site_id'   =>  3,
        'site_name'   =>  '	eBay UK',
        'global_id'   =>  '	EBAY-GB'
    ];
    const EBAY_MOTOR = [
        'site_id'   =>  100,
        'site_name'   =>  'eBay Motors',
        'global_id'   =>  'EBAY-MOTOR'
    ];

    public static function getSiteBySiteID($siteID){
        $sites = self::toArray();
        foreach ($sites as $site){
            if($site['site_id'] == $siteID) return $site;
        }
    }
}