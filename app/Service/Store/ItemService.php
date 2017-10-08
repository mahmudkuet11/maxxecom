<?php

namespace App\Service\Store;


use App\Enum\ListingType;
use App\Enum\MetaScope;
use App\Exceptions\EbayResponseException;
use App\Models\Item\Image;
use App\Models\Item\Item;
use App\Models\Item\ItemDetail;
use App\Models\Item\Meta;
use App\Models\Item\ShippingServiceOption;
use App\Models\Store;
use App\Service\Console;
use App\Service\eBay\EbayRequest;
use App\Service\eBay\GetItemService;
use App\Service\eBay\GetSellerListService;
use App\Service\Time;
use Carbon\Carbon;
use DB;

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
        $getSellerListService = new GetSellerListService();
        $this->syncActiveListings($store, $getSellerListService);
    }

    public function syncActiveListings(Store $store, GetSellerListService $getSellerListService){
        $pageNum = 0;
        $endFrom = Carbon::today();
        $endTo = Carbon::today()->addDays(40);
        do{
            $pageNum++;
            $response = $getSellerListService->getListingsBetweenEndTime($store, $endFrom, $endTo, $pageNum);
            if($response->Ack == 'Success'){
                $itemArray = $response->ItemArray;
                if($itemArray){
                    $this->saveItems($store, $itemArray);
                }
            }else{
                throw new EbayResponseException($response);
            }
            $totalPages = (int)$response->PaginationResult->TotalNumberOfPages;
            Console::writeln("Total: {$totalPages} . Completed: {$pageNum}");
        }while((string)$response->HasMoreItems == 'true');
    }

    public function saveItems(Store $store, $itemArray){
        foreach ($itemArray->Item as $item){
            try {
                Item::create([
                    'store_id'  =>  $store->id,
                    'item_id'  =>  $item->ItemID,
                ], [
                    'buy_it_now_price'  =>  (double)$item->BuyItNowPrice,
                    'start_time'  =>  Carbon::parse($item->ListingDetails->StartTime)->toDateTimeString(),
                    'view_item_url'  =>  (string)$item->ListingDetails->ViewItemURL,
                    'view_item_url_for_natural_search'  =>  (string)$item->ListingDetails->ViewItemURLForNaturalSearch,
                    'listing_duration'  =>  (string)$item->ListingDuration,
                    'is_global_shipping'  =>  (string)$item->ShippingDetails->GlobalShipping == 'true',
                    'listing_type'  =>  (string)$item->ListingType,
                    'quantity'  =>  (int)$item->Quantity,
                    'current_price'  =>  (double)$item->SellingStatus->CurrentPrice,
                    'shipping_service_cost'  =>  0,
                    'shipping_type'  =>  '',
                    'end_time'  =>  Carbon::parse($item->ListingDetails->EndTime)->toDateTimeString(),
                    'title'  =>  (string)$item->Title,
                    'sku'  =>  (string)$item->SKU,
                    'gallery_url'  =>  (string)$item->PictureDetails->GalleryURL,
                    'listing_status'  =>  (string)$item->SellingStatus->ListingStatus,
                ]);
            } catch (\Exception $e) {
                Console::writeln("File: {$e->getFile()} Line: {$e->getLine()} Message: {$e->getMessage()}");
                \Log::error("File: {$e->getFile()} Line: {$e->getLine()} Message: {$e->getMessage()}");
            }
        }
    }

    public function fetchAndSaveItem($ebayItemId, Store $store){
        $getItemService = new GetItemService();
        $response = $getItemService->getItem($store, $ebayItemId);
        $server_time = Carbon::parse((string)$response->Timestamp);
        DB::beginTransaction();
        try {
            $item = Item::create([
                'store_id'  =>  $store->id,
                'item_id'  =>  $response->Item->ItemID,
                'buy_it_now_price'  =>  (double)$response->Item->BuyItNowPrice,
                'start_time'  =>  Carbon::parse($response->Item->ListingDetails->StartTime)->toDateTimeString(),
                'view_item_url'  =>  (string)$response->Item->ListingDetails->ViewItemURL,
                'view_item_url_for_natural_search'  =>  (string)$response->Item->ListingDetails->ViewItemURLForNaturalSearch,
                'listing_duration'  =>  (string)$response->Item->ListingDuration,
                'is_global_shipping'  =>  (string)$response->Item->ShippingDetails->GlobalShipping == 'true',
                'listing_type'  =>  (string)$response->Item->ListingType,
                'quantity'  =>  (int)$response->Item->Quantity,
                'current_price'  =>  (double)$response->Item->SellingStatus->CurrentPrice,
                'shipping_service_cost'  =>  (double)$response->Item->ShippingDetails->ShippingServiceOptions->ShippingServiceCost,
                'shipping_type'  =>  (string)$response->Item->ShippingDetails->ShippingType->GlobalShipping,
                'end_time'  =>  Time::getDateFromISO8061Duration($server_time, (string)$response->Item->TimeLeft),
                'title'  =>  (string)$response->Item->Title,
                'sku'  =>  (string)$response->Item->SKU,
                'gallery_url'  =>  (string)$response->Item->PictureDetails->GalleryURL,
                'listing_status'  =>  ListingType::ACTIVE,
            ]);

            $excluded_shipping_locations = [];
            foreach ($response->Item->ShippingDetails->ExcludeShipToLocation as $location){
                $excluded_shipping_locations[] = (string)$location;
            }

            $item->item_details()->create([
                'item_id'   =>  $item->id,
                'auto_pay'  =>  (boolean)$response->Item->AutoPay,
                'country'  =>  (string)$response->Item->Country,
                'currency'  =>  (string)$response->Item->Currency,
                'description'  =>  (string)$response->Item->Description,
                'ebay_item_id'  =>  (string)$response->Item->ItemID,
                'start_time'  =>  Carbon::parse($response->Item->ListingDetails->StartTime)->toDateTimeString(),
                'end_time'  =>  Carbon::parse($response->Item->ListingDetails->EndTime)->toDateTimeString(),
                'listing_type'  =>  (string)$response->Item->ListingType,
                'location'  =>  (string)$response->Item->Location,
                'payment_method'  =>  (string)$response->Item->PaymentMethods,
                'paypal_email'  =>  (string)$response->Item->PayPalEmailAddress,
                'primary_category_id'  =>  (int)$response->Item->PrimaryCategory->CategoryID,
                'primary_category_name'  =>  (string)$response->Item->PrimaryCategory->CategoryName,
                'secondary_category_id'  =>  (string)$response->Item->SecondaryCategory->CategoryID,
                'upc'  =>  (string)$response->Item->ProductListingDetails->UPC,
                'brand'  =>  (string)$response->Item->ProductListingDetails->BrandMPN->Brand,
                'quantity'  =>  (int)$response->Item->Quantity,
                'shipping_package'  =>  (string)$response->Item->ShippingPackageDetails->ShippingPackage,
                'weight_major'  =>  (double)$response->Item->ShippingPackageDetails->WeightMajor,
                'weight_minor'  =>  (double)$response->Item->ShippingPackageDetails->WeightMinor,
                'package_length'  =>  (double)$response->Item->ShippingPackageDetails->PackageLength,
                'package_width'  =>  (double)$response->Item->ShippingPackageDetails->PackageWidth,
                'package_depth'  =>  (double)$response->Item->ShippingPackageDetails->PackageDepth,
                'sales_tax_percent'  =>  (double)$response->Item->ShippingDetails->SalesTax->SalesTaxPercent,
                'sales_tax_state'  =>  (string)$response->Item->ShippingDetails->SalesTax->SalesTaxState,
                'is_shipping_included_in_tax'  =>  (boolean)$response->Item->ShippingDetails->SalesTax->ShippingIncludedInTax,
                'use_ebay_tax_table'  =>  (string)$response->UseTaxTable == 'true',
                'shipping_type'  =>  (string)$response->Item->ShippingDetails->ShippingType,
                'ship_to_location'  =>  (string)$response->Item->ShipToLocations,
                'exclude_ship_to_location'  =>  json_encode($excluded_shipping_locations),
                'site'  =>  (string)$response->Item->Site,
                'store_category_id'  =>  (int)$response->Item->Storefront->StoreCategoryID,
                'store_category2_id'  =>  (int)$response->Item->Storefront->StoreCategory2ID,
                'uuid'  =>  (string)$response->Item->UUID,
                'postal_code'  =>  (string)$response->Item->PostalCode,
                'gallery_url'  =>  (string)$response->Item->PictureDetails->GalleryURL,
                'dispatch_time_max'  =>  (int)$response->Item->DispatchTimeMax,
                'refund_option'  =>  (string)$response->Item->ReturnPolicy->RefundOption,
                'returns_within_option'  =>  (string)$response->Item->ReturnPolicy->ReturnsWithinOption,
                'returns_accepted_option'  =>  (string)$response->Item->ReturnPolicy->ReturnsAcceptedOption,
                'return_policy_description'  =>  (string)$response->Item->ReturnPolicy->Description,
                'return_shipping_cost_paid_by'  =>  (string)$response->Item->ReturnPolicy->ShippingCostPaidByOption,
                'return_restocking_fee'  =>  (string)$response->Item->ReturnPolicy->RestockingFeeValueOption,
                'condition_id'  =>  (int)$response->Item->ConditionID,
                'hide_from_search'  =>  (boolean)$response->Item->HideFromSearch,
                'out_of_stock_control'  =>  (boolean)$response->Item->OutOfStockControl,
            ]);
            foreach ($response->Item->PictureDetails->PictureURL as $pic){
                $item->images()->create([
                    'item_id'   =>  $item->id,
                    'url'   =>  (string)$pic
                ]);
            }

            foreach ($response->Item->ShippingDetails->ShippingServiceOptions as $opt){
                $item->shipping_service_options()->create([
                    'item_id'   =>  $item->id,
                    'shipping_service'  =>  (string)$opt->ShippingService,
                    'shipping_service_cost'  =>  (double)$opt->ShippingServiceCost,
                    'shipping_service_additional_cost'  =>  (double)$opt->ShippingServiceAdditionalCost,
                    'surcharge'  =>  (double)$opt->ShippingSurcharge,
                    'shipping_service_priority'  =>  (int)$opt->ShippingServicePriority,
                    'shipping_time_min'  =>  (int)$opt->ShippingTimeMin,
                    'shipping_time_max'  =>  (int)$opt->ShippingTimeMax,
                    'free_shipping'  =>  (boolean)$opt->FreeShipping,
                ]);
            }
            if(isset($response->Item->ItemCompatibilityList->Compatibility)){
                foreach ($response->Item->ItemCompatibilityList->Compatibility as $compatibility){
                    $data = [];
                    foreach ($compatibility->NameValueList as $nameValueList){
                        $name = (string)$nameValueList->Name;
                        $value = (string)$nameValueList->Value;
                        if($name){
                            $data[$name] = $value;
                        }
                    }
                    $item->compatibility_metas()->create([
                        'reference_id'   =>  $item->id,
                        'name'  =>  'NameValueList',
                        'value'  =>  json_encode($data),
                        'scope' =>  MetaScope::ITEM_COMPATIBILITY_LIST
                    ]);
                }
            }

            foreach ($response->Item->ItemSpecifics->NameValueList as $specs){
                foreach ($specs->Value as $val){
                    $item->specifics_metas()->create([
                        'reference_id'   =>  $item->id,
                        'name'  =>  (string)$specs->Name,
                        'value'  =>  (string)$val,
                        'scope' =>  MetaScope::ITEM_SPECIFICS
                    ]);
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function fetchAndSaveItemDetails($ebayItemId){
        $item = Item::where('item_id', $ebayItemId)->first();
        $getItemService = new GetItemService();
        $response = $getItemService->getItem($item->store, $item->item_id);
        $server_time = Carbon::parse((string)$response->Timestamp);
        if($response->Ack == 'Success'){
            DB::beginTransaction();
            try {

                $item->update([
                    'item_id'  =>  $response->Item->ItemID,
                    'buy_it_now_price'  =>  (double)$response->Item->BuyItNowPrice,
                    'start_time'  =>  Carbon::parse($response->Item->ListingDetails->StartTime)->toDateTimeString(),
                    'view_item_url'  =>  (string)$response->Item->ListingDetails->ViewItemURL,
                    'view_item_url_for_natural_search'  =>  (string)$response->Item->ListingDetails->ViewItemURLForNaturalSearch,
                    'listing_duration'  =>  (string)$response->Item->ListingDuration,
                    'is_global_shipping'  =>  (string)$response->Item->ShippingDetails->GlobalShipping == 'true',
                    'listing_type'  =>  (string)$response->Item->ListingType,
                    'quantity'  =>  (int)$response->Item->Quantity,
                    'current_price'  =>  (double)$response->Item->SellingStatus->CurrentPrice,
                    'shipping_service_cost'  =>  (double)$response->Item->ShippingDetails->ShippingServiceOptions->ShippingServiceCost,
                    'shipping_type'  =>  (string)$response->Item->ShippingDetails->ShippingType->GlobalShipping,
                    'end_time'  =>  Time::getDateFromISO8061Duration($server_time, (string)$response->Item->TimeLeft),
                    'title'  =>  (string)$response->Item->Title,
                    'sku'  =>  (string)$response->Item->SKU,
                    'gallery_url'  =>  (string)$response->Item->PictureDetails->GalleryURL,
                ]);

                $excluded_shipping_locations = [];
                foreach ($response->Item->ShippingDetails->ExcludeShipToLocation as $location){
                    $excluded_shipping_locations[] = (string)$location;
                }

                $item->item_details()->updateOrCreate([
                    'item_id'   =>  $item->id
                ], [
                    'auto_pay'  =>  (boolean)$response->Item->AutoPay,
                    'country'  =>  (string)$response->Item->Country,
                    'currency'  =>  (string)$response->Item->Currency,
                    'description'  =>  (string)$response->Item->Description,
                    'ebay_item_id'  =>  (string)$response->Item->ItemID,
                    'start_time'  =>  Carbon::parse($response->Item->ListingDetails->StartTime)->toDateTimeString(),
                    'end_time'  =>  Carbon::parse($response->Item->ListingDetails->EndTime)->toDateTimeString(),
                    'listing_type'  =>  (string)$response->Item->ListingType,
                    'location'  =>  (string)$response->Item->Location,
                    'payment_method'  =>  (string)$response->Item->PaymentMethods,
                    'paypal_email'  =>  (string)$response->Item->PayPalEmailAddress,
                    'primary_category_id'  =>  (int)$response->Item->PrimaryCategory->CategoryID,
                    'primary_category_name'  =>  (string)$response->Item->PrimaryCategory->CategoryName,
                    'secondary_category_id'  =>  (string)$response->Item->SecondaryCategory->CategoryID,
                    'upc'  =>  (string)$response->Item->ProductListingDetails->UPC,
                    'brand'  =>  (string)$response->Item->ProductListingDetails->BrandMPN->Brand,
                    'quantity'  =>  (int)$response->Item->Quantity,
                    'shipping_package'  =>  (string)$response->Item->ShippingPackageDetails->ShippingPackage,
                    'weight_major'  =>  (double)$response->Item->ShippingPackageDetails->WeightMajor,
                    'weight_minor'  =>  (double)$response->Item->ShippingPackageDetails->WeightMinor,
                    'package_length'  =>  (double)$response->Item->ShippingPackageDetails->PackageLength,
                    'package_width'  =>  (double)$response->Item->ShippingPackageDetails->PackageWidth,
                    'package_depth'  =>  (double)$response->Item->ShippingPackageDetails->PackageDepth,
                    'sales_tax_percent'  =>  (double)$response->Item->ShippingDetails->SalesTax->SalesTaxPercent,
                    'sales_tax_state'  =>  (string)$response->Item->ShippingDetails->SalesTax->SalesTaxState,
                    'is_shipping_included_in_tax'  =>  (boolean)$response->Item->ShippingDetails->SalesTax->ShippingIncludedInTax,
                    'use_ebay_tax_table'  =>  (string)$response->UseTaxTable == 'true',
                    'shipping_type'  =>  (string)$response->Item->ShippingDetails->ShippingType,
                    'ship_to_location'  =>  (string)$response->Item->ShipToLocations,
                    'exclude_ship_to_location'  =>  json_encode($excluded_shipping_locations),
                    'site'  =>  (string)$response->Item->Site,
                    'store_category_id'  =>  (int)$response->Item->Storefront->StoreCategoryID,
                    'store_category2_id'  =>  (int)$response->Item->Storefront->StoreCategory2ID,
                    'uuid'  =>  (string)$response->Item->UUID,
                    'postal_code'  =>  (string)$response->Item->PostalCode,
                    'gallery_url'  =>  (string)$response->Item->PictureDetails->GalleryURL,
                    'dispatch_time_max'  =>  (int)$response->Item->DispatchTimeMax,
                    'refund_option'  =>  (string)$response->Item->ReturnPolicy->RefundOption,
                    'returns_within_option'  =>  (string)$response->Item->ReturnPolicy->ReturnsWithinOption,
                    'returns_accepted_option'  =>  (string)$response->Item->ReturnPolicy->ReturnsAcceptedOption,
                    'return_policy_description'  =>  (string)$response->Item->ReturnPolicy->Description,
                    'return_shipping_cost_paid_by'  =>  (string)$response->Item->ReturnPolicy->ShippingCostPaidByOption,
                    'return_restocking_fee'  =>  (string)$response->Item->ReturnPolicy->RestockingFeeValueOption,
                    'condition_id'  =>  (int)$response->Item->ConditionID,
                    'hide_from_search'  =>  (boolean)$response->Item->HideFromSearch,
                    'out_of_stock_control'  =>  (boolean)$response->Item->OutOfStockControl,
                ]);
                foreach ($response->Item->PictureDetails->PictureURL as $pic){
                    $item->images()->updateOrCreate([
                        'item_id'   =>  $item->id,
                        'url'   =>  (string)$pic
                    ], []);
                }

                foreach ($response->Item->ShippingDetails->ShippingServiceOptions as $opt){
                    $item->shipping_service_options()->updateOrCreate([
                        'item_id'   =>  $item->id,
                        'shipping_service'  =>  (string)$opt->ShippingService,
                    ], [
                        'shipping_service_cost'  =>  (double)$opt->ShippingServiceCost,
                        'shipping_service_additional_cost'  =>  (double)$opt->ShippingServiceAdditionalCost,
                        'surcharge'  =>  (double)$opt->ShippingSurcharge,
                        'shipping_service_priority'  =>  (int)$opt->ShippingServicePriority,
                        'shipping_time_min'  =>  (int)$opt->ShippingTimeMin,
                        'shipping_time_max'  =>  (int)$opt->ShippingTimeMax,
                        'free_shipping'  =>  (boolean)$opt->FreeShipping,
                    ]);
                }
                if(isset($response->Item->ItemCompatibilityList->Compatibility)){
                    foreach ($response->Item->ItemCompatibilityList->Compatibility as $compatibility){
                        $data = [];
                        foreach ($compatibility->NameValueList as $nameValueList){
                            $name = (string)$nameValueList->Name;
                            $value = (string)$nameValueList->Value;
                            if($name){
                                $data[$name] = $value;
                            }
                        }
                        $item->compatibility_metas()->updateOrCreate([
                            'reference_id'   =>  $item->id,
                            'name'  =>  'NameValueList',
                            'value'  =>  json_encode($data),
                            'scope' =>  MetaScope::ITEM_COMPATIBILITY_LIST
                        ], []);
                    }
                }

                foreach ($response->Item->ItemSpecifics->NameValueList as $specs){
                    foreach ($specs->Value as $val){
                        $item->specifics_metas()->updateOrCreate([
                            'reference_id'   =>  $item->id,
                            'name'  =>  (string)$specs->Name,
                            'value'  =>  (string)$val,
                            'scope' =>  MetaScope::ITEM_SPECIFICS
                        ], []);
                    }
                }
                DB::commit();
                return true;
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }
        }
        throw new \Exception(json_encode(EbayRequest::parseErrorMessage($response)));
    }

    public function findItem(Store $store, $item_id){
        $getItemService = new GetItemService();
        $response = $getItemService->getItem($store, $item_id);
        if($response->Ack == 'Success'){
            $item = new Item();
            $item = $item->fill([
                'store_id'  =>  $store->id,
                'buy_it_now_price'  =>  (double)$response->Item->BuyItNowPrice,
                'view_item_url'  =>  (string)$response->Item->ListingDetails->ViewItemURL,
                'view_item_url_for_natural_search'  =>  (string)$response->Item->ListingDetails->ViewItemURLForNaturalSearch,
                'listing_duration'  =>  (string)$response->Item->ListingDuration,
                'is_global_shipping'  =>  (string)$response->Item->ShippingDetails->GlobalShipping == 'true',
                'listing_type'  =>  (string)$response->Item->ListingType,
                'quantity'  =>  (int)$response->Item->Quantity,
                'current_price'  =>  (double)$response->Item->SellingStatus->CurrentPrice,
                'shipping_service_cost'  =>  (double)$response->Item->ShippingDetails->ShippingServiceOptions->ShippingServiceCost,
                'shipping_type'  =>  (string)$response->Item->ShippingDetails->ShippingType->GlobalShipping,
                'title'  =>  (string)$response->Item->Title,
                'sku'  =>  (string)$response->Item->SKU,
                'gallery_url'  =>  (string)$response->Item->PictureDetails->GalleryURL,
            ]);

            $excluded_shipping_locations = [];
            foreach ($response->Item->ShippingDetails->ExcludeShipToLocation as $location){
                $excluded_shipping_locations[] = (string)$location;
            }

            $item->item_details = (new ItemDetail())->fill([
                'auto_pay'  =>  (boolean)$response->Item->AutoPay,
                'country'  =>  (string)$response->Item->Country,
                'currency'  =>  (string)$response->Item->Currency,
                'description'  =>  (string)$response->Item->Description,
                'ebay_item_id'  =>  (string)$response->Item->ItemID,
                'start_time'  =>  Carbon::parse($response->Item->ListingDetails->StartTime)->toDateTimeString(),
                'end_time'  =>  Carbon::parse($response->Item->ListingDetails->EndTime)->toDateTimeString(),
                'listing_type'  =>  (string)$response->Item->ListingType,
                'location'  =>  (string)$response->Item->Location,
                'payment_method'  =>  (string)$response->Item->PaymentMethods,
                'paypal_email'  =>  (string)$response->Item->PayPalEmailAddress,
                'primary_category_id'  =>  (int)$response->Item->PrimaryCategory->CategoryID,
                'primary_category_name'  =>  (string)$response->Item->PrimaryCategory->CategoryName,
                'secondary_category_id'  =>  (string)$response->Item->SecondaryCategory->CategoryID,
                'upc'  =>  (string)$response->Item->ProductListingDetails->UPC,
                'brand'  =>  (string)$response->Item->ProductListingDetails->BrandMPN->Brand,
                'quantity'  =>  (int)$response->Item->Quantity,
                'shipping_package'  =>  (string)$response->Item->ShippingPackageDetails->ShippingPackage,
                'weight_major'  =>  (double)$response->Item->ShippingPackageDetails->WeightMajor,
                'weight_minor'  =>  (double)$response->Item->ShippingPackageDetails->WeightMinor,
                'package_length'  =>  (double)$response->Item->ShippingPackageDetails->PackageLength,
                'package_width'  =>  (double)$response->Item->ShippingPackageDetails->PackageWidth,
                'package_depth'  =>  (double)$response->Item->ShippingPackageDetails->PackageDepth,
                'sales_tax_percent'  =>  (double)$response->Item->ShippingDetails->SalesTax->SalesTaxPercent,
                'sales_tax_state'  =>  (string)$response->Item->ShippingDetails->SalesTax->SalesTaxState,
                'is_shipping_included_in_tax'  =>  (boolean)$response->Item->ShippingDetails->SalesTax->ShippingIncludedInTax,
                'use_ebay_tax_table'  =>  (string)$response->UseTaxTable == 'true',
                'shipping_type'  =>  (string)$response->Item->ShippingDetails->ShippingType,
                'ship_to_location'  =>  json_encode($excluded_shipping_locations),
                'site'  =>  (string)$response->Item->Site,
                'store_category_id'  =>  (int)$response->Item->Storefront->StoreCategoryID,
                'store_category2_id'  =>  (int)$response->Item->Storefront->StoreCategory2ID,
                'uuid'  =>  (string)$response->Item->UUID,
                'postal_code'  =>  (string)$response->Item->PostalCode,
                'gallery_url'  =>  (string)$response->Item->PictureDetails->GalleryURL,
                'dispatch_time_max'  =>  (int)$response->Item->DispatchTimeMax,
                'refund_option'  =>  (string)$response->Item->ReturnPolicy->RefundOption,
                'returns_within_option'  =>  (string)$response->Item->ReturnPolicy->ReturnsWithinOption,
                'returns_accepted_option'  =>  (string)$response->Item->ReturnPolicy->ReturnsAcceptedOption,
                'return_policy_description'  =>  (string)$response->Item->ReturnPolicy->Description,
                'return_shipping_cost_paid_by'  =>  (string)$response->Item->ReturnPolicy->ShippingCostPaidByOption,
                'return_restocking_fee'  =>  (string)$response->Item->ReturnPolicy->RestockingFeeValueOption,
                'condition_id'  =>  (int)$response->Item->ConditionID,
                'hide_from_search'  =>  (boolean)$response->Item->HideFromSearch,
                'out_of_stock_control'  =>  (boolean)$response->Item->OutOfStockControl,
            ])->toArray();

            foreach ($response->Item->PictureDetails->PictureURL as $pic){
                $item->images[] = (new Image())->fill([
                    'url'   =>  (string)$pic
                ])->toArray();
            }

            foreach ($response->Item->ShippingDetails->ShippingServiceOptions as $opt){
                $item->shipping_service_options[] = (new ShippingServiceOption())->fill([
                    'shipping_service'  =>  (string)$opt->ShippingService,
                    'shipping_service_cost'  =>  (double)$opt->ShippingServiceCost,
                    'shipping_service_additional_cost'  =>  (double)$opt->ShippingServiceAdditionalCost,
                    'surcharge'  =>  (double)$opt->ShippingSurcharge,
                    'shipping_service_priority'  =>  (int)$opt->ShippingServicePriority,
                    'shipping_time_min'  =>  (int)$opt->ShippingTimeMin,
                    'shipping_time_max'  =>  (int)$opt->ShippingTimeMax,
                    'free_shipping'  =>  (boolean)$opt->FreeShipping,
                ])->toArray();
            }


            if(isset($response->Item->ItemCompatibilityList->Compatibility)){
                foreach ($response->Item->ItemCompatibilityList->Compatibility as $compatibility){
                    $data = [];
                    foreach ($compatibility->NameValueList as $nameValueList){
                        $name = (string)$nameValueList->Name;
                        $value = (string)$nameValueList->Value;
                        if($name){
                            $data[$name] = $value;
                        }
                    }
                    $item->compatibility_metas[] = (new Meta())->fill([
                        'name'  =>  'NameValueList',
                        'value'  =>  json_encode($data),
                        'scope' =>  MetaScope::ITEM_COMPATIBILITY_LIST
                    ])->toArray();
                }
            }

            foreach ($response->Item->ItemSpecifics->NameValueList as $specs){
                foreach ($specs->Value as $val){
                    $item->specifics_metas[] = (new Meta())->fill([
                        'name'  =>  (string)$specs->Name,
                        'value'  =>  (string)$val,
                        'scope' =>  MetaScope::ITEM_SPECIFICS
                    ])->toArray();
                }
            }

            return [
                'status'    =>  'success',
                'item'  =>  $item->toArray()
            ];
        }
        return [
            'status'    =>  'error',
            'item'  =>  ''
        ];
    }
}
