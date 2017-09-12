@inject('userService', 'App\Service\UserService')
@extends('layouts.main')

@section('content_header')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-xs-12 mb-1">
        <h2 class="content-header-title">Permission</h2>
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
                    <h4 class="card-title">Manage Permission</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <button data-toggle="modal" data-target="#modal_user_add" type="button" class="btn mr-1 mb-1 btn-primary btn-sm">Add User</button>
                    </div>
                </div>
            </div>
            <div class="card-body collapse in">
                <div class="card-block">
                    @include('common.msg')
                    @include('common.form-errors')
                    <form action="{{ route('store.user.permission.update', ['store_id'=>$store->id, 'user_id'=>$user->id]) }}" method="post">
                        {{ csrf_field() }}
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Check</th>
                                    <th>Permission Name</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $permissions = \App\Enum\Acl\Permission::toArray();
                                $userPermissions = $user->permissions;
                                ?>
                                @foreach($permissions as $k=>$v)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="permission[]" value="{{ $k }}" {{ $userService->hasPermission($userPermissions, $k) ? 'checked' : '' }}>
                                    </td>
                                    <td>
                                        {{ $v }}
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td>
                                        <input type="submit" value="Update Permission" class="btn btn-primary">
                                    </td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection