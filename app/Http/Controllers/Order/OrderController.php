<?php

namespace App\Http\Controllers\Order;

use App\Jobs\SetupStoreJob;
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
        $orders = $this->service->getAll()->get();
        //dd($orders);
        $storeService->syncAll();
        return view('dashboard.orders.index', ['orders'=>$orders]);
    }
}
