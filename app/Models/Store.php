<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'owner_id',
        'name',
        'site_id',
        'dev_id',
        'app_id',
        'cert_id',
        'auth_token',
        'oauth_token',
    ];

}
