<?php

namespace App\Http\Controllers;

use App\Http\Requests\Acl\AddUserRequest;
use App\Service\UserService;
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
}
