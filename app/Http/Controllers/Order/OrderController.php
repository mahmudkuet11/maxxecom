<?php

namespace App\Http\Controllers\Order;

use App\Service\Order\OrderService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    private $service;

    function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    public function getAll(){
        $this->service->fetchUnSynced(4);
        return view('dashboard.orders.index');
    }
}
