<?php

namespace App\Service;

use App\Models\Acl\Permission;
use App\Models\UserStore;
use Illuminate\Http\Request;
use App\User;
use DB;

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

    public function updateUsersPermission($store_id, $user_id, Request $request){
        $permissions = $request->get('permission');
        DB::beginTransaction();
        try {
            Permission::where('store_id', $store_id)->where('user_id', $user_id)->delete();
            foreach ($permissions as $permission){
                Permission::updateOrCreate([
                    'store_id'  =>  $store_id,
                    'user_id'   =>  $user_id,
                    'permission'    =>  $permission
                ]);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public function getUserWithPermissions($user_id, $store_id = null){
        $user = User::with('permissions')->where('id', $user_id);
        if($store_id){
            $user = $user->with(['permissions'=>function($query) use ($store_id){
                $query->where('store_id', $store_id);
            }]);
        }
        return $user;
    }

    public function hasPermission($userPermissions, $search){
        $permission = $userPermissions->where('permission', $search)->first();
        if($permission) return true;
        return false;
    }
}