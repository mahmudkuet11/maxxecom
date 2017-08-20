<?php

namespace App\Http\Controllers\Order;

use App\Jobs\SyncOrder;
use App\Service\Order\OrderService;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    private $service;

    function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    public function getAll(){
        $this->service->fetchUnSynced(1);
        return view('dashboard.orders.index');
    }
}
