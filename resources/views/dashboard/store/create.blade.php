@extends('layouts.main')

@section('content_header')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-xs-12 mb-1">
        <h2 class="content-header-title">Add a Store</h2>
    </div>
    <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('store.index') }}">Store</a>
                </li>
                <li class="breadcrumb-item active">
                    New Store
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
            <div class="card-header">
                <h4 class="card-title">Add New Store</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                        <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                        <li><a data-action="close"><i class="icon-cross2"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body collapse in">
                <div class="card-block">

                    @include('common.form-errors')

                    <form class="form form-horizontal" method="post" action="{{ route('store.store') }}">

                        {{ csrf_field() }}

                        <div class="form-body">

                            <h4 class="form-section"><i class="icon-clipboard4"></i>Basic Info</h4>

                            <div class="form-group row">
                                <label class="col-md-3 label-control">Store Name</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Enter store name" name="name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 label-control">Site ID</label>
                                <div class="col-md-9">
                                    <?php
                                        $sites = \App\Enum\Ebay\Site::toArray();
                                    ?>
                                    <select name="site_id" class="form-control">
                                        <option value="" selected="" disabled="">-- Select Site ID --</option>
                                        @foreach($sites as $site)
                                        <option value="{{ $site['site_id'] }}">{{ $site['site_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 label-control">Mode</label>
                                <div class="col-md-9">
                                    <div class="input-group col-md-9">
                                        <label class="display-inline-block custom-control custom-radio ml-1">
                                            <input type="radio" name="site_mode" value="sandbox" checked="" class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description ml-0">Sandbox</span>
                                        </label>
                                        <label class="display-inline-block custom-control custom-radio">
                                            <input type="radio" name="site_mode" value="production" class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description ml-0">Production</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <h4 class="form-section"><i class="icon-clipboard4"></i>Sandbox Config</h4>

                            <div class="form-group row">
                                <label class="col-md-3 label-control">Sandbox Dev ID</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Enter sandbox dev ID" name="sandbox_dev_id">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 label-control">Sandbox App ID</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Enter sandbox app ID" name="sandbox_app_id">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 label-control">Sandbox Cert ID</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Enter sandbox cert ID" name="sandbox_cert_id">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 label-control">Sandbox Auth Token</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="sandbox_auth_token" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 label-control">Sandbox OAuth Token</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="sandbox_oauth_token" rows="3"></textarea>
                                </div>
                            </div>


                            <h4 class="form-section"><i class="icon-clipboard4"></i>Production Config</h4>

                            <div class="form-group row">
                                <label class="col-md-3 label-control">Production Dev ID</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Enter production dev ID" name="production_dev_id">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 label-control">Production App ID</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Enter production app ID" name="production_app_id">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 label-control">Production Cert ID</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Enter production cert ID" name="production_cert_id">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 label-control">Production Auth Token</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="production_auth_token" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 label-control">Production OAuth Token</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="production_oauth_token" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">
                                    <i class="icon-check2"></i> Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection