<?php

namespace App\Service\Item;

use App\Enum\MetaScope;
use App\Models\Item\Item;
use App\Models\Item\ItemDetail;
use App\Models\Item\Meta;
use App\Models\Store;
use App\Service\eBay\AddItemService;
use App\Service\eBay\EbayRequest;
use App\Service\eBay\ReviseItemService;
use App\Service\ListingDescService;
use App\Service\Store\ItemService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

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
                'msg'   =>  'Listing is updated successfully',
                'errors'    =>  EbayRequest::parseErrorMessage($response)
            ];

        }else{
            return [
                'status'    =>  'error',
                'msg'   =>  'Listing could not be updated',
                'errors'    =>  EbayRequest::parseErrorMessage($response)
            ];
        }
    }

    public function postNewListing(Store $store, Request $request){
        $addItemService = new AddItemService();
        $response = $addItemService->addItem($store, $request);
        if($response->Ack == 'Success' || $response->Ack == 'Warning'){
            $itemService = new ItemService();
            try {
                $res = $itemService->fetchAndSaveItem((string)$response->ItemID, $store);
                if($res){
                    return [
                        'status'    =>  'success',
                        'msg'   =>  'Item is listed successfully',
                        'errors'    =>  EbayRequest::parseErrorMessage($response)
                    ];
                }
            } catch (\Exception $e) {
                return [
                    'status'    =>  'error',
                    'msg'   =>  $e->getTraceAsString(),
                    'errors'    =>  EbayRequest::parseErrorMessage($response)
                ];
            }
        }
        return [
            'status'    =>  'error',
            'msg'   =>  'Item could not be listed',
            'errors'    =>  EbayRequest::parseErrorMessage($response)
        ];
    }

    public function prepareOrdersForDataTable(Builder $itemBuilder, Request $request){
        $start = $request->get('start');
        $length = $request->get('length');
        $draw = $request->get('draw');
        $search = $request->get('search')['value'];

        $itemBuilder = $itemBuilder->search($search);
        $all_items = $itemBuilder->get();
        $items = $itemBuilder->skip($start)->take($length)->get();
        $response = [
            'draw'  =>  $draw,
            'recordsTotal'  =>  $all_items->count(),
            'recordsFiltered'  =>  $all_items->count(),
            'data'  =>  []
        ];
        $items->each(function($item) use (&$response){
            $response['data'][] = [
                $item->gallery_url,
                $item->title,
                $item->sku,
                $item->current_price,
                $item->quantity,
                $item->end_time,
                $item->id,
            ];
        });
        return $response;
    }

}