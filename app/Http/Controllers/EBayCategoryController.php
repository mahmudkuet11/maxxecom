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

    public function getCategoryHierarchyName(Request $request){
        $catID = $request->get('category_id');
        $siteID = $request->get('site_id');
        return $this->service->getCategoryHierarchyName($catID, $siteID);
    }
}
