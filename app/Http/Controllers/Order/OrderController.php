<?php

namespace App\Http\Controllers\Order;

use App\Service\Order\OrderService;
use App\Http\Controllers\Controller;
use App\Service\Store\StoreService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $service;

    function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    public function getAll(StoreService $storeService){
        $orders = $this->service->getAll()->orderBy('sales_record_no', 'DESC');
        $storeService->syncAll();
        return view('dashboard.orders.index', ['orders'=>$orders->paginate(config('order.orders_per_page')), 'active_menu'=>'order.all']);
    }

    public function getAwaitingPaymentOrders(StoreService $storeService){
        $orders = $this->service->getAll()->awaitingPayment()->orderBy('sales_record_no', 'DESC');
        $storeService->syncAll();
        return view('dashboard.orders.awaiting_payment', ['orders'=>$orders->paginate(config('order.orders_per_page')), 'active_menu'=>'order.awaiting_payment']);
    }

    public function getAwaitingShipmentOrders(StoreService $storeService){
        $orders = $this->service->getAll()->awaitingShipment()->orderBy('sales_record_no', 'DESC');
        $storeService->syncAll();
        return view('dashboard.orders.awaiting_shipment', ['orders'=>$orders->paginate(config('order.orders_per_page')), 'active_menu'=>'order.awaiting_shipment']);
    }

    public function show($id){
        $order = $this->service->get($id)->with('shippingAddress', 'transactions')->first();
        return view('dashboard.orders.show', [
            'order' =>  $order
        ]);
    }

    public function saveTrackingNumber(Request $request){
        $res = $this->service->saveTrackingNumber($request);
        return $res;
    }
}
