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
        $stores = $this->service->getAll()->filterByUser()->get();
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
            return redirect(route('store.index'))->with([
                'status'    =>  'success',
                'msg'   =>  'Store is added successfully'
            ]);
        }else{
            return redirect(route('store.index'))->with([
                'status'    =>  'error',
                'msg'   =>  'Please try again'
            ]);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $store = $this->service->get($id)->first();
        return view('dashboard.store.edit', ['store'=>$store]);
    }

    public function update(Request $request, $id)
    {
        $res = $this->service->update($request, $id);
        if($res){
            return redirect(route('store.index'))->with([
                'status'    =>  'success',
                'msg'   =>  'Store is updated successfully'
            ]);
        }else{
            return redirect(route('store.index'))->with([
                'status'    =>  'error',
                'msg'   =>  'Please try again'
            ]);
        }
    }

    public function destroy($id)
    {
        //
    }

    public function uploadExcel(){
        return view('dashboard.store.excel-upload', ['active_menu'=>'store.excel.upload']);
    }

    public function saveExcel(Request $request){
        $res = $this->service->saveExcel($request);
        if($res){
            return back()->with([
                'status'=>'success',
                'msg'   =>  'Excel is uploaded successfully'
            ]);
        }
        return back()->with([
            'status'=>'error',
            'msg'   =>  'Excel could not be uploaded'
        ]);
    }
}
