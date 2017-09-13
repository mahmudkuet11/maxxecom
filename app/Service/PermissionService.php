<?php

namespace App\Service;


use App\Models\Acl\Permission;
use App\Models\Store;

class PermissionService
{
    private $permissions;

    function __construct()
    {
        $this->permissions = Permission::where('user_id', auth()->user()->id)->get();
    }

    public function hasStoreEditPermission(Store $store){
        $store_id = self::getStoreId($store);
        $permission = $this->permissions->where('store_id', $store_id)
            ->where('permission', \App\Enum\Acl\Permission::search(\App\Enum\Acl\Permission::STORE_EDIT))
            ->first();
        if($permission) return true;
        return false;
    }

    public function hasUserManagePermission(Store $store){
        return self::hasUserAddPermission($store) || self::hasUserRemovePermission($store);
    }

    public function hasUserAddPermission($store){
        $store_id = self::getStoreId($store);
        $permission = $this->permissions->where('store_id', $store_id)
            ->where('permission', \App\Enum\Acl\Permission::search(\App\Enum\Acl\Permission::USER_ADD))
            ->first();
        if($permission) return true;
        return false;
    }

    public function hasUserRemovePermission($store){
        $store_id = self::getStoreId($store);
        $permission = $this->permissions->where('store_id', $store_id)
            ->where('permission', \App\Enum\Acl\Permission::search(\App\Enum\Acl\Permission::USER_REMOVE))
            ->first();
        if($permission) return true;
        return false;
    }

    public function hasPermissionGrantPermission($store){
        $store_id = self::getStoreId($store);
        $permission = $this->permissions->where('store_id', $store_id)
            ->where('permission', \App\Enum\Acl\Permission::search(\App\Enum\Acl\Permission::PERMISSION_GRANT))
            ->first();
        if($permission) return true;
        return false;
    }

    private function getStoreId($store){

        if($store instanceof Store){
            return $store->id;
        }
        if(gettype($store) == 'integer'){
            return $store;
        }
        if(gettype($store) == 'string'){
            return (int)$store;
        }
        return null;
    }
}