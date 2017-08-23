@extends('layouts.main')

@section('css')
@parent
<link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/extended/form-extended.min.css">
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
                                        <input type="text" class="form-control" placeholder="Enter buyer's full name" value="Araf Nishan"/>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <h6>
                                        Street

                                    </h6>
                                    <div class="form-group">
                                        <input type="text" class="form-control mb-1" placeholder="Enter street address" value="6220 88th St"/>
                                        <input type="text" class="form-control" placeholder="Extra line of street address" value="Pokhara valley" />
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <h6>
                                        City

                                    </h6>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Enter City name" value="Sanfransisco"/>

                                    </div>
                                </fieldset>
                                <fieldset>
                                    <h6>
                                        State/ Province

                                    </h6>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Enter state/ province name" value="LA"/>

                                    </div>
                                </fieldset>
                                <fieldset>
                                    <h6>
                                        Zip/ Postal Code

                                    </h6>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Enter zip/ postal Code" value="1243"/>

                                    </div>
                                </fieldset>
                                <fieldset>
                                    <h6>
                                        Select Country

                                    </h6>
                                    <div class="form-group">
                                        <select class="form-control" id="basicSelect">
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
                                        <input type="text" class="form-control xphone-inputmask" id="xphone-mask" placeholder="Enter Phone Number" value="(999) 999-9999 / x999999"/>
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
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Quantity</th>
                                <th>Item #</th>
                                <th style="width:100px">Picture</th>
                                <th>Item Name</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>272540515751</td>
                                <td><span><img src="../../../app-assets/images/product/BM10661061.jpg" style="width:100%;" /></span></td>
                                <td>
                                    <a href="#" class="text-bold-600">New bumper grille fits 2015 acura tlx rh outrter</a>
                                    <p class="text-muted font-small-2">Phasellus vel elit volutpat, egestas urna a.</p>
                                </td>
                                <td>$57.98</td>
                                <td>$57.98</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>272540515751</td>
                                <td><span><img src="../../../app-assets/images/product/BM10661061.jpg" style="width:100%;" /></span></td>
                                <td>
                                    <a href="#" class="text-bold-600">New bumper grille fits 2015 acura tlx rh outrter</a>
                                    <p class="text-muted font-small-2">Phasellus vel elit volutpat, egestas urna a.</p>
                                </td>
                                <td>$57.98</td>
                                <td>$57.98</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>272540515751</td>
                                <td><span><img src="../../../app-assets/images/product/BM10661061.jpg" style="width:100%;" /></span></td>
                                <td>
                                    <a href="#" class="text-bold-600">New bumper grille fits 2015 acura tlx rh outrter</a>
                                    <p class="text-muted font-small-2">Phasellus vel elit volutpat, egestas urna a.</p>
                                </td>
                                <td>$57.98</td>
                                <td>$57.98</td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Total</th>
                                <th>$57.98</th>
                            </tr>
                            </tfoot>
                        </table>
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
                                <select class="form-control" id="basicSelect">
                                    <option>FedEx ground or FedEx home delivery</option>
                                    <option>DHL</option>
                                    <option>Cargo</option>

                                </select>
                            </td>
                            <td><input type="text" class="form-control currency-inputmask" id="currency-mask" placeholder="$____"></td>
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
                                <select class="form-control" id="basicSelect">
                                    <option>No sales tax</option>
                                    <option>Fixed sales tax</option>


                                </select>
                            </td>
                            <td><input type="text" class="form-control percentage-inputmask" id="percentage-mask" placeholder="__%" /></td>
                            <td><input type="text" class="form-control currency-inputmask" id="currency-mask" placeholder="$____"></td>

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
                            <th>$57.98</th>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<section>
    <div class="row match-height">
        <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="card" style="height: 453px;">
                <div class="card-body">
                    <div class="card-block" style="padding:1.25rem;">

                        <p class="card-text"><b>Invoice</b></p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <span class="float-xs-right"><input type="text" class="form-control" value="$57"/></span> Sold price:
                        </li>
                        <li class="list-group-item">
                            <span class="float-xs-right"><input type="text" class="form-control" value="$23"/></span> Product Cost:
                        </li>
                        <li class="list-group-item">
                            <span class="float-xs-right"><input type="text" class="form-control" value="$7"/></span> Shipping cost:
                        </li>
                        <li class="list-group-item">
                            <span class="float-xs-right"><input type="text" class="form-control" value="$0"/></span> Handling Cost:
                        </li>
                        <li class="list-group-item">
                            <span class="float-xs-right"><input type="text" class="form-control" value="$6.96"/></span> Fees:
                        </li>
                        <li class="list-group-item">
                            <span class="float-xs-right"><input type="text" class="form-control" value="$20"/></span> Profit:
                        </li>
                    </ul>
                    <div class="card-block">
                        <a href="#" class="btn btn-sm btn-info">Edit</a>
                        <a href="#" class="btn btn-sm btn-success">Submit</a>
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
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <span class="float-xs-right">$42.98 S&H</span> Perfect Fit:
                        </li>
                        <li class="list-group-item">
                            <span class="float-xs-right">$23.53 W/O S&H</span> KeyStone:
                        </li>
                        <li class="list-group-item">
                            <span class="float-xs-right">Please check price</span> Cap:
                        </li>
                        <li class="list-group-item">
                            <span class="float-xs-right">$44.99 S&H</span> Ebay:
                        </li>
                        <li class="list-group-item">
                            <span class="float-xs-right">$44.99 S&H</span> Amazon:
                        </li>
                    </ul>
                    <div class="card-block">

                    </div>
                </div>
            </div>
        </div>


    </div>
