<?php

namespace App\Service\Store;

use App\Service\Excel\ExcelService;

class PriceService
{
    public function getPerfectFitPrice($sku){
        $excelService = new ExcelService(public_path('\upload\price\perfect_fit.xlsx'));
        dd($excelService->search('AC1000110'));
    }

    public function save(){
        $excelService = new ExcelService(public_path('\upload\price\perfect_fit.xlsx'));
        $excelService->chunk(function($data){
            dd($data);
        });
    }
}