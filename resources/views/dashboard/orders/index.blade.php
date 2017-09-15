@extends('layouts.main')

@section('css')
<style>
    a:not([href]):not([tabindex]), a:not([href]):not([tabindex]):focus, a:not([href]):not([tabindex]):hover {
        color: #4db6ac;
    }
    .dropdown-item.active, .dropdown-item.active:focus, .dropdown-item.active:hover {
        color: #808080;
        text-decoration: none;
        background-color: #18a2dc;
        outline: 0;
    }
    /* Ensure that the demo table scrolls */
    th, td {
        white-space: nowrap;
    }

    div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }

    div.ColVis {
        float: left;
    }
</style>
@endsection

@section('content_header')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-xs-12 mb-1">
        <h2 class="content-header-title">Sold listings</h2>
    </div>
    <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="home.html">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="home.html">Seller Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    Sold listing
                </li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')

<section>
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Slod listings</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                            <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                            <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block card-dashboard">
                        <!--
                        <div class="row">
                            <div class="col-xl-2 col-lg-6 col-md-12">
                                <fieldset class="form-group">
                                    <select class="form-control" id="basicSelect">
                                        <option>Select buyer email</option>
                                        <option>Option 1</option>
                                        <option>Option 2</option>
                                        <option>Option 3</option>
                                        <option>Option 4</option>
                                        <option>Option 5</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-xl-2 col-lg-6 col-md-12">
                                <fieldset class="form-group">
                                    <select class="form-control" id="basicSelect">
                                        <option>Select store category</option>
                                        <option>Option 1</option>
                                        <option>Option 2</option>
                                        <option>Option 3</option>
                                        <option>Option 4</option>
                                        <option>Option 5</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-xl-2 col-lg-6 col-md-12">
                                <fieldset class="form-group">
                                    <select class="form-control" id="basicSelect">
                                        <option>Select status</option>
                                        <option>Option 1</option>
                                        <option>Option 2</option>
                                        <option>Option 3</option>
                                        <option>Option 4</option>
                                        <option>Option 5</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-xl-2 col-lg-6 col-md-12">
                                <fieldset class="form-group">
                                    <select class="form-control" id="basicSelect">
                                        <option>Select period</option>
                                        <option>Option 1</option>
                                        <option>Option 2</option>
                                        <option>Option 3</option>
                                        <option>Option 4</option>
                                        <option>Option 5</option>
                                    </select>
                                </fieldset>
                            </div>

                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <fieldset>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Enter search keyword" aria-describedby="button-addon2">
                                        <span class="input-group-btn" id="button-addon2">
                                                            <button class="btn btn-primary bg-info border-info" type="button">Search</button>
                                                        </span>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        -->
                        <ul class="nav nav-tabs nav-underline no-hover-bg">

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    Shipping action
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" id="dropdown1-tab" href="#dropdown1" aria-controls="dropdown1" aria-expanded="true">option 01</a>
                                    <a class="dropdown-item" id="dropdown2-tab" href="#dropdown2" data-toggle="tab" aria-controls="dropdown2" aria-expanded="true">Option 02</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    Change status
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" id="dropdown1-tab" href="#dropdown1" aria-controls="dropdown1" aria-expanded="true">option 01</a>
                                    <a class="dropdown-item" id="dropdown2-tab" href="#dropdown2" aria-controls="dropdown2" aria-expanded="true">Option 02</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    Create listing
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" id="dropdown1-tab" href="#dropdown1" aria-controls="dropdown1" aria-expanded="true">option 01</a>
                                    <a class="dropdown-item" id="dropdown2-tab" href="#dropdown2" aria-controls="dropdown2" aria-expanded="true">Option 02</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" aria-expanded="true">Sell similar </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    Create listing
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" id="dropdown1-tab" href="#dropdown1" aria-controls="dropdown1" aria-expanded="true">option 01</a>
                                    <a class="dropdown-item" id="dropdown2-tab" href="#dropdown2" aria-controls="dropdown2" aria-expanded="true">Option 02</a>
                                </div>
                            </li>

                        </ul>
                        <br />
                        <div>
                            Toggle columns: <a class="toggle-vis" data-column="0">Check All</a> - <a class="toggle-vis" data-column="1">Record</a> - <a class="toggle-vis" data-column="2">Buyer username</a> - <a class="toggle-vis" data-column="3">Email</a> - <a class="toggle-vis" data-column="4">Item no</a> - <a class="toggle-vis" data-column="5">Product</a> - <a class="toggle-vis" data-column="6">Tracking number</a> - <a class="toggle-vis" data-column="7">Format</a> - <a class="toggle-vis" data-column="8">Qty</a> - <a class="toggle-vis" data-column="9">Sold for</a> - <a class="toggle-vis" data-column="10">Total</a> - <a class="toggle-vis" data-column="11">Date sold</a> - <a class="toggle-vis" data-column="12">Date paid</a>
                        </div>
                        <br />
                        <table class="table table-striped table-bordered hide-columns-dynamically" width="100%">
                            <thead>
                            <tr>
                                <th class="check" style="width:13px;">
                                    <input type="checkbox" class="flowcheckall" value="" />
                                </th>
                                <th>Record</th>
                                <th>Buyer username</th>
                                <th >Email</th>
                                <th>Item no</th>
                                <th style="width:200px">Product</th>
                                <th>Tracking number</th>
                                <th>Format</th>
                                <th>Qty</th>
                                <th>Sold for</th>
                                <th>Total</th>
                                <th>Date sold</th>
                                <th>Date paid</th>
                                <!--<th><i class="icon-star-o"></i></th>
                                <th><i class="icon-star-o"></i></th>
                                <th><i class="icon-star-o"></i></th>
                                <th><i class="icon-star-o"></i></th>
                                <th><i class="icon-star-o"></i></th>-->
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td style=""><input type='checkbox' class='checkall' name='mydata'></td>
                                <td>
                                    <a href="{{ route('order.show', $order->id) }}">#{{ $order->id . '-' . $order->sales_record_no }}</a>
                                </td>
                                <td><a href="#">{{ $order->buyer_user_id }}</a><code>01</code>()</td>
                                <td><span>{{ $order->transactions->first()->buyer_email }}</span> </td>
                                <td>{{ $order->transactions->pluck('item_id')->implode(", ") }}</td>
                                <td style="width:200px">{{ $order->transactions->pluck('item_title')->implode(", ") }}</td>
                                <td><a href="#">Add</a></td>
                                <td><a href="#"><div class="tag tag-pill tag-info"><i class="icon-newspaper-o"></i></div></a></td>
                                <td>{{ $order->transactions->sum('quantity') }}</td>
                                <td>${{ $order->sub_total }}</td>
                                <td>${{ $order->total }}</td>
                                <td>{{ $order->sold_date }}</td>
                                <td>{{ $order->paid_date }}</td>
                                <!--<th><i class="icon-star-o"></i></th>
                                <th><i class="icon-star-o"></i></th>
                                <th><i class="icon-star-o"></i></th>
                                <th><i class="icon-star-o"></i></th>
                                <th><i class="icon-star-o"></i></th>-->
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
@parent
<script src="/app-assets/js/scripts/tables/datatables/datatable-api.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $(".flowcheckall").click(function () {
            $('.hide-columns-dynamically tbody input[type="checkbox"]').prop('checked', this.checked);
        });

        $("a.toggle-vis").click(function () {
            //alert($(this).css('color'));
            if ($(this).css('color') == 'rgb(77, 182, 172)') {
                $(this).css({ "color": "rgb(237, 85, 101)" });
            }
            else if ($(this).css('color') == 'rgb(237, 85, 101)') {
                $(this).css({ "color": "rgb(77, 182, 172)" });
            }
        });
    });
</script>
@endsection
