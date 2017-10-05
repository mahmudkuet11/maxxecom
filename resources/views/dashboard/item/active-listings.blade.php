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

                        <table class="table table-striped table-bordered" id="active_listing_table">
                            <thead>
                            <tr>
                                <th style="width:100px">Photo</th>
                                <th style="width:200px">Title</th>
                                <th>Custom label (SKU)</th>
                                <th>Current Price</th>
                                <th>Available qty</th>
                                <th>Time left</th>
                            </tr>
                            </thead>
                            <tbody>

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

        $('#active_listing_table').dataTable({
            scrollX: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ request()->url() }}',
                dataSrc: function(json){
                    for(var i in json.data){
                        json.data[i][0] = '<span><img src="'+ json.data[i][0] +'" style="width:50px;" /></span>';
                        json.data[i][1] = '<span><a href="/listing/'+ json.data[i][6] +'/revise" title="click to edit">'+ json.data[i][1] +'</a></span>';
                    }
                    return json.data;
                }
            }
        });

        $("#flowcheckall").click(function () {
            $('#flow-table tbody input[type="checkbox"]').prop('checked', this.checked);
        });
    });
</script>
@endsection
