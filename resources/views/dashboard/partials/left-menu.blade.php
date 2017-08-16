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

            <li class=" nav-item">
                <a href="#"><i class="icon-cart4"></i><span class="menu-title">My Store</span></a>
                <ul class="menu-content">
                    <li class="{{ active_menu('store.index', $active_menu) }}">
                        <a href="#" class="menu-item">All Stores</a>
                    </li>
                    <li class="{{ active_menu('store.create', $active_menu) }}">
                        <a href="{{ route('store.create') }}" class="menu-item">New Store</a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item">
                <a href="#"><i class="icon-cart4"></i><span class="menu-title">Buy</span></a>
                <ul class="menu-content">
                    <li>
                        <a href="#" class="menu-item">Watch</a>
                    </li>
                    <li>
                        <a href="#" class="menu-item">Bids/Offers</a>
                    </li>
                    <li>
                        <a href="#" class="menu-item">Purchase History</a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item">
                <a href="#"><i class="icon-clipboard2"></i><span class="menu-title">Selling Manager Pro</span></a>
                <ul class="menu-content">
                    <li>
                        <a href="active-listing.html" class="menu-item">Active</a>
                    </li>
                    <li class="">
                        <a href="#" class="menu-item">Unsold</a>
                    </li>
                    <li>
                        <a href="#" class="menu-item">Sold</a>
                        <ul class="menu-content">
                            <li>
                                <a href="#" class="menu-item">Awaiting payment</a>
                            </li>
                            <li>
                                <a href="#" class="menu-item">Awaiting shipment</a>
                            </li>
                            <li>
                                <a href="#" class="menu-item">Paid and shipped</a>
                            </li>
                            <li>
                                <a href="#" class="menu-item">Shopping lebels</a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </li>


        </ul>
    </div>
    <!-- /main menu content-->

</div>