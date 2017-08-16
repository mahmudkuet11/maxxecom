<?php

namespace App\Http\Controllers\Store;

use App\Http\Requests\Store\StoreStoreRequest;
use App\Service\Store\StoreService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{

    private $service;

    public function __construct(StoreService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $stores = $this->service->getAll()->get();
        return view('dashboard.store.index', ['active_menu'=>'store.index', 'stores'=>$stores]);
    }

    public function create()
    {
        return view('dashboard.store.create', ['active_menu'=>'store.create']);
    }

    public function store(StoreStoreRequest $request)
    {
        $res = $this->service->store($request);
        if($res){
            return 'success';
        }else{
            return 'error';
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
