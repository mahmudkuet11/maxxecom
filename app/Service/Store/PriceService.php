<?php

namespace App\Service\Store;

use Akeneo\Component\SpreadsheetParser\SpreadsheetParser;
use App\Enum\Store;
use App\Models\StorePrice;
use App\Service\eBay\FindItemByKeywordsService;
use GuzzleHttp\Client;
use Symfony\Component\Console\Output\ConsoleOutput;

class PriceService
{
    public function getPFPrice($sku){
        $price = StorePrice::where('store', Store::PERFECT_FIT)
            ->where('sku', $sku)
            ->first();
        if($price){
            return [
                'price' =>  (int)$price->price,
                'shipping_cost'  =>  (int)$price->shipping_cost,
                'handling_cost' =>  (int)$price->handling_cost
            ];
        }
        return [
            'price' =>  0,
            'shipping_cost'  =>  0,
            'handling_cost' =>  0
        ];
    }
    public function getKeystoneQIPrice($sku){
        $price = StorePrice::where('store', Store::KEYSTONE)
            ->where('sku', $sku)
            ->first();
        if($price){
            return [
                'price' =>  (int)$price->price,
                'shipping_cost'  =>  (int)$price->shipping_cost,
                'handling_cost' =>  (int)$price->handling_cost
            ];
        }
        return [
            'price' =>  0,
            'shipping_cost'  =>  0,
            'handling_cost' =>  0
        ];
    }
    public function getKeystoneLocalPrice($sku){
        $price = StorePrice::where('store', Store::KEYSTONE)
            ->where('sku', $sku)
            ->first();
        if($price){
            return [
                'price' =>  (int)$price->price,
                'shipping_cost'  =>  (int)$price->shipping_cost,
                'handling_cost' =>  (int)$price->handling_cost
            ];
        }
        return [
            'price' =>  0,
            'shipping_cost'  =>  0,
            'handling_cost' =>  0
        ];
    }
    public function getWRPrice($sku){
        return [
            'price' =>  0,
            'shipping_cost'  =>  0,
            'handling_cost' =>  0
        ];
    }
    public function getBSPrice($sku){
        return [
            'price' =>  0,
            'shipping_cost'  =>  0,
            'handling_cost' =>  0
        ];
    }
    public function getCAPPrice($sku){
        return [
            'price' =>  0,
            'shipping_cost'  =>  0,
            'handling_cost' =>  0
        ];
    }
    public function getAPWPrice($sku){
        return [
            'price' =>  0,
            'shipping_cost'  =>  0,
            'handling_cost' =>  0
        ];
    }
    public function getRAPrice($sku){
        return [
            'price' =>  0,
            'shipping_cost'  =>  0,
            'handling_cost' =>  0
        ];
    }
    public function getPGPrice($sku){
        return [
            'price' =>  0,
            'shipping_cost'  =>  0,
            'handling_cost' =>  0
        ];
    }
    public function getAmazonPrice($sku){
        $access_key_id = "AKIAIALOI3PCRUWBL5CA";
        $secret_key = "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";
        $endpoint = "webservices.amazon.com";
        $uri = "/onca/xml";
        $params = array(
            "Service" => "AWSECommerceService",
            "Operation" => "ItemSearch",
            "AWSAccessKeyId" => "AKIAIALOI3PCRUWBL5CA",
            "AssociateTag" => "vinndo-android-20",
            "SearchIndex" => "Automotive",
            "Keywords" => $sku,
            "ResponseGroup" => "ItemAttributes,Offers,OfferSummary,Tracks",
            "Availability" => "Available",
            "Condition" => "New",
            "Sort" => "price"
        );
        if (!isset($params["Timestamp"])) {
            $params["Timestamp"] = gmdate('Y-m-d\TH:i:s\Z');
        }
        ksort($params);
        $pairs = array();
        foreach ($params as $key => $value) {
            array_push($pairs, rawurlencode($key)."=".rawurlencode($value));
        }
        $canonical_query_string = join("&", $pairs);
        $string_to_sign = "GET\n".$endpoint."\n".$uri."\n".$canonical_query_string;
        $signature = base64_encode(hash_hmac("sha256", $string_to_sign, $secret_key, true));
        $request_url = 'http://'.$endpoint.$uri.'?'.$canonical_query_string.'&Signature='.rawurlencode($signature);

        $response = simplexml_load_string((new Client())->get($request_url)->getBody()->getContents());

        if((int)$response->Items->TotalResults > 0){
            return [
                'price' =>  (double)number_format(((double)$response->Items->Item->OfferSummary->LowestNewPrice->Amount) / 100, 2),
                'shipping_cost'  =>  0,
                'handling_cost' =>  0
            ];
        }

        return [
            'price' =>  0,
            'shipping_cost'  =>  0,
            'handling_cost' =>  0
        ];
    }
    public function getEbayPrice($sku){
        $service = new FindItemByKeywordsService();
        $response = $service->findItem($sku);
        if($response->ack == 'Success'){
            return [
                'price' =>  (double)$response->searchResult->item[0]->sellingStatus->currentPrice,
                'shipping_cost'  =>  (double)$response->searchResult->item[0]->shippingInfo->shippingServiceCost,
                'handling_cost' =>  0
            ];
        }
        return [
            'price' =>  0,
            'shipping_cost'  =>  0,
            'handling_cost' =>  0
        ];
    }
    public function getATDPrice($sku){
        return [
            'price' =>  0,
            'shipping_cost'  =>  0,
            'handling_cost' =>  0
        ];
    }
    public function getFuturePrice($sku){
        return [
            'price' =>  0,
            'shipping_cost'  =>  0,
            'handling_cost' =>  0
        ];
    }

    public function save(){
        StorePrice::truncate();
        self::savePerfectFit();
        self::saveKeystone();
    }

    public function savePerfectFit(){
        $workbook = SpreadsheetParser::open(public_path('/upload/price/perfect_fit.xlsx'));

        $myWorksheetIndex = $workbook->getWorksheetIndex('Q4 - 2');

        $data = [];
        $console = new ConsoleOutput();
        foreach ($workbook->createRowIterator($myWorksheetIndex) as $rowIndex => $values) {
            if($rowIndex < 2) continue;
            $data[] = [
                'store' =>  Store::PERFECT_FIT,
                'sku'   =>  $values[3],
                'price'   =>  $values[7],
                'shipping_cost'   =>  $values[4],
                'handling_cost'   =>  $values[5],
            ];
            if($rowIndex % 500 == 0){
                StorePrice::insert($data);
                $data = [];
            }
            $console->writeln("row: {$rowIndex}");
        }
        StorePrice::insert($data);
    }

    public function saveKeystone(){
        $workbook = SpreadsheetParser::open(public_path('/upload/price/keystone.xlsx'));

        $myWorksheetIndex = $workbook->getWorksheetIndex('keystoneparts (1)(1)');

        $data = [];
        $console = new ConsoleOutput();
        foreach ($workbook->createRowIterator($myWorksheetIndex) as $rowIndex => $values) {
            if($rowIndex < 2) continue;
            $dataArray = explode('|', $values[0]);
            $data[] = [
                'store' =>  Store::KEYSTONE,
                'sku'   =>  $dataArray[2],
                'price'   =>  $dataArray[26],
                'shipping_cost'   =>  0,
                'handling_cost'   =>  0,
            ];
            if($rowIndex % 500 == 0){
                StorePrice::insert($data);
                $data = [];
            }
            $console->writeln("row: {$rowIndex}");
        }
        StorePrice::insert($data);
    }
}