@inject('permissionService', 'App\Service\PermissionService')

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
                <li class="breadcrumb-item active">
                    All Stores
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
                    <h4 class="card-title">Stores</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <a href="{{ route('store.create') }}" class="btn btn-primary white"><i class="icon-plus4 white"></i> Create Store</a>
                    </div>
                </div>
            </div>
            <div class="card-body collapse in">
                <div class="card-block">
                    @include('common.msg')
                    <!-- Invoices List table -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Site Name</th>
                                <th>Site ID</th>
                                <th>Created At</th>
                                <th>Last Update</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($stores as $store)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $store->name }}</td>
                                <td>{{ \App\Enum\Ebay\Site::getSiteBySiteID($store->site_id)['site_name'] }}</td>
                                <td>{{ $store->created_at }}</td>
                                <td>{{ $store->updated_at }}</td>
                                <td>
                                    @if($permissionService->hasStoreEditPermission($store))
                                    <a href="{{ route('store.edit', $store->id) }}" class="btn btn-default">Edit</a>
                                    @endif
                                    @if($permissionService->hasUserManagePermission($store))
                                    <a href="{{ route('store.user.manage', $store->id) }}" class="btn btn-default">User Manage</a>
                                    @endif
                                    <a href="{{ route('store.settings.get', $store->id) }}" class="btn btn-default">Settings</a>
                                </td>
                            </tr>
                            @empty

                            @endforelse

                            </tbody>
                        </table>
                    </div>
                    <!--/ Invoices table -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@parent
<script src="/app-assets/js/scripts/tables/datatables-extensions/datatable-select.min.js" type="text/javascript"></script>
@endsection