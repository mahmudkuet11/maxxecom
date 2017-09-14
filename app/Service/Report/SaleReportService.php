<?php

namespace App\Service\Report;

use App\Models\Order\Order;
use Carbon\Carbon;

class SaleReportService
{
    public function getTodaysSales(){
        $today = Carbon::yesterday();
        $orders = Order::whereMonth('created_time', $today->month)
            ->whereDay('created_time', $today->day)
            ->whereYear('created_time', $today->year)
            ->get();
        return $orders;
    }
}