<?php

namespace App\Http\Controllers;

use App\Service\MetaService;
use Illuminate\Http\Request;

class MetaController extends Controller
{
    private $service;

    function __construct(MetaService $service)
    {
        $this->service = $service;
    }

    public function save(Request $request){
        try{
            $res = $this->service->save($request);
            if($res){
                return [
                    'status'    =>  'success',
                    'msg'   =>  'Meta saved successfully'
                ];
            }else{
                throw new \Exception('Meta could not be saved');
            }
        }catch (\Exception $e){
            return [
                'status'    =>  'error',
                'msg'   =>  $e->getMessage()
            ];
        }
    }

    public function get(Request $request){
        return $this->service->get($request)->get();
    }
}
