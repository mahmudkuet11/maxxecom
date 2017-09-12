<?php

namespace App;

use App\Models\Acl\Permission;
use App\Models\Store;
use App\Models\UserStore;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function stores(){
        return $this->hasMany(Store::class, 'owner_id');
    }

    public function user_stores(){
        return $this->hasMany(UserStore::class);
    }

    public function permissions(){
        return $this->hasMany(Permission::class);
    }
}
