<?php

namespace App\Service\Store;


use App\Enum\ListingType;
use App\Models\Item\Item;
use App\Models\Store;
use App\Service\Console;
use App\Service\eBay\GetMyEbaySellingService;
use App\Service\Time;
use Carbon\Carbon;

class ItemService
{
        public function getStorePrices($sku){
            $priceService = new PriceService();
            return [
                'keystone_qi'   =>  $priceService->getKeystoneQIPrice($sku),
                'keystone_local'   =>  $priceService->getKeystoneLocalPrice($sku),
                'wr'   =>  $priceService->getWRPrice($sku),
                'pf'   =>  $priceService->getPFPrice($sku),
                'bs'   =>  $priceService->getBSPrice($sku),
                'cap'   =>  $priceService->getCAPPrice($sku),
                'apw'   =>  $priceService->getAPWPrice($sku),
                'ra'   =>  $priceService->getRAPrice($sku),
                'pg'   =>  $priceService->getPGPrice($sku),
                'amazon'   =>  $priceService->getAmazonPrice($sku),
                'ebay'   =>  $priceService->getEbayPrice($sku),
                'atd'   =>  $priceService->getATDPrice($sku),
                'future'   =>  $priceService->getFuturePrice($sku),
            ];
        }

        public function syncListings(Store $store){
            $getMyEbaySellingService = new GetMyEbaySellingService('GetMyeBaySelling');
            $this->syncActiveListings($store, $getMyEbaySellingService);
        }

        public function syncActiveListings(Store $store, GetMyEbaySellingService $getMyEbaySellingService){
            $pageNum = 1;
            $now = Carbon::now();
            do{
                $response = $getMyEbaySellingService->getActiveList($store, $pageNum);
                $server_time = Carbon::parse((string)$response->Timestamp);
                if($response->Ack == 'Success' || $response->Ack == 'Warning'){
                    $itemArray = $response->ActiveList->ItemArray;
                    if($itemArray){
                        $this->saveItems($store, $itemArray, ListingType::ACTIVE, $server_time);
                    }
                    Console::writeln($response->ActiveList->PaginationResult->TotalNumberOfPages . "/" . $pageNum);
                }else{
                    throw new \Exception('Failed to get data from ebay');
                }
                $pageNum++;
            }while($pageNum <= (int)$response->ActiveList->PaginationResult->TotalNumberOfEntries);

            Item::where('updated_at', '<', $now)->delete();
        }

        public function saveItems(Store $store, $itemArray, $status, Carbon $server_time){
            foreach ($itemArray->Item as $item){
                try {
                    Item::updateOrCreate([
                        'store_id'  =>  $store->id,
                        'item_id'  =>  $item->ItemID,
                    ], [
                        'buy_it_now_price'  =>  (double)$item->BuyItNowPrice,
                        'start_time'  =>  Carbon::parse($item->ListingDetails->StartTime)->toDateTimeString(),
                        'view_item_url'  =>  (string)$item->ListingDetails->ViewItemURL,
                        'view_item_url_for_natural_search'  =>  (string)$item->ListingDetails->ViewItemURLForNaturalSearch,
                        'listing_duration'  =>  $item->ListingDuration,
                        'is_global_shipping'  =>  (bool)$item->ShippingDetails,
                        'listing_type'  =>  (string)$item->ListingType,
                        'quantity'  =>  (int)$item->Quantity,
                        'current_price'  =>  (double)$item->SellingStatus->CurrentPrice,
                        'shipping_service_cost'  =>  (double)$item->ShippingDetails->ShippingServiceOptions->ShippingServiceCost,
                        'shipping_type'  =>  (string)$item->ShippingDetails->ShippingType->GlobalShipping,
                        'end_time'  =>  Time::getDateFromISO8061Duration($server_time, (string)$item->TimeLeft),
                        'title'  =>  (string)$item->Title,
                        'sku'  =>  (string)$item->SKU,
                        'gallery_url'  =>  (string)$item->PictureDetails->GalleryURL,
                        'listing_status'  =>  $status,
                    ]);
                } catch (\Exception $e) {
                    Console::writeln($e->getMessage());
                }
            }
        }
}