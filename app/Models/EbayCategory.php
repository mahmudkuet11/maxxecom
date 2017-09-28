<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EbayCategory extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'site_id',
        'category_id',
        'level',
        'name',
        'parent_id',
        'is_leaf',
    ];

}
