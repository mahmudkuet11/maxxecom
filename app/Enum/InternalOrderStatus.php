<?php

namespace App\Enum;

use MyCLabs\Enum\Enum;

class InternalOrderStatus extends Enum
{
    const AWAITING_PAYMENT = "Awaiting Payment";
    const AWAITING_SHIPMENT = "Awaiting Shipment";
    const AWAITING_ORDER = "Awaiting Order";
    const AWAITIG_TRACKING = "Awaiting Tracking";
    const PRINT_LABEL = "Print Label";
    const PAID_AND_SHIPPED = "Pring and Shipped";
    const ISSUE = "Issue";
}