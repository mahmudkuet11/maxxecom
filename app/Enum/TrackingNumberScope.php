<?php

namespace App\Enum;


use MyCLabs\Enum\Enum;

class TrackingNumberScope extends Enum
{
    const TRANSACTION = "TRANSACTION";
    const SKU = "SKU";
}