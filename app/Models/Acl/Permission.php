<?php

namespace App\Models\Acl;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'store_id',
        'user_id',
        'permission'
    ];
}
