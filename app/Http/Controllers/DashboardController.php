<?php

namespace App\Http\Controllers;

use App\Service\Report\SaleReportService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getDashboard(SaleReportService $saleReportService){
        $today = $saleReportService->getTodaysSales();
        $yesterday = $saleReportService->getYesterdaySales();
        $lastWeek = $saleReportService->getLastWeekSales();
        $lastMonth = $saleReportService->getLastWeekSales();
        $last3Months = $saleReportService->getLastThreeMonthsSales();
        return view('dashboard.dashboard', [
            'today' =>  $today,
            'yesterday' =>  $yesterday,
            'last_week' =>  $lastWeek,
            'last_month'    =>  $lastMonth,
            'last_3_months'    =>  $last3Months,
        ]);
    }
}
