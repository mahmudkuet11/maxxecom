@extends('layouts.main')

@section('css')
@parent
<link rel="stylesheet" href="/vendor/laravel-filemanager/css/lfm.css">
@endsection

@section('meta')
@parent
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content_header')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-xs-12 mb-1">
        <h2 class="content-header-title">Store Settings</h2>
    </div>
    <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Store</a>
                </li>
                <li class="breadcrumb-item active">
                    Settings
                </li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-head">
                <div class="card-header">
                    <h4 class="card-title">Upload Excel</span></h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                </div>
            </div>
            <div class="card-body collapse in">
                <div class="card-block">
                    @if(isset($status, $msg))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-dismissible alert-{{ $status == 'success' ? 'success' : '' }}">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                {{ msg }}
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('store.excel.upload.post') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="file" class="form-control" name="excel">
                                <input type="hidden" name="name" value="keystone.xlsx">
                                <button type="submit" class="btn btn-primary">Upload Keystone</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('store.excel.upload.post') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="file" class="form-control" name="excel">
                                <br>
                                <input type="hidden" name="name" value="perfect_fit.xlsx">
                                <button type="submit" class="btn btn-primary">Upload Perfectfit</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
