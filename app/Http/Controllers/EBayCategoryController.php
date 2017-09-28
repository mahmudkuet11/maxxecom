<?php

namespace App\Http\Controllers;

use App\Service\EBayCategoryService;
use Illuminate\Http\Request;

class EBayCategoryController extends Controller
{
    private $service;

    public function __construct(EBayCategoryService $service)
    {
        $this->service = $service;
    }

    public function getCategories($site_id, Request $request){
        return $this->service->getCategories($site_id, $request)->get();
    }
}
