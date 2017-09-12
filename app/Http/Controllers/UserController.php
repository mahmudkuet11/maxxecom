<?php

namespace App\Http\Controllers;

use App\Http\Requests\Acl\AddUserRequest;
use App\Models\Acl\Permission;
use App\Models\Store;
use App\Service\UserService;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $service;

    function __construct(UserService $userService)
    {
        $this->service = $userService;
    }


    public function getStoreUsers($store_id){
        $users = $this->service->getStoreUsers($store_id)->get();
        return view('dashboard.store.acl.users', [
            'store_id'  =>  $store_id,
            'users' =>  $users
        ]);
    }

    public function addUserToStore($store_id, AddUserRequest $request){
        $res = $this->service->addUserToStore($store_id, $request);
        return redirect()->back()->with($res);
    }

    public function showUsersPermission($store_id, $user_id){
        $store = Store::find($store_id);
        $user = $this->service->getUserWithPermissions($user_id, $store_id)->first();
        return view('dashboard.store.acl.permission', [
            'store' =>  $store,
            'user'  =>  $user
        ]);
    }

    public function updateUsersPermission($store_id, $user_id, Request $request){
        $res = $this->service->updateUsersPermission($store_id, $user_id, $request);
        $data = [];
        if($res){
            $data = [
                'status'    =>  'success',
                'msg'   =>  'permission updated successfully!'
            ];
        }else{
            $data = [
                'status'    =>  'error',
                'msg'   =>  'permission could not be updated!'
            ];
        }
        return redirect()->back()->with($data);
    }
}
