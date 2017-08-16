<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'owner_id',
        'site_mode',
        'name',
        'site_id',
        'sandbox_dev_id',
        'sandbox_app_id',
        'sandbox_cert_id',
        'sandbox_auth_token',
        'sandbox_oauth_token',
        'production_dev_id',
        'production_app_id',
        'production_cert_id',
        'production_auth_token',
        'production_oauth_token',
    ];

}
