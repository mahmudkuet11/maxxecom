<?php

namespace App\Service\Store;


class ItemService
{
        public function getStorePrices($sku){
            $priceService = new PriceService();
            return [
                'keystone_qi'   =>  $priceService->getKeystoneQIPrice($sku),
                'keystone_local'   =>  $priceService->getKeystoneLocalPrice($sku),
                'wr'   =>  $priceService->getWRPrice($sku),
                'pf'   =>  $priceService->getPFPrice($sku),
                'bs'   =>  $priceService->getBSPrice($sku),
                'cap'   =>  $priceService->getCAPPrice($sku),
                'apw'   =>  $priceService->getAPWPrice($sku),
                'ra'   =>  $priceService->getRAPrice($sku),
                'pg'   =>  $priceService->getPGPrice($sku),
                'amazon'   =>  $priceService->getAmazonPrice($sku),
                'ebay'   =>  $priceService->getEbayPrice($sku),
                'atd'   =>  $priceService->getATDPrice($sku),
                'future'   =>  $priceService->getFuturePrice($sku),
            ];
        }
}