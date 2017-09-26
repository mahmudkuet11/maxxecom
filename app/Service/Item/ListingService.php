<?php

namespace App\Service\Item;

use App\Models\Item\Item;
use App\Models\Item\ItemDetail;
use App\Service\eBay\ReviseItemService;
use App\Service\Store\ItemService;
use Illuminate\Http\Request;

class ListingService
{
    public function getAll(){
        return new Item();
    }

    public function get($id){
        return Item::where('id', $id);
    }

    public function getItem($id){
        $itemBuilder = Item::where('id', $id)
            ->with('item_details', 'images', 'compatibility_metas', 'specifics_metas', 'shipping_service_options');
        $item = $itemBuilder->first();
        if($item->item_details == null){
            $itemService = new ItemService();
            $itemService->fetchAndSaveItemDetails($item->item_id);
            $item = $itemBuilder->first();
        }
        return $item;
    }

    public function updateListing($id, Request $request){
        $item = Item::with('store')->where('id', $id)->first();
        $store = $item->store;
        $reviseItemService = new ReviseItemService();
        $response = $reviseItemService->updateList($item, $store, $request);
        if($response->Ack == 'Warning' || $response->Ack == 'Success'){
            $itemService = new ItemService();
            $itemService->fetchAndSaveItemDetails($item->item_id);
            return [
                'status'    =>  'success',
                'msg'   =>  'Listing is updated successfully'
            ];

        }else{
            return [
                'status'    =>  'error',
                'msg'   =>  'Listing could not be updated'
            ];
        }
    }
}