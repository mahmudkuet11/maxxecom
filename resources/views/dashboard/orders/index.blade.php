@extends('layouts.main')

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
                    <h4 class="card-title">Transaction details</h4>
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
                        <ul class="nav nav-pills nav-pill-toolbar">

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    Shipping action
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" id="dropdown41-tab" href="#dropdown41" data-toggle="pill" aria-expanded="true">Option 01</a>
                                    <a class="dropdown-item" id="dropdown42-tab" href="#dropdown42" data-toggle="pill" aria-expanded="true">Option 02</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    Change status
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" id="dropdown41-tab" href="#dropdown41" data-toggle="pill" aria-expanded="true">Option 01</a>
                                    <a class="dropdown-item" id="dropdown42-tab" href="#dropdown42" data-toggle="pill" aria-expanded="true">Option 02</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    Other action
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" id="dropdown41-tab" href="#dropdown41" data-toggle="pill" aria-expanded="true">Option 01</a>
                                    <a class="dropdown-item" id="dropdown42-tab" href="#dropdown42" data-toggle="pill" aria-expanded="true">Option 02</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="about4-tab" data-toggle="pill" href="#about4" aria-expanded="false">Sell similar</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    Create listing
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="create-new-list.html" aria-expanded="true">Single Listing</a>
                                    <a class="dropdown-item" href="#dropdown42" data-toggle="pill" aria-expanded="true">Multiple Listing</a>
                                </div>
                            </li>
                        </ul>
                        <br />
                        <table class="table table-striped table-bordered" id="flow-table">
                            <thead>
                            <tr>
                                <th class="check" style="width:13px;">
                                    <input type="checkbox" id="flowcheckall" value="" />
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
                                <th><i class="icon-star-o"></i></th>
                                <th><i class="icon-star-o"></i></th>
                                <th><i class="icon-star-o"></i></th>
                                <th><i class="icon-star-o"></i></th>
                                <th><i class="icon-star-o"></i></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($orders as $order)
                            <tr>
                                <td style=""><input type='checkbox' id='checkall' name='mydata'></td>
                                <td>
                                    <a href="#">{{ $order->id }}</a>
                                </td>
                                <td > <a href="#">{{ $order->buyer_user_id }}</a><code>01</code>()</td>
                                <td ><span>{{ $order->transactions->first()->buyer_email }}</span> </td>
                                <td >{{ $order->transactions->pluck('item_id')->implode(", ") }}</td>
                                <td style="width:200px">{{ $order->transactions->pluck('item_title')->implode(", ") }}</td>
                                <td><a href="#">Add</a></td>
                                <td><a href="#"><div class="tag tag-pill tag-info"><i class="icon-newspaper-o"></i></div></a></td>
                                <td>{{ $order->transactions->sum('quantity') }}</td>
                                <td>$1000</td>
                                <td>${{ $order->total }}</td>
                                <td>{{ $order->sold_date }}</td>
                                <td>{{ $order->paid_time }}</td>
                                <th><i class="icon-star-o"></i></th>
                                <th><i class="icon-star-o"></i></th>
                                <th><i class="icon-star-o"></i></th>
                                <th><i class="icon-star-o"></i></th>
                                <th><i class="icon-star-o"></i></th>
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

<script>
    $(document).ready(function () {

        //$("#flow-table > tbody").append(str);
        oTableStaticFlow = $('#flow-table').dataTable({
            "aoColumnDefs": [{
                'bSortable': false,
                'aTargets': [0]
            }],
            "scrollY": 200,
            "scrollX": true,

        });

        $("#flowcheckall").click(function () {
            $('#flow-table tbody input[type="checkbox"]').prop('checked', this.checked);
        });
    });
</script>
@endsection
