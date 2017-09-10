<?php
namespace App\Service\Store;

use App\Enum\Ebay\Scope;
use App\Jobs\SetupStoreJob;
use App\Jobs\SyncStoreJob;
use App\Models\Store;
use App\Service\eBay\GetOrderService;
use App\Service\Order\OrderService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;

class StoreService
{
    public function store(Request $request){
        $store = Store::create([
            'owner_id'  =>  Auth::user()->id,
            'name'  =>  $request->get('name'),
            'site_id'  =>  $request->get('site_id'),
            'auth_token'  =>  $request->get('auth_token'),
            'oauth_token'  =>  $request->get('oauth_token'),
        ]);

        dispatch(new SetupStoreJob($store));

        return $store;
    }

    public function update(Request $request, $id){
        $store = self::get($id)->update([
            'name'  =>  $request->get('name'),
            'site_id'  =>  $request->get('site_id'),
            'auth_token'  =>  $request->get('auth_token'),
            'oauth_token'  =>  $request->get('oauth_token'),
        ]);
        return $store;
    }

    public function getAll(){
        return new Store();
    }

    public function get($id){
        return Store::where('id', $id);
    }

    public function syncAll($forceSync = false){
        $stores = self::getAll()->where('is_syncing', false)->with('orderSynchronization')->get();
        foreach ($stores as $store){
            if($forceSync || $store->needToSync){
                dispatch(new SyncStoreJob($store));
            }
        }
    }

    public function setUp($store){
        $syncService = new SyncService();
        $from = Carbon::now()->subDays(25);
        $to = Carbon::now();
        $getOrderService = new GetOrderService();
        $orderService = new OrderService();
        $pageNum = 1;
        do{
            $response = $getOrderService->getCreatedBetween($store, $from, $to, $pageNum);
            if($response->Ack == 'Success'){
                if(isset($response->OrderArray->Order)){
                    $orderService->saveOrders($store, $response);
                }
            }else{
                throw new \Exception('Failed');
            }
            $pageNum++;
        }while($response->HasMoreOrders == 'true' && ((int)$response->PageNumber <= (int)$response->PaginationResult->TotalNumberOfPages));
        $syncService->setLastSyncTime($store, $to, Scope::ORDER);
    }

    public function syncStore(Store $store, $forceSync = false){
        $syncService = new SyncService();
        $from = $syncService->getLastSyncedTime($store);
        $to = Carbon::now();
        if(!$forceSync && $from->diffInMinutes($to) < config('order.min_sync_after')){
            return true;
        }
        $getOrderService = new GetOrderService();
        $orderService = new OrderService();
        $pageNum = 1;
        do{
            $response = $getOrderService->getModifiedBetween($store, $from, $to, $pageNum);
            if($response->Ack == 'Success'){
                if(isset($response->OrderArray->Order)){
                    $orderService->saveOrders($store, $response);
                }
            }else{
                throw new \Exception('Failed to connect with ebay API');
            }
            $pageNum++;
        }while($response->HasMoreOrders == 'true' && ((int)$response->PageNumber <= (int)$response->PaginationResult->TotalNumberOfPages));
        $syncService->setLastSyncTime($store, $to, Scope::ORDER);
    }
}