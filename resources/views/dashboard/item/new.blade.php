@extends('layouts.main')

@section('meta')
@parent
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('css')
@parent
<link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/wizard.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/pickers/daterange/daterange.min.css">
@endsection

@section('content_header')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-xs-12 mb-1">
        <h2 class="content-header-title">New Listing</h2>
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

<section id="icon-tabs">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">To create new listings just complete this wizard</h4>
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

                <div class="card-body collapse in" id="listing_container">
                    <div class="card-block">
                        <div action="#" class="icons-tab-steps wizard-circle">
                            <!-- Step 1 -->
                            <h6><i class="step-icon icon-home4"></i> Product details</h6>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="input_title">Title :</label>
                                            <input type="text" class="form-control" id="input_title" />
                                        </div>
                                        <div class="form-group">
                                            <label for="input_sku">Custom label :</label>
                                            <input type="text" class="form-control" id="input_sku">
                                        </div>
                                        <!--<div class="form-group">
                                            <label for="input_second_category">Second category :</label>
                                            <input type="text" class="form-control" id="input_second_category" value="">
                                        </div>-->
                                        <div class="form-group">
                                            <label for="input_upc">UPC</label>
                                            <input type="text" class="form-control" id="input_upc">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="input_category">Category :</label>
                                            <input type="text" class="form-control" id="input_category" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="input_store_category_id">Store category :</label>
                                            <input type="text" class="form-control" id="input_store_category_id" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="input_store_category2_id">Store category 2 :</label>
                                            <input type="text" class="form-control" id="input_store_category2_id" value="">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <!--Image upload-->
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <form>
                                            <h4 class="form-section"><i class="icon-file-text"></i> Item specifies</h4>
                                            <div class="row" id="item_specifics_container">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="input_brand">Brand</label>
                                                        <input type="text" class="form-control" id="input_brand">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="input_mpn">Manufacturer part number</label>
                                                        <input type="text" class="form-control" id="input_mpn">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="input_ipn">Interchange part number</label>
                                                        <input type="text" class="form-control" id="input_ipn">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="input_opn">Other part number</label>
                                                        <input type="text" class="form-control" id="input_opn">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="input_placement_in_vehicle">Placement in vehicle</label>
                                                        <input type="text" class="form-control" id="input_placement_in_vehicle">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="input_surface_finish">Surface finish</label>
                                                        <input type="text" class="form-control" id="input_surface_finish">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="input_warranty">Warranty</label>
                                                        <input type="text" class="form-control" id="input_warranty">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="input_type">Type</label>
                                                        <input type="text" class="form-control" id="input_type">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="input_fitment_type">Fitment Type</label>
                                                        <input type="text" class="form-control" id="input_fitment_type">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="input_material">Material</label>
                                                        <input type="text" class="form-control" id="input_material">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="input_country_of_region_manufacturer">Country or region of manufacturer</label>
                                                        <input type="text" class="form-control" id="input_country_of_region_manufacturer">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="input_superseded_part_no">Superseded Part Number</label>
                                                        <input type="text" class="form-control" id="input_superseded_part_no">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="row" id="compatibility_list_container">
                                    <div class="col-md-12">
                                        <form>
                                            <h4 class="form-section"><i class="icon-file-text"></i>Compatibility</h4>
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <h5>Specify vehicles that this item fits</h5>

                                                        <div class="card box-shadow-0 card-outline-info">
                                                            <div class="card-header">
                                                                <span>compatible vehicles added </span>
                                                                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                                                                <div class="heading-elements">
                                                                    <ul class="list-inline mb-0">
                                                                        <li><a data-toggle="modal" data-target="#add_compatibility_modal"><i class="icon-plus"></i></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="card-body collapse in">
                                                                <table class="table table-hover mb-0">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>Make</th>
                                                                        <th>Model</th>
                                                                        <th>Year</th>
                                                                        <th>Trim</th>
                                                                        <th>Engine</th>
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
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <form>
                                            <h4 class="form-section"><i class="icon-file-text"></i>Item description</h4>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <textarea name="shortDescription" id="description_editor" rows="8" class="form-control editor"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </fieldset>
                            <!-- Step 2 -->
                            <h6><i class="step-icon icon-pencil"></i>Selling details</h6>
                            <fieldset>
                                <form class="form form-horizontal">
                                    <div class="form-body">
                                        <h4 class="form-section"><i class="icon-head"></i> Selling details</h4>

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput6">Duration</label>
                                            <div class="col-md-9">
                                                <select id="input_listing_duration" name="" class="form-control">
                                                    <option value="GTC" selected="" disabled="">Good 'Til Cancelled</option>
                                                    <option value="Days_1">1 Day</option>
                                                    <option value="Days_3">3 Days</option>
                                                    <option value="Days_5">5 Days</option>
                                                    <option value="Days_7">7 Days</option>
                                                    <option value="Days_10">10 Days</option>
                                                    <option value="Days_14">14 Days</option>
                                                    <option value="Days_21">21 Days</option>
                                                    <option value="Days_30">30 Days</option>
                                                    <option value="Days_60">60 Days</option>
                                                    <option value="Days_90">90 Days</option>
                                                    <option value="Days_120">120 Days</option>
                                                </select>
                                                <!--<fieldset>
                                                    <label class="custom-control custom-radio">
                                                        <input id="radioStacked1" name="radio-stacked1" type="radio" class="custom-control-input">
                                                        <span class="custom-control-indicator"></span>
                                                        <span class="custom-control-description">Start my listings when I submit them</span>
                                                    </label>
                                                </fieldset>
                                                <fieldset>
                                                    <label class="custom-control custom-radio">
                                                        <input id="radioStacked2" name="radio-stacked1" type="radio" checked class="custom-control-input">
                                                        <span class="custom-control-indicator"></span>
                                                        <span class="custom-control-description">Schedule to start on <input type="datetime-local" class="" id="dateTime" value="2011-08-19T13:45:00"></span>
                                                    </label>
                                                </fieldset>-->
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="input_condition_id">Condition</label>
                                            <div class="col-md-9">
                                                <select name="input_condition_id" id="input_condition_id" class="form-control">
                                                    <option value="1000">New</option>
                                                    <option value="1750">New with defects</option>
                                                    <option value="2000">Manufacturer refurbished</option>
                                                    <option value="2500">Seller refurbished</option>
                                                    <option value="2750">Like New</option>
                                                    <option value="3000">Used</option>
                                                    <option value="5000">Good</option>
                                                    <option value="6000">Acceptable</option>
                                                    <option value="7000">For parts or not working</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="input_price">Price</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="input_price" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="input_quantity">Quantity</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="input_quantity" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput3">Payment options</label>
                                            <div class="col-md-9">
                                                <div class="c-inputs-stacked">
                                                    <label class="inline custom-control custom-checkbox block">
                                                        <input type="checkbox" class="custom-control-input" checked>
                                                        <span class="custom-control-indicator"></span>
                                                        <span class="custom-control-description ml-0">Paypal</span>
                                                    </label>
                                                </div>
                                                <input type="text" id="input_paypal_email" class="form-control" placeholder="Paypal email address">
                                                <!--<p>Additional checkout instructions (shows in your listing)</p>
                                                <textarea rows="8" class="form-control" id="input_checkout_instruction"></textarea>-->
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput4">Return options</label>
                                            <div class="col-md-9">
                                                <fieldset>
                                                    <label class="custom-control custom-radio">
                                                        <input name="is_return_accepted" value="yes" type="radio" class="custom-control-input">
                                                        <span class="custom-control-indicator"></span>
                                                        <span class="custom-control-description">Returns accepted</span>
                                                    </label>
                                                    <p>After receiving the item, your buyer should start a return within</p>
                                                    <select id="input_returns_within" name="input_returns_within" class="form-control">
                                                        <option value="Days_14" selected="" disabled="">14 days</option>
                                                        <option value="Days_30">30 days</option>
                                                        <option value="Days_60">60 days</option>
                                                        <option value="Months_1">1 month</option>
                                                    </select>
                                                    <p>Refund will be given as</p>
                                                    <select id="input_refund_given_as" name="input_refund_given_as" class="form-control">
                                                        <option value="MoneyBack">Money Back</option>
                                                        <option value="MoneyBackOrExchange">Money Back Or Exchange</option>
                                                        <option value="MoneyBackOrReplacement">Money Back Or Replacement</option>
                                                    </select>
                                                    <p>Return shipping will be paid by:</p>
                                                    <select id="input_return_shipping_paid_by" name="budget" class="form-control">
                                                        <option value="Buyer" selected>Buyer</option>
                                                        <option value="Seller">Seller </option>
                                                    </select>
                                                    <p>Additional return policy details</p>
                                                    <textarea rows="6" class="form-control" id="return_policy_description"></textarea>
                                                    <p>Do you charge a restocking fee?</p>
                                                    <select id="input_restocking_fee" name="budget" class="form-control">
                                                        <option value="NoRestockingFee" selected>No Restocking Fee</option>
                                                        <option value="Percent_10">10%</option>
                                                        <option value="Percent_15">15%</option>
                                                        <option value="Percent_20">20%</option>
                                                    </select>
                                                </fieldset>
                                                <br />
                                                <fieldset>
                                                    <label class="custom-control custom-radio">
                                                        <input name="is_return_accepted" value="no" type="radio" class="custom-control-input">
                                                        <span class="custom-control-indicator"></span>
                                                        <span class="custom-control-description">Returns not accepted </span>
                                                    </label>
                                                    <p class="text-muted">The item could still be returned if it doesn't match the listing's descriptions.</p>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>

                                </form>

                            </fieldset>
                            <!-- Step 3 -->
                            <h6><i class="step-icon icon-monitor3"></i>Shipping details</h6>
                            <fieldset>
                                <form class="form form-horizontal">
                                    <div class="form-body">
                                        <h4 class="form-section"><i class="icon-head"></i> Shipping details</h4>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput6">Domestic shipping</label>
                                            <div class="col-md-9">
                                                <select id="projectinput6" name="interested" class="form-control">
                                                    <option value="none" selected="" disabled="">Flat: same cost to all buyers</option>
                                                    <option value="design">design</option>
                                                    <option value="development">development</option>
                                                    <option value="illustration">illustration</option>
                                                    <option value="branding">branding</option>
                                                    <option value="video">video</option>
                                                </select>
                                                <div class="c-inputs-stacked">
                                                    <label class="inline custom-control custom-checkbox block">
                                                        <input type="checkbox" class="custom-control-input" checked>
                                                        <span class="custom-control-indicator"></span>
                                                        <span class="custom-control-description ml-0">Use my rate tables</span>

                                                    </label>

                                                </div>
                                                <a class="cm-link" href="#">Create/Edit rate tables</a>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="issueinput3">Services</label><a href="#" target="_blank"> Calculate Shipping</a>
                                                            <input type="text" class="form-control">
                                                            <div class="c-inputs-stacked">
                                                                <label class="inline custom-control custom-checkbox block">
                                                                    <input type="checkbox" class="custom-control-input" checked>
                                                                    <span class="custom-control-indicator"></span>
                                                                    <span class="custom-control-description ml-0">Add a surcharge for Alaska, Hawawii and Puerto Rico</span><input />

                                                                </label>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="issueinput4">Cost</label>
                                                            <label class="inline custom-control custom-checkbox block">
                                                                <input type="checkbox" class="custom-control-input" checked>
                                                                <span class="custom-control-indicator"></span>
                                                                <span class="custom-control-description ml-0"> <a href="#" target="_blank"> Free shipping</a></span>
                                                            </label>
                                                            <input type="text" class="form-control currency-inputmask" id="currency-mask" placeholder="Enter Currency in USD">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="issueinput3">Services</label><a href="#" target="_blank"> Offer additional service</a>
                                                            <input type="text" class="form-control">
                                                            <div class="c-inputs-stacked">
                                                                <label class="inline custom-control custom-checkbox block">
                                                                    <input type="checkbox" class="custom-control-input" checked>
                                                                    <span class="custom-control-indicator"></span>
                                                                    <span class="custom-control-description ml-0">Add a surcharge for Alaska, Hawawii and Puerto Rico</span><input />

                                                                </label>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="issueinput4">Cost</label>
                                                            <a href="#" target="_blank">Remove service</a>
                                                            <input type="text" class="form-control currency-inputmask" id="currency-mask" placeholder="Enter Currency in USD">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">

                                                            <label class="inline custom-control custom-checkbox block">
                                                                <input type="checkbox" class="custom-control-input" checked>
                                                                <span class="custom-control-indicator"></span>
                                                                <span class="custom-control-description ml-0">Offer local pickup</span>
                                                            </label>
                                                            <input type="text" id="issueinput4" class="form-control" placeholder="Enter pickup cost">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="issueinput4">Max dispatch time</label>
                                                            <input type="number" class="form-control" id="input_dispatch_time_max">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput6">Package weight & dimensions</label>
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="input_shipping_package_type">Package Type</label>
                                                            <?php $packageTypes = \App\Enum\Ebay\ShippingPackageDetails::toArray(); ?>
                                                            <select id="input_shipping_package_type" name="interested" class="form-control">
                                                                @foreach($packageTypes as $k=>$v)
                                                                <option value="{{ $k }}">{{ $v }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <label for="eventType2">Dimensions (L X W X D) :</label>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <input type="number" id="input_package_length" class="form-control" placeholder="Length in inch">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="number" id="input_package_width" class="form-control" placeholder="Width in inch">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="number" id="input_package_depth" class="form-control" placeholder="Depth in inch">
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-group">
                                                    <label for="eventType2">Weight :</label>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <input type="number" id="input_weight_major" class="form-control" placeholder="Weight Major in lbs">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="number" id="input_weight_minor" class="form-control" placeholder="Weight minor in oz">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!--<div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput6">Excluded shippiing locations</label>
                                            <div class="col-md-9">
                                                <p>Alaska/Hawaii, US Protectorates, APO/FPO, Equatorial Guinea, Kenya, Egypt, Niger, Zambia</p>
                                                <a href="#">Edit list</a>
                                            </div>
                                        </div>-->
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput6">Country</label>
                                            <div class="col-md-9">
                                                <?php $countryCodes = \App\Enum\Ebay\CountryCodeType::toArray() ?>
                                                <select name="input_country" id="input_country" class="form-control">
                                                    @foreach($countryCodes as $k=>$v)
                                                    <option value="{{ $k }}">{{ $v }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput6">Item location</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="input_location">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </fieldset>
                            <!-- Step 4 -->

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
@parent

<script>
    var Global = {
        ebay_item_search: '{{ $search }}' == '1',
        item_id: parseInt('{{ request("item_id") }}'),
        item_get_url: '{{ route("ebay.item.find", ["store_id"=>request("store_id"), "item_id"=>request("item_id")]) }}',
        post_store_item_url: '{{ route("item.listing.new.store") }}',
        store_id: parseInt('{{ request("store_id") }}'),
    };
</script>

<script src="/app-assets/vendors/js/extensions/jquery.steps.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/forms/validation/jquery.validate.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/pickers/daterange/daterangepicker.js" type="text/javascript"></script>
<script src="/app-assets/js/scripts/forms/wizard-steps.min.js" type="text/javascript"></script>
<script src="https://cdn.ckeditor.com/4.7.3/full/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.4/lodash.min.js"></script>
<script src="/js/pre_loader.js"></script>
<script src="/js/new-listing.js"></script>

<script>
    $(document).ready(function(){
        CKEDITOR.replace('description_editor');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    });
</script>

@endsection
