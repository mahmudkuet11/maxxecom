@extends('layouts.main')

@section('meta')
@parent
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('css')
@parent
<link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/extended/form-extended.min.css">
<style>
    #store_list_ul .list-group-item:hover{
        cursor: pointer;
    }
</style>
@endsection

@section('content_header')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-xs-12 mb-1">
        <h2 class="content-header-title">Order info</h2>
    </div>
    <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="home.html">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    Order info
                </li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')

<section class="inputmask" id="inputmask">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Buyer info</h4>
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
                        <div class="row" style="display: flex;
    align-items: center;">
                            <div class="col-xl-5 col-lg-12 copy">
                                <fieldset>
                                    <h6>
                                        Buyer full name

                                    </h6>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Enter buyer's full name" value="{{ $order->shippingAddress->name }}"/>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <h6>
                                        Street

                                    </h6>
                                    <div class="form-group">
                                        <input type="text" class="form-control mb-1" placeholder="Enter street address" value="{{ $order->shippingAddress->street1 }}"/>
                                        <input type="text" class="form-control" placeholder="Extra line of street address" value="{{ $order->shippingAddress->street2 }}" />
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <h6>
                                        City

                                    </h6>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Enter City name" value="{{ $order->shippingAddress->city_name }}"/>

                                    </div>
                                </fieldset>
                                <fieldset>
                                    <h6>
                                        State/ Province

                                    </h6>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Enter state/ province name" value="{{ $order->shippingAddress->state_or_province }}"/>

                                    </div>
                                </fieldset>
                                <fieldset>
                                    <h6>
                                        Zip/ Postal Code

                                    </h6>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Enter zip/ postal Code" value="{{ $order->shippingAddress->postal_code }}"/>

                                    </div>
                                </fieldset>
                                <fieldset>
                                    <h6>
                                        Select Country

                                    </h6>
                                    <div class="form-group">
                                        <select class="form-control" id="basicSelect">
                                            <option value="{{ $order->shippingAddress->country }}" selected>{{ $order->shippingAddress->country_name }}</option>
                                            <option>USA</option>
                                            <option>India</option>
                                            <option>China</option>
                                            <option>UK</option>
                                            <option>Australia</option>
                                            <option>Russia</option>
                                        </select>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <h6>
                                        Phone / xEx
                                        <small class="text-muted">(999) 999-9999 / x999999</small>
                                    </h6>
                                    <div class="form-group">
                                        <input type="text" class="form-control xphone-inputmask" id="xphone-mask" placeholder="Enter Phone Number" value="{{ $order->shippingAddress->phone }}"/>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-xl-2 col-lg-12 text-sm-center">
                                <input type="button" name="b" class="btn btn-info" value="Copy >>" /><br /><br />
                            </div>
                            <div class="col-xl-5 col-lg-12">
                                <fieldset>
                                    <h6>
                                        Buyer's info in plain text

                                        <small class="text-muted">Copying buyer's info is very easy now!</small>
                                    </h6>
                                    <div class="form-group">
                                        <textarea rows="8" class="form-control"></textarea>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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
                        <table class="table table-striped table-bordered" id="transaction_details_table" data-order-id="{{ $order->id }}">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Quantity</th>
                                <th>Item #</th>
                                <th style="width:100px">Picture</th>
                                <th>Item Name</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                                <th>Tracking Number</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->transactions as $transaction)

                            @if($transaction->skus->count() > 1)
                            <tr data-tracking-details="{{ $transaction->shipment_tracking_details }}" data-order-line-item-id="{{ $transaction->order_line_item_id }}" data-buyer-id="{{ $order->buyer_user_id }}" data-buyer-name="{{ $transaction->buyer_name }}" data-item-title="{{ $transaction->item_title }}" data-item-id="{{ $transaction->item_id }}">
                                <td>

                                </td>
                                <td>{{ $transaction->quantity }}</td>
                                <td>{{ $transaction->item_id }}</td>
                                <td><span><img src="../../../app-assets/images/product/BM10661061.jpg" style="width:100%;" /></span></td>
                                <td>
                                    <a href="#" class="text-bold-600">{{ $transaction->item_title }}</a>
                                    <p>{{ $transaction->sku }}</p>
                                    <p class="text-muted font-small-2">Phasellus vel elit volutpat, egestas urna a.</p>
                                </td>
                                <td>${{ $transaction->transaction_price }}</td>
                                <td>${{ number_format($transaction->sub_total, 2, ".", "") }}</td>
                                <td><button class="btn btn-primary btn-sm add_tracking_no_btn">Add</button></td>
                            </tr>
                            @foreach($transaction->skus as $sku)
                            <tr data-transaction-id="{{ $transaction->id }}" data-price="{{ $transaction->transaction_price }}">
                                <td>
                                    <input type="radio" name="price_comparison_section" value="{{ $sku }}">
                                </td>
                                <td colspan="3"></td>
                                <td>{{ $sku }}</td>
                                <td colspan="3"></td>
                            </tr>
                            @endforeach
                            @else
                            <tr data-transaction-id="{{ $transaction->id }}" data-price="{{ $transaction->transaction_price }}" data-tracking-details="{{ $transaction->shipment_tracking_details }}" data-order-line-item-id="{{ $transaction->order_line_item_id }}" data-buyer-id="{{ $order->buyer_user_id }}" data-buyer-name="{{ $transaction->buyer_name }}" data-item-title="{{ $transaction->item_title }}" data-item-id="{{ $transaction->item_id }}">
                                <td>
                                    @if($transaction->sku)
                                    <input type="radio" name="price_comparison_section" value="{{ $transaction->skus->first() }}">
                                    @endif
                                </td>
                                <td>{{ $transaction->quantity }}</td>
                                <td>{{ $transaction->item_id }}</td>
                                <td><span><img src="../../../app-assets/images/product/BM10661061.jpg" style="width:100%;" /></span></td>
                                <td>
                                    <a href="#" class="text-bold-600">{{ $transaction->item_title }}</a>
                                    <p>{{ $transaction->sku }}</p>
                                    <p class="text-muted font-small-2">Phasellus vel elit volutpat, egestas urna a.</p>
                                </td>
                                <td>${{ $transaction->transaction_price }}</td>
                                <td>${{ number_format($transaction->sub_total, 2, ".", "") }}</td>
                                <td><button class="btn btn-primary btn-sm add_tracking_no_btn">Add</button></td>
                            </tr>
                            @endif
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th colspan="5" style="text-align: right">Total</th>
                                <th>${{ $order->sub_total }}</th>
                                <th colspan="2"></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="price_comparison_section">
    <div class="row match-height">
        <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="card" style="height: 453px;">
                <div class="card-body" id="invoice_container">
                    <div class="card-block" style="padding:1.25rem;">
                        <p class="card-text"><b>Invoice</b></p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <span class="float-xs-right"><input type="text" id="sold_price_input" class="form-control" value=""/></span> Sold price:
                        </li>
                        <li class="list-group-item">
                            <span class="float-xs-right"><input type="text" id="product_cost_input" class="form-control" value=""/></span> Product Cost:
                        </li>
                        <li class="list-group-item">
                            <span class="float-xs-right"><input type="text" id="shipping_cost_input" class="form-control" value=""/></span> Shipping cost:
                        </li>
                        <li class="list-group-item">
                            <span class="float-xs-right"><input type="text" id="handling_cost_input" class="form-control" value=""/></span> Handling Cost:
                        </li>
                        <li class="list-group-item">
                            <span class="float-xs-right"><input type="text" id="fees_input" class="form-control" value=""/></span> Fees:
                        </li>
                        <li class="list-group-item">
                            <span class="float-xs-right"><input disabled type="text" id="profit_input" class="form-control" value=""/></span> Profit:
                        </li>
                    </ul>
                    <div class="card-block">
                        <a href="#" class="btn btn-sm btn-info" id="edit_invoice_btn">Edit</a>
                        <a href="#" class="btn btn-sm btn-success" id="save_invoice_btn">Submit</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="card" style="height: 453px;">
                <div class="card-body">
                    <div class="card-block" style="padding:1.25rem;">
                        <p class="card-text"><b>Comparison between available stores</b></p>
                    </div>
                    <ul class="list-group list-group-flush" id="store_list_ul">
                        <li class="list-group-item" data-store="keystone_qi">
                            <span class="float-xs-right">$42.98 S&H</span> keystone/QI:
                        </li>
                        <li class="list-group-item" data-store="keystone_local">
                            <span class="float-xs-right">$23.53 W/O S&H</span> keystone/ LOCAL:
                        </li>
                        <li class="list-group-item" data-store="wr">
                            <span class="float-xs-right">Please check price</span> WAREHOUSE/ WR:
                        </li>
                        <li class="list-group-item" data-store="pf">
                            <span class="float-xs-right">$44.99 S&H</span> perfectfit/PF:
                        </li>
                        <li class="list-group-item" data-store="bs">
                            <span class="float-xs-right">Please check price</span> brocksupply/BS:
                        </li>
                        <li class="list-group-item" data-store="cap">
                            <span class="float-xs-right">Please check price</span> continentalparts/CAP:
                        </li>
                        <li class="list-group-item" data-store="apw">
                            <span class="float-xs-right">Please check price</span> autopartswarehouse/APW:
                        </li>
                        <li class="list-group-item" data-store="ra">
                            <span class="float-xs-right">Please check price</span> Rockauto/RA:
                        </li>
                        <li class="list-group-item" data-store="pg">
                            <span class="float-xs-right">Please check price</span> Partsgeek/PG:
                        </li>
                        <li class="list-group-item" data-store="amazon">
                            <span class="float-xs-right">$44.99 S&H</span> Amazon:
                        </li>
                        <li class="list-group-item" data-store="ebay">
                            <span class="float-xs-right">$44.99 S&H</span> Ebay:
                        </li>
                        <li class="list-group-item" data-store="atd">
                            <span class="float-xs-right">Please check price</span> ATD:
                        </li>
                        <li class="list-group-item" data-store="future">
                            <span class="float-xs-right">Please check price</span> FUTURE:
                        </li>
                        <li class="list-group-item">
                            <span class="float-xs-right">
                                <select class="form-control" id="custom_store_next_state_select">
                                    <option value="" disabled selected>--Select Next State--</option>
                                    <option value="awaiting_tracking">Awaiting Tracking No.</option>
                                    <option value="print_label">Print Label</option>
                                </select>
                            </span>
                            <input type="text" id="custom_store_input" placeholder="Store name">
                        </li>
                    </ul>
                    <div class="card-block">

                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<div class="row">
    <div class="col-xs-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Shipping & handling</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body collapse in">

                <div class="table-responsive">
                    <table class="table table-column">
                        <tbody>
                        <tr>
                            <td>
                                <label for="">{{ $order->shippingAddress->shipping_service_selected }}</label>
                            </td>
                            <td><input type="text" class="form-control" id="currency-mask" placeholder="" value="{{ $order->shippingAddress->shipping_service_cost }}"></td>
                        </tr>
                        <tr>
                            <td>
                                <select class="form-control" id="basicSelect">
                                    <option>FedEx ground or FedEx home delivery</option>
                                    <option>DHL</option>
                                    <option>Cargo</option>
                                </select>
                            </td>
                            <td><input type="text" class="form-control currency-inputmask" id="currency-mask" placeholder="$____"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Sale Tax Rate <small class="text-muted" style="font-size:13px;"><input type="checkbox" /> Also charge sales tax on S&H</small></h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">

                        <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>

                    </ul>
                </div>
            </div>
            <div class="card-body collapse in">

                <div class="table-responsive">
                    <table class="table ">

                        <tbody>
                        <tr>
                            <td>
                                <label for="">{{ $order->sales_tax_state_value }}</label>
                            </td>
                            <td><input type="text" class="form-control" id="percentage-mask" placeholder="__%" value="{{ $order->sales_tax_percent }}" /></td>
                            <td><input type="text" class="form-control" id="currency-mask" placeholder="$____" value="${{ $order->sales_tax_amount }}"></td>

                        </tr>
                        <tr>
                            <td colspan="2" style="text-align:right;">
                                Seller discount (-) or charges (+):
                            </td>

                            <td><input type="text" class="form-control currency-inputmask" id="currency-mask" placeholder="$____"></td>

                        </tr>
                        <tr>
                            <td>
                                <button class="btn btn-sm btn-success">Recalculate</button>
                            </td>
                            <th>Total</th>
                            <th>${{ $order->total }}</th>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade in" id="tracking_number_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Tracking Number</h4>
            </div>
            <div class="modal-body">
                <div class="card-body collapse in">
                    <div class="card-block">
                        <div class="card-text">
                            <dl>
                                <dt>BuyerID (buyer name)</dt>
                                <dd><span id="buyer_id"></span>(<span id="buyer_name"></span>)</dd>
                                <dt>Item name</dt>
                                <dd>
                                    <a href="#" id="item_title"></a>
                                </dd>
                                <dd>(<span id="item_id"></span>)</dd>

                            </dl>
                        </div>
                        <form class="row">

                            <div class="form-group col-xs-12 mb-2 contact-repeater">
                                <div data-repeater-list="repeater-group" id="tracking_list">
                                    <!--will be rendered by handlebars-->
                                </div>
                                <button type="button" data-repeater-create class="btn btn-info" id="add_tracking_row_btn">
                                    <i class="icon-plus4"></i> Add new
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="tracking_number_save_btn">Save changes</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@parent
<script src="/app-assets/vendors/js/forms/extended/inputmask/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
<!--<script src="../../../app-assets/vendors/js/tables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js" type="text/javascript"></script>-->
<script src="/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js" type="text/javascript"></script>
<script src="/app-assets/js/scripts/forms/extended/form-inputmask.min.js" type="text/javascript"></script>
<script src="/app-assets/js/scripts/forms/form-repeater.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.10/handlebars.min.js"></script>

