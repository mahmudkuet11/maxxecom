<?php

namespace App\Service;


use App\Models\Log;

class LogService
{
    public function write($user_id = null, $scope = null, $reference_id = null, $message = ""){
        return Log::create([
            'user_id'   =>  $user_id,
            'scope' =>  $scope,
            'reference_id'  =>  $reference_id,
            'message'   =>  $message
        ]);
    }
}