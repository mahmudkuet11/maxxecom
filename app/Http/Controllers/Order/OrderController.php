<?php

namespace App\Http\Controllers\Order;

use App\Models\Store;
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
        $this->service->fetchUnSynced(Store::first()->id);
        return view('dashboard.orders.index');
    }
}
