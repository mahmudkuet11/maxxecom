<?php

namespace App\Enum\Ebay;


use MyCLabs\Enum\Enum;

class ItemCondition extends Enum
{
    const NEW_CONDITION = [
        'name'  =>  'New',
        'id'    =>  1000
    ];
    const NEW_OTHER = [
        'name'  =>  'New Other',
        'id'    =>  1500
    ];
    const NEW_WITH_DEFECTS = [
        'name'  =>  '	New with defects',
        'id'    =>  1750
    ];
    const MANUFACTURER_REFURBISHED = [
        'name'  =>  '	Manufacturer refurbished',
        'id'    =>  2000
    ];
    const SELLER_REFURBISHED = [
        'name'  =>  'Seller refurbished',
        'id'    =>  2500
    ];
    const LIKE_NEW = [
        'name'  =>  'Like New',
        'id'    =>  2750
    ];
    const USED = [
        'name'  =>  'Used',
        'id'    =>  3000
    ];
    const VERY_GOOD = [
        'name'  =>  'Very Good',
        'id'    =>  4000
    ];
    const GOOD = [
        'name'  =>  'Good',
        'id'    =>  5000
    ];
    const ACCEPTABLE = [
        'name'  =>  'Acceptable',
        'id'    =>  6000
    ];
    const FOR_PARTS_OR_NOT_WORKING = [
        'name'  =>  'For parts or not working',
        'id'    =>  7000
    ];

    public static function getNameByID($condition_id){
        $conditions = self::toArray();
        foreach ($conditions as $condition){
            if($condition['id'] == $condition_id) return $condition['name'];
        }
        return '';
    }
}
