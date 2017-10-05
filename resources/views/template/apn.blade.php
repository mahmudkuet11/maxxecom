@inject('listingDescService', 'App\Service\ListingDescService')
<table align="center" style="border-spacing: 0px; width: 100%;">
    <tr>
        <td>
            <div id="ds_div">
                <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
                      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
                      crossorigin="anonymous">
                <link href="{{ $url }}global.css" rel="stylesheet" type="text/css">
                <link href="{{ $url }}local.css" rel="stylesheet" type="text/css">
                <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600,700,700ii"
                      rel="stylesheet">
                <div id="x-template" class="x-bg">
                    <div class="x-bg-02 x-shao">
                        <!-- beg header -->
                        <div id="x-head-pull"><!-- head pull --></div>
                        <!-- end header -->
                        <!-- beg header -->
                        <div id="x-head-wrap">
                            <div id="x-head">
                                <div id="x-head-bar1" class="x-hdbg">
                                    <!-- head promos-->
                                    <div class="x-fbox" style="visibility: hidden;"><img id="x-head-prom-01" src="{{ $url }}images/warranty.png"
                                                                                         alt="12 Months Warranty"></div>
                                    <!-- head logo -->
                                    <div class="x-fbox"><a target="_blank"
                                                           href="http://stores.ebay.com/AutoParts-Nationwide"><img
                                                id="x-head-logo" src="{{ $url }}images/APN-Sample-logo.png"
                                                alt="APN EBay Store"></a></div>
                                    <!-- head promos-->
                                    <div class="x-fbox" style="visibility: hidden;"><img id="x-head-prom-02" src="{{ $url }}images/delivery.png"
                                                                                         alt="Delivery"></div>
                                    <!-- head mobile menu -->
                                    <div id="x-head-mnav">
                                        <div class="x-mbox"><input id="x-mbox-01" type="checkbox"><label
                                                for="x-mbox-01">MENU</label>
                                            <div class="x-mnav">
                                                <h4>Store Pages</h4>
                                                <ul>
                                                    <li><a target="_blank"
                                                           href="http://stores.ebay.com/AutoParts-Nationwide">Store
                                                            Home</a>
                                                    </li>
                                                    <li><a target="_blank"
                                                           href="http://stores.ebay.com/Autoparts-Nationwide_W0QQ_sasiZ1">View
                                                            All Listings</a></li>
                                                    <li><a target="_blank"
                                                           href="http://stores.ebay.com/Autoparts-Nationwide/About-Us">About
                                                            Us</a></li>
                                                    <li><a target="_blank"
                                                           href="http://stores.ebay.com/Autoparts-Nationwide/Shipping-Info">Shipping
                                                            Info</a>
                                                    </li>
                                                    <li><a target="_blank"
                                                           href="http://stores.ebay.com/Autoparts-Nationwide/FAQ">FAQ'S</a>
                                                    </li>
                                                    <li><a target="_blank"
                                                           href="http://contact.ebay.com/ws/eBayISAPI.dll?ContactUserNextGen&recipient=autoparts-nationwide">Contact
                                                            Us</a></li>
                                                </ul>
                                                <h4>Store Categories</h4>
                                                <ul>
                                                    <li><a target="_blank"
                                                           href="http://stores.ebay.com/Autoparts-Nationwide_W0QQ_fsubZ6702596015">Body
                                                            Parts</a></li>
                                                    <li><a target="_blank"
                                                           href="http://stores.ebay.com/Autoparts-Nationwide_W0QQ_fsubZ7093320015">Headlights</a>
                                                    </li>
                                                    <li><a target="_blank"
                                                           href="http://stores.ebay.com/Autoparts-Nationwide_W0QQ_fsubZ6702605015">Engine
                                                            Parts</a>
                                                    </li>
                                                    <li><a target="_blank"
                                                           href="http://stores.ebay.com/Autoparts-Nationwide_W0QQ_fsubZ6702621015">Brakes</a>
                                                    </li>
                                                    <li><a target="_blank"
                                                           href="http://stores.ebay.com/Autoparts-Nationwide_W0QQ_fsubZ6702614015">Suspension</a>
                                                    </li>
                                                    <li><a target="_blank"
                                                           href="http://stores.ebay.com/Autoparts-Nationwide_W0QQ_fsubZ7008126015">Tires</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="x-head-bar2" class="x-bar2">
                                    <!-- head menu links -->
                                    <div id="x-head-menu">
                                        <a class="x-bar2" target="_blank"
                                           href="http://stores.ebay.com/AutoParts-Nationwide"><span
                                                class="x-ffac x-fftb">Store Home</span></a>
                                        <a class="x-bar2" target="_blank"
                                           href="http://stores.ebay.com/Autoparts-Nationwide_W0QQ_sasiZ1"><span
                                                class="x-ffac x-fftb">View All Listings</span></a>
                                        <a class="x-bar2"
                                           target="_blank"
                                           href="http://stores.ebay.com/Autoparts-Nationwide/About-Us"><span
                                                class="x-ffac x-fftb">About Us</span></a>
                                        <a class="x-bar2"
                                           target="_blank"
                                           href="http://stores.ebay.com/Autoparts-Nationwide/Shipping-Info"><span
                                                class="x-ffac x-fftb">Shipping Info</span></a>
                                        <a class="x-bar2"
                                           target="_blank"
                                           href="http://stores.ebay.com/Autoparts-Nationwide/FAQ"><span
                                                class="x-ffac x-fftb">FAQ'S</span></a>
                                        <a class="x-bar2" target="_blank"
                                           href="http://contact.ebay.com/ws/eBayISAPI.dll?ContactUserNextGen&recipient=autoparts-nationwide"><span
                                                class="x-ffac x-fftb">Contact Us</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end header -->
                        <div class="x-content">
                            <!-- beg left panel -->
                            <div id="LeftPanel">
                                <!-- left categories menu -->
                                <h4 id="x-side-tbar-cats" class="x-ttba x-fftb x-brdt x-bktt">
                                    <div class="x-tins x-ffac">Store <span class="x-ital">Categories</span></div>
                                </h4>
                                <div id="x-side-cats" class="x-sbox x-brdm x-bklt">
                                    <div class="x-tins">
                                        <ul class="lev1">
                                            <li><a target="_blank"
                                                   href="http://stores.ebay.com/Autoparts-Nationwide_W0QQ_fsubZ6702596015">Body
                                                    Parts & Components</a></li>
                                            <li><a target="_blank"
                                                   href="http://stores.ebay.com/Autoparts-Nationwide_W0QQ_fsubZ7093320015">Headlights & Components</a>
                                            </li>
                                            <li><a target="_blank"
                                                   href="http://stores.ebay.com/Autoparts-Nationwide_W0QQ_fsubZ6702605015">Engine
                                                    Parts & Components</a>
                                            </li>
                                            <li><a target="_blank"
                                                   href="http://stores.ebay.com/Autoparts-Nationwide_W0QQ_fsubZ6702621015">Brakes & Components</a>
                                            </li>
                                            <li><a target="_blank"
                                                   href="http://stores.ebay.com/Autoparts-Nationwide_W0QQ_fsubZ6702614015">Suspension & Components</a>
                                            </li>
                                            <li><a target="_blank"
                                                   href="http://stores.ebay.com/Autoparts-Nationwide_W0QQ_fsubZ7008126015">Tires & Wheels</a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                <!-- left promo graphics -->
                                <a target="_blank" style="margin-bottom: 0px;"
                                   href="http://my.ebay.com/ws/eBayISAPI.dll?AcceptSavedSeller&linkname=includenewsletter&sellerid=autoparts-nationwide"><img
                                        src="{{ $url }}images/newsletter-lg2.jpg" class="x-prom"
                                        alt="Sign Up For Our Newsletter"></a>
                                <!--<img src="images/low-price.jpg" class="x-prom" alt="Low Prices">-->
                                <a target="_blank"  href="http://stores.ebay.com/AutoParts-Nationwide"><img src="{{ $url }}images/x-side-stor1.png" style="margin-bottom: 0px;" class="x-prom" alt="click for our ebay store"></a>
                                <img src="{{ $url }}images/x-side-free1.png" style="margin-bottom: 0px;" class="x-prom" alt="free shipping">
                                <a target="_blank" style="margin-bottom: 0px;" href="http://my.ebay.com/ws/eBayISAPI.dll?AcceptSavedSeller&linkname=includenewsletter&sellerid=autoparts-nationwide"><img src="{{ $url }}images/x-side-fave1.png" class="x-prom" alt="Click to add favourites"></a>



                            </div>
                            <!-- end left panel -->
                            <!-- beg right panel -->
                            <div id="x-main">
                                <!-- listing gallery -->
                                <div id="x-main-gall" class="x-pbox x-brdm x-bklt">
                                    <div class="x-tins">
                                        <!-- LISTING TITLE GOES HERE --><h1>{{ $item->title }}</h1>
                                        <!-- LISTING SINGLE IMAGE GOES HERE -->
                                        <div class="row" id="allign">
                                            <div class="col-sm-6">
                                                <img src="{{ $item->gallery_url }}" class="img-responsive">
                                            </div>
                                            <div class="col-sm-6">
                                                <div id="x-main-spec">
                                                    <h5 id="x-main-tbar-spec" class="x-ttba x-fftb x-brdt x-bktt">
                                                        <div class="x-tins x-ffac">Item <span
                                                                class="x-ital">Specifications</span></div>
                                                    </h5>
                                                    <div class="x-tbox x-brdm x-bklt">
                                                        <table cellspacing="0" cellpadding="0">
                                                            <!-- LISTING SPECS INFO GOES HERE -->
                                                            <tbody>
                                                            <?php
                                                            $condition = $item->item_details->condition_name;
                                                            $placement = $item->specifics_metas->where('name', 'Placement on Vehicle')->pluck('value')->implode(', ');
                                                            $color = $item->specifics_metas->where('name', 'Color')->pluck('value')->implode(', ');
                                                            $surface_finish = $item->specifics_metas->where('name', 'Surface Finish')->pluck('value')->implode(', ');
                                                            $warranty = $item->specifics_metas->where('name', 'Warranty')->pluck('value')->implode(', ');
                                                            $mpn = $item->specifics_metas->where('name', 'Manufacturer Part Number')->pluck('value')->implode(', ');
                                                            $ipn = $item->specifics_metas->where('name', 'Interchange Part Number')->pluck('value')->implode(', ');
                                                            ?>
                                                            @if($condition)
                                                            <tr>
                                                                <th>Condition</th>
                                                                <td>{{ $condition }}</td>
                                                            </tr>
                                                            @endif
                                                            @if($placement)
                                                            <tr>
                                                                <th>Placement On Vehicle</th>
                                                                <td>{{ $placement }}</td>
                                                            </tr>
                                                            @endif

                                                            @if($color)
                                                            <tr>
                                                                <th>Color</th>
                                                                <td>{{ $color }}</td>
                                                            </tr>
                                                            @endif

                                                            @if($surface_finish)
                                                            <tr>
                                                                <th>Surface Finish</th>
                                                                <td>{{ $surface_finish }}</td>
                                                            </tr>
                                                            @endif
                                                            @if($warranty)
                                                            <tr>
                                                                <th>Warranty</th>
                                                                <td>{{ $warranty }}</td>
                                                            </tr>
                                                            @endif
                                                            @if($mpn)
                                                            <tr>
                                                                <th>Manufacturer Part Number</th>
                                                                <td>{{ $mpn }}</td>
                                                            </tr>
                                                            @endif
                                                            @if($ipn)
                                                            <tr>
                                                                <th>Interchange Part Number</th>
                                                                <td>{{ $ipn }}<br></td>
                                                            </tr>
                                                            @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        &nbsp;
                                    </div>
                                </div>
                                <!-- listing description -->
                                <h4 id="x-main-tbar-desc" class="x-ttba x-fftb x-brdt x-bktt">
                                    <div class="x-tins x-ffac">Part's <span class="x-ital">Fitment</span></div>
                                </h4>
                                <div id="x-main-desc" class="x-tbox x-brdm x-bklt">
                                    <div class="x-tins">
                                        <h4>Compatible Vehicle(s):</h4>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class=" p-lg-30" style="background: #f5f5f5;">

                                                    <div style="overflow-x:auto;">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <th>Year</th>
                                                                <th>Make</th>
                                                                <th>Model</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $compatibilities = $listingDescService->getGroupedCompatibilityMetas($item->compatibility_metas); ?>
                                                            @foreach($compatibilities as $item)
                                                            <?php $data = $listingDescService->getCompatibilityDataForGroup($item); ?>
                                                            <tr>
                                                                <th scope="row">{{ $data['year'] }}</th>
                                                                <td>{{ $data['make'] }}</td>
                                                                <td>{{ $data['model'] }}</td>
                                                            </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- listing terms accordion -->
                                <div id="x-main-tabs">
                                    <div class="x-ttab"><input id="x-ttab-01" name="tab-group-1" checked=""
                                                               type="radio"><label for="x-ttab-01"
                                                                                   class="x-ttba x-fftb x-brdt x-bktt"><span
                                                class="x-tins x-ffac">Shipping <span
                                                    class="x-ital">Policy</span></span></label>
                                        <div class="x-ttrm">
                                            <div class="x-tbox x-brdm x-bklt">
                                                <div class="x-tins">
                                                    <!-- TERMS 1 TEXT GOES HERE --><p></p>
                                                    <ul style="list-style-type: circle; list-style-position: outside; margin-left: 1em;">
                                                        <li>Tracking number will be automatically e-mailed to all buyers
                                                            after package has been shipped out. If you didn't receive
                                                            any e-mail from us for the tracking number, please feel free
                                                            to Contact Us.
                                                        </li>
                                                        <li>We offer combined shipping discount, Please Contact Us.</li>
                                                        <li>Any PO box addresses, will be shipped by USPS.</li>
                                                        <li>If package is returned to us because buyer provided a wrong
                                                            or undeliverable address, buyer need to pay for reshipping
                                                            the package.
                                                        </li>
                                                        <li>International shipping will ONLY be processed throw eBay
                                                            Global Shipping Program.
                                                        </li>
                                                        <li>PLEASE CHECK THE PACKAGE BEFORE SIGNING FOR IT. FEDEX/USPS
                                                            WILL NOT ACCEPT ANY DAMAGE CLAIM IF THE RECEIVER HAVE SIGN
                                                            FOR THE PACKAGE. IF YOU RECEIVED A DAMAGE PACKAGE PLEASE DO
                                                            NOT SIGN FOR IT AND REFUSE THE PACKAGE, THEN CONTACT US
                                                            IMMEDIATELY SO THAT WE PROCESS YOUR REPLACEMENT IN A TIMELY
                                                            MANNER.
                                                        </li>
                                                    </ul>
                                                    <p></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="x-ttab"><input id="x-ttab-02" name="tab-group-1" type="radio"><label
                                            for="x-ttab-02" class="x-ttba x-fftb x-brdt x-bktt"><span
                                                class="x-tins x-ffac">Payment <span
                                                    class="x-ital">Method</span></span></label>
                                        <div class="x-ttrm">
                                            <div class="x-tbox x-brdm x-bklt">
                                                <div class="x-tins">
                                                    <ul style="list-style-type: circle; list-style-position: outside; margin-left: 1em;">
                                                        <li>PayPal</li>
                                                        <li>VISA</li>
                                                        <li>Master Card</li>
                                                        <li>American Express</li>
                                                        <li>Discover Network</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="x-ttab"><input id="x-ttab-03" name="tab-group-1" type="radio"><label
                                            for="x-ttab-03" class="x-ttba x-fftb x-brdt x-bktt"><span
                                                class="x-tins x-ffac">Return <span
                                                    class="x-ital">Policy</span></span></label>
                                        <div class="x-ttrm">
                                            <div class="x-tbox x-brdm x-bklt">
                                                <div class="x-tins">
                                                    <ul style="list-style-type: circle; list-style-position: outside; margin-left: 1em;">
                                                        <li>
                                                            <i class="fa fa-angle-right"></i>All of our product comes with
                                                            60 day money back return policy & 12 months Manufacture Defect
                                                            Warranty
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-angle-right"></i>Please keep the original
                                                            packaging, if anything is wrong with the product we only accept
                                                            returns with the original packaging.
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-angle-right"></i>No claims can be filed after 60
                                                            days of package delivery date.
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-angle-right"></i>If product is defected/
                                                            incorrect upon arrival, please Contact us immediately with a
                                                            digital photo of the product, we will assist you with the
                                                            returning procedure and send out a BRAND NEW product FREE of
                                                            charge in a timely manner.
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-angle-right"></i>If the package is lost in
                                                            transit, replacement or refund will only be issued after a lost
                                                            claim has been approved by shipping company.
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-angle-right"></i>If buyer purchased the wrong
                                                            product by error or no longer needs the product and wants to
                                                            return/exchange it, the buyer is responsible
                                                            returning/replacement shipping cost. Buyer is also subjected to
                                                            pay 20% restocking fees.
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="x-ttab"><input id="x-ttab-04" name="tab-group-1" type="radio"><label
                                            for="x-ttab-04" class="x-ttba x-fftb x-brdt x-bktt"><span
                                                class="x-tins x-ffac">Terms and <span
                                                    class="x-ital">Conditions</span></span></label>
                                        <div class="x-ttrm">
                                            <div class="x-tbox x-brdm x-bklt">
                                                <div class="x-tins">
                                                    <!-- TERMS 4 TEXT GOES HERE -->
                                                    <ul style="list-style-type: circle; list-style-position: outside; margin-left: 1em;">
                                                        <li>
                                                            To maintain low cost of products, we do not handle business
                                                            over the phone at this point of time. Please contact us
                                                            through ebay messaging and we will respond back to you
                                                            within 24 hours.
                                                        </li>
                                                        <li>
                                                            All the products that we sell are Brand New Aftermarket
                                                            Replacements.
                                                        </li>
                                                        <li>
                                                            We are not responsible, if the buyers provide wrong shipping
                                                            address. Buyers will be responsible for the return shipping
                                                            cost.
                                                        </li>
                                                        <li>
                                                            International Shipping : We use GLOBAL SHIPPING PROGRAMME
                                                            from ebay and ship to multiple countries. Please check the
                                                            product "SHIPS TO " details on the listing page.
                                                        </li>
                                                        <li>
                                                            Delivery times mentioned in the listings are estimates, we
                                                            try and ship as soon as possible but sometimes shipments and
                                                            orders can be delayed for certain reasons. In any such case
                                                            please contact us and we will assist you to the best of our
                                                            capability. it might take up to 24 hours for us to respond.
                                                        </li>
                                                        <li>
                                                            If you have any queries please reach to us through "contact
                                                            us" tab.
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="x-ttab"><input id="x-ttab-05" name="tab-group-1" type="radio"><label
                                            for="x-ttab-05" class="x-ttba x-fftb x-brdt x-bktt"><span
                                                class="x-tins x-ffac">Contact<span
                                                    class="x-ital">Us</span></span></label>
                                        <div class="x-ttrm">
                                            <div class="x-tbox x-brdm x-bklt">
                                                <div class="x-tins">
                                                    <img src="{{ $url }}images/call.png">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end right panel -->
                        </div><!-- end x content -->
                        <!-- beg footer -->
                        <div id="x-foot-wrap">
                            <div id="x-foot-main">
                                <div class="x-foot-tins">
                                    <!-- foot note -->
                                    <div id="x-foot-note">
                                        <img src="{{ $url }}images/APN-single.png">
                                    </div>
                                    <!-- foot menu -->
                                    <div id="x-foot-subm">
                                        <a target="_blank" href="http://stores.ebay.com/AutoParts-Nationwide">Home</a>
                                        <a target="_blank"
                                           href="http://stores.ebay.com/Autoparts-Nationwide_W0QQ_sasiZ1">View All
                                            Listings</a>
                                        <a target="_blank" href="http://stores.ebay.com/Autoparts-Nationwide/About-Us">About
                                            Us</a>
                                        <a target="_blank"
                                           href="http://stores.ebay.com/Autoparts-Nationwide/Shipping-Info">Shipping Info</a>
                                        <a target="_blank"
                                           href="http://stores.ebay.com/Autoparts-Nationwide/FAQ">FAQ</a>
                                        <a target="_blank"
                                           href="http://contact.ebay.com/ws/eBayISAPI.dll?ContactUserNextGen&recipient=autoparts-nationwide">Contact
                                            Us</a>
                                    </div>
                                    <!-- foot copyright -->
                                    <div id="x-foot-copy">Copyright © 2017 <a target="_blank" href="http://stores.ebay.com/AutoParts-Nationwide">Auto Parts Nationwide</a>.
                                        All rights reserved.
                                    </div>
                                    <div>
                                        Powered by <a target="_blank"href="https://www.mazegeek.com">MAZEGEEK</a>.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end footer -->
                    </div>
                </div><!-- end x bg --></div>
        </td>
    </tr>
</table><span id="closeHtml"></span>