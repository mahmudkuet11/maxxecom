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
            'name'  =>  $request->get('name'),
            'site_id'  =>  $request->get('site_id'),
            'dev_id'  =>  $request->get('dev_id'),
            'app_id'  =>  $request->get('app_id'),
            'cert_id'  =>  $request->get('cert_id'),
            'auth_token'  =>  $request->get('auth_token'),
            'oauth_token'  =>  $request->get('oauth_token'),
        ]);
    }

    public function update(Request $request, $id){
        $store = self::get($id)->update([
            'name'  =>  $request->get('name'),
            'site_id'  =>  $request->get('site_id'),
            'dev_id'  =>  $request->get('dev_id'),
            'app_id'  =>  $request->get('app_id'),
            'cert_id'  =>  $request->get('cert_id'),
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
}