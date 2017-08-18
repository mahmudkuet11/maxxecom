<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Synchronization extends Model
{
    protected $fillable = [
        'store_id',
        'scope',
        'last_synced_at'
    ];
}
