<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserStore extends Model
{
    protected $table = 'user_store';
    public $timestamps = false;
    protected $fillable = ['user_id', 'store_id'];

}
