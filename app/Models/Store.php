<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'owner_id',
        'name',
        'site_id',
        'auth_token',
        'oauth_token',
        'is_syncing'
    ];

}
