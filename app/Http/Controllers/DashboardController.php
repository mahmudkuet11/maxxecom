<?php

namespace App\Http\Controllers;

use App\Service\Report\SaleReportService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getDashboard(SaleReportService $saleReportService){
        $todaysOrders = $saleReportService->getTodaysSales();
        return view('dashboard.dashboard', ['todays_orders'=>$todaysOrders]);
    }
}
