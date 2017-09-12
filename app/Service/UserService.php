<?php

namespace App\Service;

use App\Models\UserStore;
use App\User;
use Illuminate\Http\Request;

class UserService
{
    public function getStoreUsers($store_id){
        return User::with('user_stores')->whereHas('user_stores', function($query) use ($store_id){
            $query->where('store_id', $store_id);
        });
    }

    public function addUserToStore($store_id, Request $request){
        $email = $request->get('email');
        $user = User::where('email', $email)->first();
        if( ! $user ){
            return [
                'status'    =>  'error',
                'msg'   =>  $email . ' not found!'
            ];
        }
        $userStore = UserStore::where('user_id', $user->id)->where('store_id', $store_id)->first();
        if($userStore){
            return [
                'status'    =>  'error',
                'msg'   =>  $email . ' is already added in the store!'
            ];
        }
        $res = UserStore::Create([
            'user_id'   =>  $user->id,
            'store_id'  =>  $store_id
        ]);
        if($res){
            return [
                'status'    =>  'success',
                'msg'   =>  $email . ' added successfully!'
            ];
        }else{
            return [
                'status'    =>  'error',
                'msg'   =>  $email . ' could not be added!'
            ];
        }
    }
}