</section>
<section id="form-repeater">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="tel-repeater">Tracking details</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">

                            <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                            <li><a data-action="expand"><i class="icon-expand2"></i></a></li>

                        </ul>
                    </div>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block">
                        <div class="card-text">
                            <dl>
                                <dt>BuyerID (buyer name, location)</dt>
                                <dd>paris181-2007(Russell J Dauzat, 70452)</dd>
                                <dt>Item name</dt>
                                <dd>
                                    <a href="#">New 2010-2016 FITS FORD TAURUS INNER FENDER FRONT LEFT DRVER SIDE</a>
                                </dd>
                                <dd>(331633910429)</dd>

                            </dl>
                        </div>
                        <form class="row">

                            <div class="form-group col-xs-12 mb-2 contact-repeater">
                                <div data-repeater-list="repeater-group">

                                    <div class="input-group" data-repeater-item>
                                        <div class="form-group">

                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label for="eventType2">Tracking number</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="col-md-5">
                                                    <label for="eventType2">Carrier</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="eventType2">Delete</label>
                                                    <button type="button" data-repeater-delete="" class="btn btn-icon btn-danger mr-1"><i class="icon-cross2"></i></button>
                                                </div>
                                            </div>

                                        </div>
                                        <!--<input type="tel" placeholder="Telephone" class="form-control" id="example-tel-input">
                                        <span class="input-group-btn" id="button-addon2">
                                            <button class="btn btn-danger" type="button" data-repeater-delete><i class="icon-cross2"></i></button>
                                        </span>-->
                                    </div>
                                </div>
                                <button type="button" data-repeater-create class="btn btn-info">
                                    <i class="icon-plus4"></i> Add new
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
@parent
<script src="/app-assets/vendors/js/forms/extended/inputmask/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
<!--<script src="../../../app-assets/vendors/js/tables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js" type="text/javascript"></script>-->
<script src="/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js" type="text/javascript"></script>
<script src="/app-assets/js/scripts/forms/extended/form-inputmask.min.js" type="text/javascript"></script>
<script src="/app-assets/js/scripts/forms/form-repeater.min.js" type="text/javascript"></script>

<script>
    $(document).ready(function () {
        $('#order-info').DataTable();

        $("input:button").click(function () {
            var values = "";
            $(".copy input:text, .copy select").each(function (i) {

                values += (i > 0 ? "\n" : "") + this.value;
            });
            $("textarea").val(values);
        });
    });
</script>
@endsection