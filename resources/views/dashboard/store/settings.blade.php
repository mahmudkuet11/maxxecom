@inject('permissionService', 'App\Service\PermissionService')

@extends('layouts.main')

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
                    <h4 class="card-title">Settings of <span class="text-success">{{ $store->name }}</span></h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                </div>
            </div>
            <div class="card-body collapse in">
                <div class="card-block">

                    <form class="form form-horizontal form-bordered">
                        <div class="form-body">
                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Paypal Email Address</label>
                                <div class="col-md-9">
                                    <div class="row" id="paypal_email_address_container">
                                        <?php $emails = $settings->where('scope', \App\Enum\Settings::PAYPAL_EMAIL)->where('key', 'paypal_email')->all(); ?>
                                        @foreach($emails as $email)
                                        <div class="col-md-12 margin-top-10 paypal_email_address_row">
                                            <div class="input-group">
                                                <input type="email" class="form-control" value="{{ $email->value }}">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-danger remove_row" type="button">X</button>
                                                </span>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 margin-top-10">
                                            <button type="button" class="btn btn-primary btn-sm" id="add_new_paypal_email_row_btn">
                                                <i class="fa icon-plus-square"></i> Add
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn btn-primary" id="save_settings">
                                <i class="icon-check2"></i> Save
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@parent

<script>
    var Global = {
        settings_update_url: '{{ route("store.settings.update", $store->id) }}'
    };
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.4/lodash.min.js"></script>
<script src="/js/settings.js"></script>
@endsection