<script id="tracking_list_template" type="text/x-handlebars-template">
    @{{#each trackings}}
    <div class="input-group tracking_row" data-repeater-item>
        <div class="form-group">
            <div class="row">
                <div class="col-md-5">
                    <label for="eventType2">Tracking number</label>
                    <input type="text" class="form-control tracking_no_input" value="@{{tracking_no}}">
                </div>
                <div class="col-md-5">
                    <label for="eventType2">Carrier</label>
                    <input type="text" class="form-control carrier_used_input" value="@{{carrier_used}}">
                </div>
                <div class="col-md-2">
                    <label for="eventType2">Delete</label>
                    <button type="button" data-repeater-delete="" class="btn btn-icon btn-danger mr-1"><i class="icon-cross2"></i></button>
                </div>
            </div>
        </div>
    </div>
    @{{/each}}
</script>

<script id="empty_tracking_row_template" type="text/x-handlebars-template">
    <div class="input-group tracking_row" data-repeater-item>
        <div class="form-group">
            <div class="row">
                <div class="col-md-5">
                    <label for="eventType2">Tracking number</label>
                    <input type="text" class="form-control tracking_no_input">
                </div>
                <div class="col-md-5">
                    <label for="eventType2">Carrier</label>
                    <input type="text" class="form-control carrier_used_input">
                </div>
                <div class="col-md-2">
                    <label for="eventType2">Delete</label>
                    <button type="button" data-repeater-delete="" class="btn btn-icon btn-danger mr-1"><i class="icon-cross2"></i></button>
                </div>
            </div>
        </div>
    </div>
</script>
{{ $order->status }}
<script>
    var Global = {
        order: {
            id: parseInt("{{ $order->id }}"),
            url: '{{ route("tracking_no.save") }}',
            invoices: JSON.parse('{!! json_encode($invoices) !!}'),
            status: '{{ $order->status }}'
        },
        store: {
            price: {
                url: '{{ route("store.price.get") }}',
                data: {}
            }
        },
        invoice: {
            url_save: '{{ route("invoice.save") }}'
        }
    };
</script>

<script type="text/javascript" src="/js/order_details.js"></script>
<script>

    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#order-info').DataTable();

        $("input:button").click(function () {
            var values = "";
            $(".copy input:text, .copy select").each(function (i) {

                values += (i > 0 ? "\n" : "") + this.value;
            });
            $("textarea").val(values);
        });

        TrackingNumber.init();

    });
</script>
@endsection