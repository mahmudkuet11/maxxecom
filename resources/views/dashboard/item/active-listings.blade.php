@extends('layouts.main')

@section('content_header')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-xs-12 mb-1">
        <h2 class="content-header-title">Active listings</h2>
    </div>
    <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="home.html">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="home.html">Selling Manager Pro</a>
                </li>
                <li class="breadcrumb-item active">
                    Active listing
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
                    <h4 class="card-title"><code>1 to 200 of 29477</code></h4>
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
                        <ul class="nav nav-pills nav-pill-toolbar">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    Create listing
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="create-new-list.html" aria-expanded="true">Single Listing</a>
                                    <a class="dropdown-item" href="#dropdown42" data-toggle="pill" aria-expanded="true">Multiple Listing</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    Edit
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" id="dropdown41-tab" href="#dropdown41" data-toggle="pill" aria-expanded="true">Option 01</a>
                                    <a class="dropdown-item" id="dropdown42-tab" href="#dropdown42" data-toggle="pill" aria-expanded="true">Option 02</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    Automation Rules
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" id="dropdown41-tab" href="#dropdown41" data-toggle="pill" aria-expanded="true">Option 01</a>
                                    <a class="dropdown-item" id="dropdown42-tab" href="#dropdown42" data-toggle="pill" aria-expanded="true">Option 02</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    Action
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" id="dropdown41-tab" href="#dropdown41" data-toggle="pill" aria-expanded="true">Option 01</a>
                                    <a class="dropdown-item" id="dropdown42-tab" href="#dropdown42" data-toggle="pill" aria-expanded="true">Option 02</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="about4-tab" data-toggle="pill" href="#about4" aria-expanded="false">Sell similar</a>
                            </li>
                        </ul>
                        <br />
                        <table class="table table-striped table-bordered" id="flow-table">
                            <thead>
                            <tr>
                                <th class="check" style="width:40px">
                                    <input type="checkbox" id="flowcheckall" value="" />&nbsp;All
                                </th>
                                <th style="width:100px">Actions</th>
                                <th style="width:100px">Photo</th>
                                <th style="width:200px">Title</th>
                                <th>Custom label (SKU)</th>
                                <th>Format</th>
                                <th>Current Price</th>
                                <th>Available qty</th>
                                <th>Time left</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                            <tr>
                                <td style="width:40px;"><input type='checkbox' id='checkall' name='mydata' style="width:inherit;"></td>
                                <td style="width:100px;">
                                    <select size="1" id="row-5-office" name="row-5-office" class="form-control" style="width:inherit;">
                                        <option value="Edinburgh" selected="selected">
                                            Revise
                                        </option>
                                        <option value="London">
                                            Sell similar
                                        </option>
                                        <option value="New York">
                                            Send to online auction
                                        </option>
                                        <option value="San Francisco">
                                            Add to description
                                        </option>
                                        <option value="Tokyo">
                                            End item
                                        </option>
                                        <option value="Tokyo">
                                            Save as template
                                        </option>
                                    </select>
                                </td>
                                <td><span><img src="{{ $item->gallery_url }}" style="width:50px;" /></span></td>
                                <td style="width:200px"><span><a href="" title="click to edit">{{ $item->title }}</a></span> </td>
                                <td>{{ $item->sku }}</td>
                                <td><a href="#"><div class="tag tag-pill tag-info"><i class="fa fa-list" aria-hidden="true"></i></div></a></td>
                                <td>{{ $item->current_price }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->time_left }}</td>
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

        //$("#flow-table > tbody").append(str);
        oTableStaticFlow = $('#flow-table').dataTable({
            "aoColumnDefs": [{
                'bSortable': false,
                'aTargets': [0]
            }],
            "scrollY": 500,
            "scrollX": true,

        });

        $("#flowcheckall").click(function () {
            $('#flow-table tbody input[type="checkbox"]').prop('checked', this.checked);
        });
    });
</script>
@endsection
