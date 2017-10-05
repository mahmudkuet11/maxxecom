<?php

namespace App\Service;


use App\Enum\MetaScope;
use App\Models\Item\Item;
use App\Models\Item\ItemDetail;
use App\Models\Item\Meta;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Log;
use PhpParser\Node\Expr\Cast\Object_;

class ListingDescService
{
    public $resourceUrl;

    function __construct()
    {
        $this->resourceUrl = 'https://apn.maxxecom.com/';
    }

    private function getDescriptionHtml(Item $item){
        $view = view('template.apn', [
            'item'=>$item,
            'url'   =>  $this->resourceUrl
        ])->render();
        return $view;
    }

    public function getGroupedCompatibilityMetas(Collection $metas){
        $compatibilities = $metas->pluck('value')->map(function($item){
            return json_decode($item);
        })->groupBy(function($item){
            return "{$item->Make}_{$item->Model}";
        });
        return $compatibilities;
    }

    public function getCompatibilityDataForGroup(Collection $item){
        $compatibility = $item->first();
        $make = $compatibility->Make;
        $model = $compatibility->Model;
        $year_min = 3000;
        $year_max = 0;
        $item->each(function($item) use (&$year_min){
            if((int)$item->Year <= $year_min){
                $year_min = $item->Year;
            }
        });
        $item->each(function($item) use (&$year_max){
            if((int)$item->Year >= $year_max){
                $year_max = $item->Year;
            }
        });
        return [
            'year'  =>  $year_min . "-" . $year_max,
            'make'  =>  $make,
            'model' =>  $model
        ];
    }

    public function prepareDescription(Request $request){
        $item = Item::make([
            'title' =>  $request->get('title'),
            'gallery_url' =>  $request->get('images')[0],
        ]);

        $item->item_details = ItemDetail::make([
            'condition_id'  =>  $request->get('condition_id')
        ]);

        $item->specifics_metas = collect([]);
        foreach ($request->get('specifics') as $spec){
            $item->specifics_metas->push(Meta::make([
                'name'  =>  $spec['name'],
                'value' =>  $spec['value'],
                'scope' =>  MetaScope::ITEM_SPECIFICS
            ]));
        }
        $item->compatibility_metas = collect([]);
        foreach ($request->get('compatibilities') as $compatibility){
            $item->compatibility_metas->push(Meta::make([
                'name'  =>  'NameValueList',
                'value' =>  json_encode([
                    'Make'  =>  $compatibility['make'],
                    'Model'  =>  $compatibility['model'],
                    'Year'  =>  $compatibility['year'],
                    'Trim'  =>  $compatibility['trim'],
                    'Engine'  =>  $compatibility['engine'],
                ]),
                'scope' =>  MetaScope::ITEM_COMPATIBILITY_LIST
            ]));
        }

        $view = view('template.apn', [
            'item'=>$item,
            'url'   =>  $this->resourceUrl
        ])->render();

        return $view;

    }
}
