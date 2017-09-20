<!DOCTYPE html>
<html lang="en" data-textdirection="LTR" class="loading">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Maxxecom">
    <meta name="keywords" content="Maxxecom">
    <meta name="author" content="Maxxecom">
    @yield('meta')
    <title>Maxeecom: Home</title>
    <link rel="apple-touch-icon" sizes="60x60" href="/app-assets/images/ico/60x60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/app-assets/images/ico/76x76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/app-assets/images/ico/120x120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/app-assets/images/ico/152x152.png">
    <link rel="shortcut icon" type="image/png" href="/app-assets/images/ico/32x32.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap.min.css">
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="/app-assets/fonts/icomoon.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/fonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/sliders/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/extensions/pace.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/select.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">

    <!-- END VENDOR CSS-->
    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/app.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/colors.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-content-menu.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-overlay-menu.min.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <!-- END Custom CSS-->
    @yield('css')
</head>
<body data-open="click" data-menu="vertical-content-menu" data-col="2-columns" class="vertical-layout vertical-content-menu 2-columns  fixed-navbar">
<!-- navbar-fixed-top-->
<nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-light navbar-hide-on-scroll navbar-border navbar-shadow navbar-brand-center">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav">
                <li class="nav-item mobile-menu hidden-md-up float-xs-left"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5 font-large-1"></i></a></li>
                <li class="nav-item"><a href="home.html" class="navbar-brand nav-link"><img alt="branding logo" src="/app-assets/images/logo/maxLogo117x25.png" data-expand="/app-assets/images/logo/maxLogo117x25.png"  class="brand-logo"></a></li>
                <li class="nav-item hidden-md-up float-xs-right"><a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container"><i class="icon-ellipsis pe-2x icon-icon-rotate-right-right"></i></a></li>
            </ul>
        </div>
        <div class="navbar-container content container-fluid">
            <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
                <ul class="nav navbar-nav">
                    <li class="nav-item hidden-sm-down"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5"></i></a></li>

                    <li class="nav-item hidden-sm-down"><a href="#" class="nav-link nav-link-expand"><i class="ficon icon-expand2"></i></a></li>

                </ul>
                <ul class="nav navbar-nav float-xs-right">

                    <li class="dropdown dropdown-user nav-item">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link dropdown-user-link"><span class="avatar avatar-online"><img src="/app-assets/images/portrait/parts-cargo.png" alt="avatar"><i></i></span><span class="user-name">Parts Cargo</span></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" class="dropdown-item"><i class="icon-head"></i> Edit Profile</a><a href="#" class="dropdown-item"><i class="icon-mail6"></i> My Inbox</a><a href="#" class="dropdown-item"><i class="icon-clipboard2"></i> Task</a><a href="#" class="dropdown-item"><i class="icon-calendar5"></i> Calender</a>
                            <div class="dropdown-divider"></div><a href="#" class="dropdown-item"><i class="icon-power3"></i> Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- ////////////////////////////////////////////////////////////////////////////-->
<div class="app-content content container-fluid">
    <div class="content-wrapper">

        @yield('content_header')

        <!-- main menu-->
        @include('dashboard.partials.left-menu')
        <!-- / main menu-->
        <div class="content-body">

            @yield('content')

        </div>
    </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->

<footer class="footer navbar-fixed-bottom footer-light">
    <p class="clearfix text-muted text-sm-center mb-0 px-2"><span class="float-md-left d-xs-block d-md-inline-block">Copyright  &copy; 2017 <a href="#" target="_blank" class="text-bold-800 grey darken-2">Maxxecom </a>, All rights reserved. </span><span class="float-md-right d-xs-block d-md-inline-block">Powered by <a href="#" target="_blank" class="text-bold-800 grey darken-2">Mazegeek</a></span></p>
</footer>

<script src="/app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/ui/tether.min.js" type="text/javascript"></script>
<script src="/app-assets/js/core/libraries/bootstrap.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/ui/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/ui/unison.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/ui/blockUI.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/ui/jquery.matchHeight-min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/ui/jquery-sliding-menu.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/sliders/slick/slick.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/ui/screenfull.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/extensions/pace.min.js" type="text/javascript"></script>

<script src="/app-assets/vendors/js/ui/headroom.min.js" type="text/javascript"></script>
<script src="../../../app-assets/vendors/js/tables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js" type="text/javascript"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js" type="text/javascript"></script>

<script src="/app-assets/js/core/app-menu.min.js" type="text/javascript"></script>
<script src="/app-assets/js/core/app.min.js" type="text/javascript"></script>
<script src="/app-assets/js/scripts/ui/fullscreenSearch.min.js" type="text/javascript"></script>

<script src="/js/pre_loader.js" type="text/javascript"></script>

@yield('scripts')

</body>

</html>
