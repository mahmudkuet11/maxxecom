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
        $storeService->syncAll();
        $orders = $this->service->getAll()->filterByUser()->orderBy('sales_record_no', 'DESC');
        return view('dashboard.orders.index', ['orders'=>$orders->paginate(config('order.orders_per_page')), 'active_menu'=>'order.all']);
    }

    public function getAwaitingPaymentOrders(StoreService $storeService){
        $orders = $this->service->getAll()->filterByUser()->awaitingPayment()->orderBy('sales_record_no', 'DESC');
        $storeService->syncAll();
        return view('dashboard.orders.index', ['orders'=>$orders->paginate(config('order.orders_per_page')), 'active_menu'=>'order.awaiting_payment']);
    }

    public function getAwaitingShipmentOrders(StoreService $storeService){
        $orders = $this->service->getAll()->filterByUser()->awaitingShipment()->orderBy('sales_record_no', 'DESC');
        $storeService->syncAll();
        return view('dashboard.orders.index', ['orders'=>$orders->paginate(config('order.orders_per_page')), 'active_menu'=>'order.awaiting_shipment']);
    }
    public function getAwaitingOrderList(StoreService $storeService){
        $orders = $this->service->getAll()->filterByUser()->awaitingOrder()->orderBy('sales_record_no', 'DESC');
        $storeService->syncAll();
        return view('dashboard.orders.index', ['orders'=>$orders->paginate(config('order.orders_per_page')), 'active_menu'=>'order.awaiting_order']);
    }
    public function getPrintLabelList(StoreService $storeService){
        $orders = $this->service->getAll()->filterByUser()->printLabel()->orderBy('sales_record_no', 'DESC');
        $storeService->syncAll();
        return view('dashboard.orders.index', ['orders'=>$orders->paginate(config('order.orders_per_page')), 'active_menu'=>'order.print_label']);
    }
    public function getAwaitingTrackingList(StoreService $storeService){
        $orders = $this->service->getAll()->filterByUser()->awaitingTracking()->orderBy('sales_record_no', 'DESC');
        $storeService->syncAll();
        return view('dashboard.orders.index', ['orders'=>$orders->paginate(config('order.orders_per_page')), 'active_menu'=>'order.awaiting_tracking']);
    }

    public function show($id){
        $order = $this->service->get($id)->with('shippingAddress', 'transactions', 'transactions.skus', 'transactions.skus.invoice')->first();
        return view('dashboard.orders.show', [
            'order' =>  $order
        ]);
    }

    public function saveTrackingNumber(Request $request){
        $res = $this->service->saveTrackingNumber($request);
        return $res;
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
