@extends('layouts.main')

@section('content_header')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-xs-12 mb-1">
        <h2 class="content-header-title">Listing Options</h2>
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
                    Revise listing
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
                    <h4 class="card-title">Go through the listing options</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">

                            <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                            <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block card-dashboard">

                        <form action="{{ route('item.listing.new') }}">
                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="store_id">Company</label>
                                <div class="col-md-9">
                                    <select id="store_id" name="store_id" class="form-control">
                                        @foreach($stores as $store)
                                        <option value="{{ $store->id }}">{{ $store->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="site_id">eBay site</label>
                                <div class="col-md-9">
                                    <?php $sites  = \App\Enum\Ebay\Site::toArray(); ?>
                                    <select id="site_id" name="site_id" class="form-control">
                                        @foreach($sites as $site)
                                        <option value="{{ $site['site_id'] }}">{{ $site['site_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="item_id">eBay Item ID</label>
                                <div class="col-md-9">
                                    <input type="text" id="item_id" class="form-control" placeholder="Enter eBay Item ID" name="item_id">
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success mr-1">
                                    <i class="icon-search2"></i> Find product
                                </button>
                                <a href="" class="btn btn-primary"><i class="icon-plus2"></i> Create New Listing</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
