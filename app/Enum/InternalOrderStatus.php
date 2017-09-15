<?php

namespace App\Enum;

use MyCLabs\Enum\Enum;

class InternalOrderStatus extends Enum
{
    const CANCELLED = "CANCELLED";
    const AWAITING_PAYMENT = "AWAITING_PAYMENT";
    const AWAITING_SHIPMENT = "AWAITING_SHIPMENT";
    const AWAITING_ORDER = "AWAITING_ORDER";
    const AWAITING_TRACKING = "AWAITING_TRACKING";
    const PRINT_LABEL = "PRINT_LABEL";
    const PAID_AND_SHIPPED = "PAID_AND_SHIPPED";
    const ISSUE = "ISSUE";
}