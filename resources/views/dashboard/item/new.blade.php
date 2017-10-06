@extends('layouts.main')

@section('meta')
@parent
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('css')
@parent
<link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/wizard.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/pickers/daterange/daterange.min.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                                            <label for="input_category">eBay Category :</label>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default" type="button" id="select_ebay_category">Select eBay Category</button>
                                                </span>
                                                <input type="text" class="form-control" id="input_category" value="" disabled>
                                            </div>
                                            <small id="category_hierarchy" class="text-success"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="input_store_category_id">Store category :</label>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default" type="button" id="select_ebay_store_category">Select Store Category</button>
                                                </span>
                                                <input type="text" class="form-control" id="input_store_category_id" value="" disabled>
                                            </div>
                                            <small id="store_category_hierarchy" class="text-success"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="input_store_category2_id">Store category 2 :</label>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default" type="button" id="select_ebay_store_category2">Select Store Category 2</button>
                                                </span>
                                                <input type="text" class="form-control" id="input_store_category2_id" value="" disabled>
                                            </div>
                                            <small id="store_category2_hierarchy" class="text-success"></small>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <form>
                                            <h4 class="form-section"><i class="icon-file-text"></i> Upload Images</h4>
                                            <div class="row" id="image_container">
                                                <ul>
                                                    <li id="upload_btn_li">
                                                        <button type="button" id="upload_image_btn" class="btn btn-primary btn-sm">
                                                            <i class="icon-plus"></i> Upload
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </form>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <form>
                                            <h4 class="form-section"><i class="icon-file-text"></i> Item specifies</h4>
                                            <div class="row" id="item_specifics_container">

                                            </div>
                                            <button type="button" id="add_item_specifics_row" class="btn btn-primary btn-sm">Add Item Specific</button>
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
                                                                <table class="table table-hover mb-0" id="compatibility_list_table">
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
                                                    <option value="GTC">Good 'Til Cancelled</option>
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
                                                <?php $paypal_emails = $settings->where('scope', 'PAYPAL_EMAIL')->where('key', 'paypal_email')->pluck('value')->all(); ?>
                                                <select name="input_paypal_email" id="input_paypal_email" class="form-control">
                                                    @foreach($paypal_emails as $email)
                                                    @if($loop->first)
                                                    <option value="{{ $email }}" selected="selected">{{ $email }}</option>
                                                    @else
                                                    <option value="{{ $email }}">{{ $email }}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
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
                                                <div class="row">
                                                    <div id="domestic_shipping_container">
                                                        <!--
                                                        <div class="domestic_shipping_row">
                                                            <div class="col-md-3">
                                                                <label for="">&nbsp;</label>
                                                                <select name="input_domestic_service" class="form-control">
                                                                    <option value="">-- Choose a service --</option>
                                                                    <optgroup label="Economy Services"></optgroup>
                                                                    <option value="US_DGMSmartMailGroundFromHK">DGM SmartMail Ground From HK</option>
                                                                    <option value="US_DGMSmartMailGroundFromCN">DGM SmartMail Ground From CN</option>
                                                                    <option value="US_DGMSmartMailGroundFromTW">DGM SmartMail Ground From TW</option>
                                                                    <option value="FedExSmartPost">FedEx SmartPost</option>
                                                                    <option value="US_UPSSurePostFromHK">UPS Surepost From HK</option>
                                                                    <option value="US_UPSSurePostFromCN">UPS Surepost From CN</option>
                                                                    <option value="US_UPSSurePostFromTW">UPS Surepost From TW</option>
                                                                    <option value="US_UPSSurePost">UPS Surepost</option>
                                                                    <option value="USPSMedia">USPS Media Mail</option>
                                                                    <option value="USPSParcel">USPS Parcel Select Ground</option>
                                                                    <option value="USPSStandardPost">USPS Retail Ground</option>
                                                                    <option value="US_DGMSmartMailGround">DGM SmartMail Ground</option>
                                                                    <option value="Other">Economy Shipping</option>
                                                                    <optgroup label="Standard Services"></optgroup>
                                                                    <option value="FedExHomeDelivery">FedEx Ground or FedEx Home Delivery</option>
                                                                    <option value="UPSGround">UPS Ground</option>
                                                                    <option value="USPSFirstClass">USPS First Class Package</option>
                                                                    <option value="US_DGMSmartMailExpeditedFromHK">DGM SmartMail Expedited From HK</option>
                                                                    <option value="US_DGMSmartMailExpeditedFromCN">DGM SmartMail Expedited From CN</option>
                                                                    <option value="US_DGMSmartMailExpeditedFromTW">DGM SmartMail Expedited From TW</option>
                                                                    <option value="US_DGMSmartMailExpedited">DGM SmartMail Expedited</option>
                                                                    <option value="ShippingMethodStandard">Standard Shipping</option>
                                                                    <optgroup label="Expedited Services"></optgroup>
                                                                    <option value="FedEx2Day">FedEx 2Day</option>
                                                                    <option value="FedExExpressSaver">FedEx Express Saver</option>
                                                                    <option value="FedExPriorityOvernight">FedEx Priority Overnight</option>
                                                                    <option value="FedExStandardOvernight">FedEx Standard Overnight</option>
                                                                    <option value="UPS2ndDay">UPS 2nd Day Air</option>
                                                                    <option value="UPS3rdDay">UPS 3 Day Select</option>
                                                                    <option value="UPSNextDayAir">UPS Next Day Air</option>
                                                                    <option value="UPSNextDay">UPS Next Day Air Saver</option>
                                                                    <option value="USPSPriority">USPS Priority Mail</option>
                                                                    <option value="USPSExpressMail">USPS Priority Mail Express</option>
                                                                    <option value="USPSExpressFlatRateEnvelope">USPS Priority Mail Express Flat Rate Envelope</option>
                                                                    <option value="USPSExpressMailLegalFlatRateEnvelope">USPS Priority Mail Express Legal Flat Rate Envelope</option>
                                                                    <option value="USPSPriorityFlatRateEnvelope">USPS Priority Mail Flat Rate Envelope</option>
                                                                    <option value="USPSPriorityMailLargeFlatRateBox">USPS Priority Mail Large Flat Rate Box</option>
                                                                    <option value="USPSPriorityMailLegalFlatRateEnvelope">USPS Priority Mail Legal Flat Rate Envelope</option>
                                                                    <option value="USPSPriorityFlatRateBox">USPS Priority Mail Medium Flat Rate Box</option>
                                                                    <option value="USPSPriorityMailPaddedFlatRateEnvelope">USPS Priority Mail Padded Flat Rate Envelope</option>
                                                                    <option value="USPSPriorityMailSmallFlatRateBox">USPS Priority Mail Small Flat Rate Box</option>
                                                                    <option value="ShippingMethodExpress">Expedited Shipping</option>
                                                                    <option value="ShippingMethodOvernight">One-day Shipping</option>
                                                                    <optgroup label="Other Services"></optgroup>
                                                                    <option value="US_FedExIntlEconomy">FedEx International Economy</option>
                                                                    <option value="US_UPSWorldwideExpeditedFromHK">UPS WorldWide Expedited From HK</option>
                                                                    <option value="US_UPSWorldwideExpeditedFromCN">UPS WorldWide Expedited From CN</option>
                                                                    <option value="US_UPSWorldwideExpeditedFromTW">UPS WorldWide Expedited From TW</option>
                                                                    <option value="US_UPSWorldwideExpressSaverFromHK">UPS Worldwide Express Saver From HK</option>
                                                                    <option value="US_UPSWorldwideExpressSaverFromCN">UPS Worldwide Express Saver From CN</option>
                                                                    <option value="US_UPSWorldwideExpressSaverFromTW">UPS Worldwide Express Saver From TW</option>
                                                                    <option value="US_DHLGlobalMailParcelDirectFromHK">DHL Global Mail Parcel Direct From HK</option>
                                                                    <option value="US_DHLGlobalMailParcelDirectFromCN">DHL Global Mail Parcel Direct From CN</option>
                                                                    <option value="US_DHLGlobalMailParcelDirectFromTW">DHL Global Mail Parcel Direct From TW</option>
                                                                    <option value="US_EconomyShippingFromGC">Economy Shipping from China/Hong Kong/Taiwan to worldwide</option>
                                                                    <option value="EconomyShippingFromOutsideUS">Economy Shipping from outside US</option>
                                                                    <option value="ePacketChina">ePacket delivery from China</option>
                                                                    <option value="ePacketHongKong">ePacket delivery from Hong Kong</option>
                                                                    <option value="US_ExpeditedShippingFromGC">Expedited Shipping from China/Hong Kong/Taiwan to worldwide</option>
                                                                    <option value="ExpeditedShippingFromOutsideUS">Expedited Shipping from outside US</option>
                                                                    <option value="FlatRateFreight">Flat Rate Freight</option>
                                                                    <option value="US_StandardShippingFromGC">Standard Shipping from China/Hong Kong/Taiwan to worldwide</option>
                                                                    <option value="StandardShippingFromOutsideUS">Standard Shipping from outside US</option>
                                                                    <optgroup label="Local Pickup"></optgroup>
                                                                    <option value="Pickup">Local Pickup</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3">
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
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="issueinput4">Each Additional</label>
                                                                    <input type="text" class="form-control currency-inputmask" id="currency-mask" placeholder="Enter Currency in USD">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="issueinput4">AK/HI/PR Surcharge</label>
                                                                    <input type="text" class="form-control currency-inputmask" id="currency-mask" placeholder="Enter Currency in USD">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        -->
                                                    </div>
                                                    <div class="col-md-12">
                                                        <a class="cm-link" href="#" id="edit_rate_table_btn"><i class="icon-plus-square"></i> Edit rate tables</a>
                                                    </div>
                                                </div>
                                                <hr />
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="input_dispatch_time_max">Max dispatch time</label>
                                                            <input type="number" class="form-control" id="input_dispatch_time_max">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="custom-control custom-checkbox">
                                                                <input type="checkbox" id="input_global_shipping" checked="" class="custom-control-input">
                                                                <span class="custom-control-indicator"></span>
                                                                <span class="custom-control-description">Enable Global Shipping</span>
                                                            </label>
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

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput6">Tax</label>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="input_use_ebay_tax_table" checked="" class="custom-control-input">
                                                        <span class="custom-control-indicator"></span>
                                                        <span class="custom-control-description">Use eBay tax table</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control">Excluded shipping locations</label>
                                            <div class="col-md-9">
                                                <p id="exclude_shipping_location_text"></p>
                                                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#exclude_shipping_location_modal">Edit list</button>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput6">Country</label>
                                            <div class="col-md-9">
                                                <?php $countryCodes = \App\Enum\Ebay\CountryCodeType::toArray() ?>
                                                <select name="input_country" id="input_country" class="form-control">
                                                    @foreach($countryCodes as $k=>$v)
                                                    <option value="{{ $k }}" {{ $k == 'US' ? 'selected="selected"' : '' }}>{{ $v }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput6">Item location</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="input_location" value="Astoria, New York">
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

<div class="modal fade in" id="new_item_specifics_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

                <fieldset>
                    <form class="form form-horizontal">
                        <div class="form-body">
                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="input_new_item_specific_label">Item specific label</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="input_new_item_specific_label">
                                </div>
                            </div>
                        </div>
                    </form>
                </fieldset>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary save_btn">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade in" id="select_category_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

                <div class="ebay_category_tree" data-url="{{ route('ebay.category.get', request('site_id')) }}"></div>
                <!--<div class="ebay_category_tree"></div>-->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade in" id="select_store_category_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

                <div class="ebay_store_category_tree" data-url="{{ route('ebay.store.category.get', request('store_id')) }}"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade in" id="select_store_category2_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

                <div class="ebay_store_category2_tree" data-url="{{ route('ebay.store.category.get', request('store_id')) }}"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade in" id="exclude_shipping_location_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Exclude Shipping Location</h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    @foreach($countryCodes as $k=>$v)
                    <div class="col-md-4"><input type="checkbox" name="exclude_shipping_location[]" value="{{ $k }}" data-name="{{ $v }}"> {{ $v }}</div>
                    @endforeach
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade in" id="add_compatibility_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add new compatibility</h4>
            </div>
            <div class="modal-body">
                <table>
                    <tr>
                        <td>Make</td>
                        <td>Model</td>
                        <td>Year</td>
                        <td>Trim</td>
                        <td>Engine</td>
                    </tr>
                    <tr>
                        <td><input type="text" class="form-control" placeholder="Make" name="make"></td>
                        <td><input type="text" class="form-control" placeholder="Model" name="model"></td>
                        <td><input type="text" class="form-control" placeholder="Yar" name="year"></td>
                        <td><input type="text" class="form-control" placeholder="Trim" name="trim"></td>
                        <td><input type="text" class="form-control" placeholder="Engine" name="engine"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="add_compatibility_modal_save_btn">Save</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')
@parent

<script>
    var Global = {
        ebay_item_search: '{{ $search }}' == '1',
        item_id: parseInt('{{ request("item_id") }}'),
        item_get_url: '{{ route("ebay.item.find", ["store_id"=>request("store_id"), "item_id"=>request("item_id")]) }}',
        post_store_item_url: '{{ route("item.listing.new.store", ["store_id"=>request("store_id")]) }}',
        store_id: parseInt('{{ request("store_id") }}'),
        category_hierarchy_name_url: '{{ route("ebay.category.hierarchy_name") }}',
        site_id: parseInt('{{ request("site_id") }}'),
        $compatibility_list_table: null,
    };
</script>

<script src="/app-assets/vendors/js/extensions/jquery.steps.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/forms/validation/jquery.validate.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/pickers/daterange/daterangepicker.js" type="text/javascript"></script>
<script src="/app-assets/js/scripts/forms/wizard-steps.min.js" type="text/javascript"></script>
<script src="https://cdn.ckeditor.com/4.7.3/full/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.4/lodash.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>
<script src="/js/pre_loader.js"></script>
<script src="/js/ebay-category-select.js"></script>
<script src="/js/new-listing.js"></script>
<script src="/js/script.js"></script>

<script>
    $(document).ready(function(){
        CKEDITOR.replace('description_editor');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $( "#image_container ul" ).sortable({
            axis: "x",
            cursor: "move",
            items: "> li:not(#upload_btn_li)"
        });

        Global.$compatibility_list_table = $("#compatibility_list_table").DataTable({
            data: []
        });


    });
</script>

@endsection
