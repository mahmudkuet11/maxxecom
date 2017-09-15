<?php
    if(!isset($active_menu)) $active_menu = '';
?>
<div class="main-menu menu-static menu-light menu-accordion menu-shadow">
    <!-- main menu header-->
    <!-- / main menu header-->
    <!-- main menu content-->
    <div class="main-menu-content">
        <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
            <li class=" navigation-header">
                <span>Summary</span><i data-toggle="tooltip" data-placement="right" data-original-title="Add Ons" class="icon-ellipsis icon-ellipsis"></i>
            </li>

            <li class=" nav-item {{ active_menu('dashboard', $active_menu) }}">
                <a href="{{ route('dashboard') }}"><i class="icon-cart4"></i><span class="menu-title">Dashboard</span></a>
            </li>

            <li class=" nav-item">
                <a href="#"><i class="icon-cart4"></i><span class="menu-title">My Store</span></a>
                <ul class="menu-content">
                    <li class="{{ active_menu('store.index', $active_menu) }}">
                        <a href="{{ route('store.index') }}" class="menu-item">All Stores</a>
                    </li>
                    <li class="{{ active_menu('store.create', $active_menu) }}">
                        <a href="{{ route('store.create') }}" class="menu-item">New Store</a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item">
                <a href="#"><i class="icon-clipboard2"></i><span class="menu-title">Order Management</span></a>
                <ul class="menu-content">
                    <li class="{{ active_menu('order.all', $active_menu) }}">
                        <a href="{{ route('orders.all') }}" class="menu-item">All Orders</a>
                    </li>
                    <li class="{{ active_menu('order.awaiting_payment', $active_menu) }}">
                        <a href="{{ route('orders.awaiting_payment') }}" class="menu-item">Awaiting Payment</a>
                    </li>
                    <li class="{{ active_menu('order.awaiting_shipment', $active_menu) }}">
                        <a href="{{ route('orders.awaiting_shipment') }}" class="menu-item">Awaiting Shipment</a>
                    </li>
                    <li class="{{ active_menu('order.awaiting_order', $active_menu) }}">
                        <a href="{{ route('orders.awaiting_order') }}" class="menu-item">Awaiting Order</a>
                    </li>
                    <li class="{{ active_menu('order.print_label', $active_menu) }}">
                        <a href="{{ route('orders.print_label') }}" class="menu-item">Print Label</a>
                    </li>
                    <li class="{{ active_menu('order.awaiting_tracking', $active_menu) }}">
                        <a href="{{ route('orders.awaiting_tracking') }}" class="menu-item">Awaiting Tracking</a>
                    </li>
                    <li class="{{ active_menu('order.paid_and_shipped', $active_menu) }}">
                        <a href="{{ route('orders.paid_and_shipped') }}" class="menu-item">Paid And Shipped</a>
                    </li>
                </ul>
            </li>


        </ul>
    </div>
    <!-- /main menu content-->

</div>