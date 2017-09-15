<?php

namespace App\Service\Report;

use App\Models\Order\Order;
use App\User;
use Carbon\Carbon;

class SaleReportService
{
    public function getTodaysSales(){
        $stores = auth()->user()->user_stores->pluck('store_id')->all();
        $today = Carbon::yesterday();
        $orders = Order::whereMonth('created_time', $today->month)
            ->whereDay('created_time', $today->day)
            ->whereYear('created_time', $today->year)
            ->whereIn('store_id', $stores)
            ->get();
        $totalAmount = $orders->sum('total');
        $grouped = $orders->groupBy(function($item){
            $time = Carbon::parse($item->created_time);
            return $time->hour;
        });
        return [
            'grouped_orders'    =>  $grouped,
            'total' =>  $totalAmount
        ];
    }
}