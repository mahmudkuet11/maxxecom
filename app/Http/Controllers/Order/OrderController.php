<?php

namespace App\Http\Controllers\Order;

use App\Jobs\SyncOrder;
use App\Models\Store;
use App\Service\Order\OrderService;
use App\Http\Controllers\Controller;
use App\Service\Store\StoreService;

class OrderController extends Controller
{
    private $service;

    function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    public function getAll(StoreService $storeService){
        //$storeService->syncAll();
        try{
            $res = $this->service->fetchUnSynced(1);
            dd($res);
        }catch (\Exception $e){
            dd($e->getMessage());
        }
        return view('dashboard.orders.index');
    }
}
