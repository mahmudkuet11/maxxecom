<?php

namespace App\Http\Controllers\Store;

use App\Models\Store;
use App\Service\Store\SettingsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class SettingsController extends Controller
{
    private $service;

    function __construct(SettingsService $service)
    {
        $this->service = $service;
    }

    public function getSettings($store_id){
        $store = Store::where('id', $store_id)->first();
        $settings = $this->service->getSettings($store_id)->get();
        return view('dashboard.store.settings', [
            'store' =>  $store,
            'settings'  =>  $settings
        ]);
    }

    public function updateSettings($store_id, Request $request){
        DB::beginTransaction();
        try {
            $this->service->updateSettings($store_id, $request);
            DB::commit();
            return [
                'status'    =>  'success',
                'msg'   =>  'Settings are updated successfully!'
            ];
        } catch (\Exception $e) {
            DB::rollback();
            return [
                'status'    =>  'error',
                'msg'   =>  'Settings could not be updated!'
            ];
        }
    }
}
