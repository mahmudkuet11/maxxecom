<?php

namespace App\Models\Item;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'item_id',
        'url',
    ];
}
