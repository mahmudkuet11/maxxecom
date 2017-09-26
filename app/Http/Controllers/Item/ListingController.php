<?php

namespace App\Http\Controllers\Item;

use App\Enum\ListingType;
use App\Service\Item\ListingService;
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

    public function getActiveListings(){
        $items = $this->service->getAll()->filterByUser()->active()->get();
        return view('dashboard.item.active-listings', [
            'active_menu'   =>  'item.listing.active',
            'items' =>  $items
        ]);
    }

    public function getReviseListing($id){
        $item = $this->service->get($id)->first();
        return view('dashboard.item.revise', [
            'item'  =>  $item
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
}
