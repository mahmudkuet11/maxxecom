<?php

namespace App\Service;


use App\Models\Item\Meta;
use Illuminate\Http\Request;

class MetaService
{
    public function save(Request $request){
        $ref_id = $request->get('reference_id');
        $name = $request->get('name');
        $value = $request->get('value');
        $scope = $request->get('scope');

        return Meta::updateOrCreate([
            'reference_id'  =>  $ref_id,
            'name'  =>  $name,
            'value' =>  $value,
            'scope' =>  $scope
        ], []);

    }

    public function get(Request $request){
        $ref_id = $request->get('reference_id');
        $name = $request->get('name');
        $scope = $request->get('scope');

        return Meta::where('reference_id', $ref_id)
                    ->where('name', $name)
                    ->where('scope', $scope);
    }
}