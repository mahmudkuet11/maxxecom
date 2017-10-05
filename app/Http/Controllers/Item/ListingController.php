<?php

namespace App\Http\Controllers\Item;

use App\Enum\ListingType;
use App\Models\Store;
use App\Service\Item\ListingService;
use App\Service\Store\SettingsService;
use App\Service\Store\StoreService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListingController extends Controller
{
    private $service;

    public function __construct(ListingService $service)
    {
        $this->service = $service;
    }

    public function getActiveListings(Request $request){

        if($request->ajax()){
            $items = $this->service->getAll()->filterByUser()->active();
            return $this->service->prepareOrdersForDataTable($items, $request);
        }else{
            return view('dashboard.item.active-listings', [
                'active_menu'   =>  'item.listing.active'
            ]);
        }
    }

    public function getReviseListing($id, SettingsService $settingsService){
        $item = $this->service->get($id)->with('store')->first();
        $settings = $settingsService->getSettings($item->store->id)->get();
        return view('dashboard.item.revise', [
            'item'  =>  $item,
            'settings'  =>  $settings
        ]);
    }

    public function getItem($id){
        $item = $this->service->getItem($id);
        return $item;
    }

    public function updateListing($id, Request $request){
        try {
            return $this->service->updateListing($id, $request);
        } catch (\Exception $e) {
            return [
                'status'    =>  'error',
                'msg'   =>  $e->getMessage()
            ];
        }
    }

    public function getFindListing(StoreService $storeService){
        $stores = $storeService->getMyStores()->get();
        return view('dashboard.item.find-listing', [
            'active_menu'   =>  'item.listing.find',
            'stores'    =>  $stores
        ]);
    }

    public function getNewListing(Request $request){
        $search = $request->has('store_id') && $request->has('site_id') && $request->has('item_id');
        return view('dashboard.item.new', [
            'active_menu'   =>  'item.listing.find',
            'search'    =>  $search
        ]);
    }

    public function postNewListing($store_id, Request $request){
        $store = Store::find($store_id);
        return $this->service->postNewListing($store, $request);
    }
}
