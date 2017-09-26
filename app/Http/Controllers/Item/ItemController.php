<?php

namespace App\Http\Controllers\Item;

use App\Models\Store;
use App\Service\Store\ItemService;
use App\Service\Store\StoreService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    private $service;

    function __construct(ItemService $service)
    {
        $this->service = $service;
    }

    public function findItem($store_id, $item_id){
        $store = Store::find($store_id);
        return $this->service->findItem($store, $item_id);
    }
}
