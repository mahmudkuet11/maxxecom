<?php

namespace App\Models\Item;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    protected $fillable = [
        'reference_id',
        'name',
        'value',
        'scope'
    ];
}
