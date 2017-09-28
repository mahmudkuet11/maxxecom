<?php

use Illuminate\Database\Seeder;

class EbayCategorySeeder extends Seeder
{
    private $siteID;

    function __construct()
    {
        $this->siteID = [0, 100];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\EbayCategory::truncate();
        foreach ($this->siteID as $site){
            $xml = simplexml_load_file(public_path('/upload/category/'. $site .'.xml'));
            $categories = $xml->CategoryArray->Category;
            $data = [];
            $count = 0;
            foreach ($categories as $cat){
                $data[] = [
                    'site_id'   =>  $site,
                    'category_id'   =>  (string)$cat->CategoryID,
                    'level'   =>  (int)$cat->CategoryLevel,
                    'name'   =>  (string)$cat->CategoryName,
                    'parent_id'   =>  (string)$cat->CategoryParentID,
                    'is_leaf'   =>  (boolean)$cat->LeafCategory,
                ];
                $count++;
                if($count % 1000 == 0){
                    \App\Models\EbayCategory::insert($data);
                    $count = 0;
                    $data = [];
                }
            }
            \App\Models\EbayCategory::insert($data);
        }
    }
}
