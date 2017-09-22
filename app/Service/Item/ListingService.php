<?php

namespace App\Service\Item;

use App\Models\Item\Item;
use App\Service\Store\ItemService;

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
}