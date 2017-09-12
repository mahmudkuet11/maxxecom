<?php

namespace App\Enum\Acl;

use MyCLabs\Enum\Enum;

class Permission extends Enum
{
    const STORE_EDIT = 'Store Edit';
    const USER_ADD = 'User Add';
    const USER_REMOVE = 'User Remove';
    const PERMISSION_GRANT = 'Permission Grant';
    const VIEW_ALL_ORDERS = 'View All Orders';
    const VIEW_AWAITING_PAYMENT = 'View Awaiting Payment';
    const VIEW_AWAITING_SHIPMENT = 'View Awaiting Shipment';
    const VIEW_AWAITING_ORDER = 'View Awaiting Order';
    const VIEW_PRINT_LABEL = 'View Print Label';
    const VIEW_AWAITING_TRACKING = 'View Awaiting Tracking';
    const VIEW_PAID_AND_SHIPPED ='View Paid And Shipped';
    const EDIT_SHIPPING_ADDRESS = 'Edit Shipping Address';

}