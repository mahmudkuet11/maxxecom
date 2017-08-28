<?php

namespace App\Service\Store;


class ItemService
{
        public function getStorePrices($sku){
            $priceService = new PriceService();
            $perfect_fit = $priceService->getPerfectFitPrice($sku);
            return $perfect_fit;
        }
}