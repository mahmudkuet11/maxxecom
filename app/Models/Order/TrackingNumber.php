<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class TrackingNumber extends Model
{
    protected $fillable = [
        'scope',
        'reference_id',
        'carrier',
        'tracking_no',
    ];
}
