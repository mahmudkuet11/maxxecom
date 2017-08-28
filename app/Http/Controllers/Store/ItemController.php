<?php

namespace App\Http\Controllers\Store;

use App\Service\Store\ItemService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    private $service;

    function __construct(ItemService $service)
    {
        $this->service = $service;
    }

    public function getStorePrices($sku){
        return $this->service->getStorePrices($sku);
    }
}
