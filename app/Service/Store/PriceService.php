<?php

namespace App\Service\Store;

use Excel;

class PriceService
{
    public function getPerfectFitPrice($sku){
        /*Excel::load(public_path('\upload\price\perfect_fit.xlsx'), function($reader) {

            dd($reader->all());

        });*/
        ini_set('memory_limit', '-1');
        Excel::filter('chunk')->load(public_path('\upload\price\perfect_fit.csv'))->chunk(5, function($results)
        {
            foreach($results as $row)
            {
                dd($row);
            }
        });
    }
}