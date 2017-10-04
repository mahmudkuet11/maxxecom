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

    public function getAll(StoreService $storeService, Request $request){
        if($request->ajax()){
            $orders = $this->service->getAll()->with('transactions')->filterStoreByUser()->orderBy('id', 'DESC');
            return $this->service->prepareOrdersForDataTable($orders, $request);
        }else{
            $storeService->syncAll();
            return view('dashboard.orders.index', ['active_menu'=>'order.all']);
        }
    }

    public function getAwaitingPaymentOrders(StoreService $storeService, Request $request){
        if($request->ajax()){
            $orders = $this->service->getAll()->with('transactions', 'transactions.skus')->awaitingPayment()->filterStoreByUser()->orderBy('id', 'DESC');
            return $this->service->prepareOrdersForDataTable($orders, $request);
        }else{
            $storeService->syncAll();
            return view('dashboard.orders.index', ['active_menu'=>'order.awaiting_payment']);
        }
    }

    public function getAwaitingShipmentOrders(StoreService $storeService, Request $request){
        if($request->ajax()){
            $orders = $this->service->getAll()->with('transactions', 'transactions.skus')->awaitingShipment()->filterStoreByUser()->orderBy('id', 'DESC');
            return $this->service->prepareOrdersForDataTable($orders, $request);
        }else{
            $storeService->syncAll();
            return view('dashboard.orders.index', ['active_menu'=>'order.awaiting_shipment']);
        }
    }
    public function getAwaitingOrderList(StoreService $storeService, Request $request){
        if($request->ajax()){
            $orders = $this->service->getAll()->with('transactions', 'transactions.skus')->awaitingOrder()->filterStoreByUser()->orderBy('id', 'DESC');
            return $this->service->prepareOrdersForDataTable($orders, $request);
        }else{
            $storeService->syncAll();
            return view('dashboard.orders.index', ['active_menu'=>'order.awaiting_order']);
        }
    }
    public function getPrintLabelList(StoreService $storeService, Request $request){
        if($request->ajax()){
            $orders = $this->service->getAll()->with('transactions', 'transactions.skus')->printLabel()->filterStoreByUser()->orderBy('id', 'DESC');
            return $this->service->prepareOrdersForDataTable($orders, $request);
        }else{
            $storeService->syncAll();
            return view('dashboard.orders.index', ['active_menu'=>'order.print_label']);
        }
    }
    public function getAwaitingTrackingList(StoreService $storeService, Request $request){
        if($request->ajax()){
            $orders = $this->service->getAll()->with('transactions', 'transactions.skus')->awaitingTracking()->filterStoreByUser()->orderBy('id', 'DESC');
            return $this->service->prepareOrdersForDataTable($orders, $request);
        }else{
            $storeService->syncAll();
            return view('dashboard.orders.index', ['active_menu'=>'order.awaiting_tracking']);
        }
    }
    public function getPaidAndShippedList(StoreService $storeService, Request $request){
        if($request->ajax()){
            $orders = $this->service->getAll()->with('transactions', 'transactions.skus')->paidAndShipped()->filterStoreByUser()->orderBy('id', 'DESC');
            return $this->service->prepareOrdersForDataTable($orders, $request);
        }else{
            $storeService->syncAll();
            return view('dashboard.orders.index', ['active_menu'=>'order.paid_and_shipped']);
        }
    }

    public function show($id){
        $order = $this->service->get($id)->with('shippingAddress', 'transactions', 'transactions.tracking_numbers', 'transactions.skus', 'transactions.skus.tracking_numbers', 'transactions.skus.invoice')->first();
        return view('dashboard.orders.show', [
            'order' =>  $order
        ]);
    }

    public function saveTrackingNumber(Request $request){
        $res = $this->service->saveTrackingNumber($request);
        return $res;
    }

    public function syncTrackingNumber(Request $request){
        $res = $this->service->syncTrackingNumber($request);
        if($res){
            return [
                'status'    =>  'success'
            ];
        }else{
            return [
                'status'    =>  'error'
            ];
        }
    }

    public function saveInvoice(Request $request){
        $res = $this->service->saveInvoice($request);
        if($res){
            return [
                'status'    =>  'success',
                'msg'   =>  'Invoice saved successfully!'
            ];
        }else{
            return [
                'status'    =>  'failed',
                'msg'   =>  'Invoice could not be saved'
            ];
        }
    }

    public function orderSubmit(Request $request){
        return $this->service->orderSubmit($request);
    }
}
