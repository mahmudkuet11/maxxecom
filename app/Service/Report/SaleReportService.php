<?php

namespace App\Service\Report;

use App\Models\Order\Order;
use App\User;
use Carbon\Carbon;

class SaleReportService
{
    public function getTodaysSales(){
        $stores = auth()->user()->user_stores->pluck('store_id')->all();
        $today = Carbon::today();
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
            'total_amount' =>  $totalAmount,
            'total_orders'  =>  $orders->count()
        ];
    }

    public function getYesterdaySales(){
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
            'total_amount' =>  $totalAmount,
            'total_orders'  =>  $orders->count()
        ];
    }

    public function getLastWeekSales(){
        $stores = auth()->user()->user_stores->pluck('store_id')->all();
        $start = Carbon::today()->subDays(7);
        $end = Carbon::today();
        $orders = Order::whereBetween('created_time', [$start, $end])
            ->whereIn('store_id', $stores)->get();
        $totalAmount = $orders->sum('total');
        $grouped = $orders->groupBy(function($item){
            $time = Carbon::parse($item->created_time);
            return $time->format('Y-m-d');
        });
        return [
            'grouped_orders'    =>  $grouped,
            'total_amount' =>  $totalAmount,
            'total_orders'  =>  $orders->count(),
            'start' =>  $start,
            'end'   =>  $end
        ];
    }

    public function getLastMonthSales(){
        $stores = auth()->user()->user_stores->pluck('store_id')->all();
        $start = Carbon::today()->subDays(30);
        $end = Carbon::today();
        $orders = Order::whereBetween('created_time', [$start, $end])
            ->whereIn('store_id', $stores)->get();
        $totalAmount = $orders->sum('total');
        $grouped = $orders->groupBy(function($item){
            $time = Carbon::parse($item->created_time);
            return $time->format('Y-m-d');
        });
        return [
            'grouped_orders'    =>  $grouped,
            'total_amount' =>  $totalAmount,
            'total_orders'  =>  $orders->count(),
            'start' =>  $start,
            'end'   =>  $end
        ];
    }

    public function getLastThreeMonthsSales(){
        $stores = auth()->user()->user_stores->pluck('store_id')->all();
        $start = Carbon::today()->subDays(90);
        $end = Carbon::today();
        $orders = Order::whereBetween('created_time', [$start, $end])
            ->whereIn('store_id', $stores)->get();
        $totalAmount = $orders->sum('total');
        $grouped = $orders->groupBy(function($item){
            $time = Carbon::parse($item->created_time);
            return $time->format('Y-m-d');
        });
        return [
            'grouped_orders'    =>  $grouped,
            'total_amount' =>  $totalAmount,
            'total_orders'  =>  $orders->count(),
            'start' =>  $start,
            'end'   =>  $end
        ];
    }
}