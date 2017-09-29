<?php

namespace App\Service;


use App\Models\EbayCategory;
use Illuminate\Http\Request;

class EBayCategoryService
{
    public function getCategories($site_id, Request $request){
        $node_id = $request->get('node');
        $builder = EbayCategory::where('site_id', $site_id);
        if($node_id){
            $builder = $builder->where('parent_id', $node_id)
                ->whereRaw('category_id <> parent_id');
        }else{
            $builder = $builder->where('level', 1);
        }
        return $builder;
    }

    public function getCategoryHierarchyName($ebayCatID, $siteID){
        $catCollection = collect([]);
        $cat = EbayCategory::where('site_id', $siteID)
            ->where('category_id', $ebayCatID)->first();
        if($cat){
            $level = $cat->level;
            $catCollection->push($cat);
            for ($i=$level; $i>=1; $i--){
                $cat = EbayCategory::where('site_id', $siteID)
                    ->where('category_id', $cat->parent_id)->first();
                $catCollection->push($cat);
            }
            $catCollection->pop();
            return $catCollection->reverse()->implode('name', ' > ');
        }else{
            return '';
        }
    }
}