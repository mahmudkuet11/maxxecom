<?php
namespace App\Service\Store;

use App\Models\Store;
use Illuminate\Http\Request;
use Auth;

class StoreService
{
    public function store(Request $request){
        return Store::create([
            'owner_id'  =>  Auth::user()->id,
            'site_mode'  =>  $request->get('site_mode'),
            'name'  =>  $request->get('name'),
            'site_id'  =>  $request->get('site_id'),
            'sandbox_dev_id'  =>  $request->get('sandbox_dev_id'),
            'sandbox_app_id'  =>  $request->get('sandbox_app_id'),
            'sandbox_cert_id'  =>  $request->get('sandbox_cert_id'),
            'sandbox_auth_token'  =>  $request->get('sandbox_auth_token'),
            'sandbox_oauth_token'  =>  $request->get('sandbox_oauth_token'),
            'production_dev_id'  =>  $request->get('production_dev_id'),
            'production_app_id'  =>  $request->get('production_app_id'),
            'production_cert_id'  =>  $request->get('production_cert_id'),
            'production_auth_token'  =>  $request->get('production_auth_token'),
            'production_oauth_token'  =>  $request->get('production_oauth_token'),
        ]);
    }

    public function getAll(){
        return new Store();
    }
}