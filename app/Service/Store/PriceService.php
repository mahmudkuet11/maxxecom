<?php

namespace App\Service\Store;

use App\Enum\Store;
use App\Event\StorePriceSyncProgress;
use App\Models\StorePrice;
use App\Service\Excel\ExcelService;

class PriceService
{
    public function getPFPrice($sku){
        return [
            'price' =>  rand(5,50),
            'shipping_cost'  =>  rand(0,10),
            'handling_cost' =>  rand(0,10)
        ];
    }
    public function getKeystoneQIPrice($sku){
        return [
            'price' =>  rand(5,50),
            'shipping_cost'  =>  rand(0,10),
            'handling_cost' =>  rand(0,10)
        ];
    }
    public function getKeystoneLocalPrice($sku){
        return [
            'price' =>  rand(5,50),
            'shipping_cost'  =>  rand(0,10),
            'handling_cost' =>  rand(0,10)
        ];
    }
    public function getWRPrice($sku){
        return [
            'price' =>  rand(5,50),
            'shipping_cost'  =>  rand(0,10),
            'handling_cost' =>  rand(0,10)
        ];
    }
    public function getBSPrice($sku){
        return [
            'price' =>  rand(5,50),
            'shipping_cost'  =>  rand(0,10),
            'handling_cost' =>  rand(0,10)
        ];
    }
    public function getCAPPrice($sku){
        return [
            'price' =>  rand(5,50),
            'shipping_cost'  =>  rand(0,10),
            'handling_cost' =>  rand(0,10)
        ];
    }
    public function getAPWPrice($sku){
        return [
            'price' =>  rand(5,50),
            'shipping_cost'  =>  rand(0,10),
            'handling_cost' =>  rand(0,10)
        ];
    }
    public function getRAPrice($sku){
        return [
            'price' =>  rand(5,50),
            'shipping_cost'  =>  rand(0,10),
            'handling_cost' =>  rand(0,10)
        ];
    }
    public function getPGPrice($sku){
        return [
            'price' =>  rand(5,50),
            'shipping_cost'  =>  rand(0,10),
            'handling_cost' =>  rand(0,10)
        ];
    }
    public function getAmazonPrice($sku){
        return [
            'price' =>  rand(5,50),
            'shipping_cost'  =>  rand(0,10),
            'handling_cost' =>  rand(0,10)
        ];
    }
    public function getEbayPrice($sku){
        return [
            'price' =>  rand(5,50),
            'shipping_cost'  =>  rand(0,10),
            'handling_cost' =>  rand(0,10)
        ];
    }
    public function getATDPrice($sku){
        return [
            'price' =>  rand(5,50),
            'shipping_cost'  =>  rand(0,10),
            'handling_cost' =>  rand(0,10)
        ];
    }
    public function getFuturePrice($sku){
        return [
            'price' =>  rand(5,50),
            'shipping_cost'  =>  rand(0,10),
            'handling_cost' =>  rand(0,10)
        ];
    }

    public function save(){
        self::savePerfectFit();
    }

    public function savePerfectFit(){
        StorePrice::truncate();
        $excelService = new ExcelService(public_path('/uploads/store_price/perfect_fit.xlsx'));
        $totalRows = $excelService->getTotalRows();
        $completedRows = 0;
        $excelService->chunk(function($rows) use (&$completedRows, $totalRows){
            $data = [];
            foreach ($rows as $row){
                if($row['C']){
                    $data[] = [
                        'store' =>  Store::PERFECT_FIT,
                        'sku'   =>  $row['C'],
                        'price'   =>  $row['H'],
                        'shipping_cost'   =>  $row['E'],
                        'handling_cost'   =>  $row['F'],
                    ];
                }
            }
            StorePrice::insert($data);

            $completedRows += config('order.excel_chunk_size');
            event(new StorePriceSyncProgress('Perfect Fit', $totalRows, $completedRows));
        });
    }
}