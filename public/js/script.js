$(document).ready(function(){

    Global.shipping_service_row_template = _.template(
        '<div class="domestic_shipping_row">\
            <div class="col-md-3">\
                <label for=""><a class="text-danger remove_btn">[remove]</a></label>\
                <select name="input_domestic_service" class="form-control">\
                    <option value="">-- Choose a service --</option>\
                    <optgroup label="Economy Services"></optgroup>\
                    <option value="US_DGMSmartMailGroundFromHK">DGM SmartMail Ground From HK</option>\
                    <option value="US_DGMSmartMailGroundFromCN">DGM SmartMail Ground From CN</option>\
                    <option value="US_DGMSmartMailGroundFromTW">DGM SmartMail Ground From TW</option>\
                    <option value="FedExSmartPost">FedEx SmartPost</option>\
                    <option value="US_UPSSurePostFromHK">UPS Surepost From HK</option>\
                    <option value="US_UPSSurePostFromCN">UPS Surepost From CN</option>\
                    <option value="US_UPSSurePostFromTW">UPS Surepost From TW</option>\
                    <option value="US_UPSSurePost">UPS Surepost</option>\
                    <option value="USPSMedia">USPS Media Mail</option>\
                    <option value="USPSParcel">USPS Parcel Select Ground</option>\
                    <option value="USPSStandardPost">USPS Retail Ground</option>\
                    <option value="US_DGMSmartMailGround">DGM SmartMail Ground</option>\
                    <option value="Other">Economy Shipping</option>\
                    <optgroup label="Standard Services"></optgroup>\
                    <option value="FedExHomeDelivery">FedEx Ground or FedEx Home Delivery</option>\
                    <option value="UPSGround">UPS Ground</option>\
                    <option value="USPSFirstClass">USPS First Class Package</option>\
                    <option value="US_DGMSmartMailExpeditedFromHK">DGM SmartMail Expedited From HK</option>\
                    <option value="US_DGMSmartMailExpeditedFromCN">DGM SmartMail Expedited From CN</option>\
                    <option value="US_DGMSmartMailExpeditedFromTW">DGM SmartMail Expedited From TW</option>\
                    <option value="US_DGMSmartMailExpedited">DGM SmartMail Expedited</option>\
                    <option value="ShippingMethodStandard">Standard Shipping</option>\
                    <optgroup label="Expedited Services"></optgroup>\
                    <option value="FedEx2Day">FedEx 2Day</option>\
                    <option value="FedExExpressSaver">FedEx Express Saver</option>\
                    <option value="FedExPriorityOvernight">FedEx Priority Overnight</option>\
                    <option value="FedExStandardOvernight">FedEx Standard Overnight</option>\
                    <option value="UPS2ndDay">UPS 2nd Day Air</option>\
                    <option value="UPS3rdDay">UPS 3 Day Select</option>\
                    <option value="UPSNextDayAir">UPS Next Day Air</option>\
                    <option value="UPSNextDay">UPS Next Day Air Saver</option>\
                    <option value="USPSPriority">USPS Priority Mail</option>\
                    <option value="USPSExpressMail">USPS Priority Mail Express</option>\
                    <option value="USPSExpressFlatRateEnvelope">USPS Priority Mail Express Flat Rate Envelope</option>\
                    <option value="USPSExpressMailLegalFlatRateEnvelope">USPS Priority Mail Express Legal Flat Rate Envelope</option>\
                    <option value="USPSPriorityFlatRateEnvelope">USPS Priority Mail Flat Rate Envelope</option>\
                    <option value="USPSPriorityMailLargeFlatRateBox">USPS Priority Mail Large Flat Rate Box</option>\
                    <option value="USPSPriorityMailLegalFlatRateEnvelope">USPS Priority Mail Legal Flat Rate Envelope</option>\
                    <option value="USPSPriorityFlatRateBox">USPS Priority Mail Medium Flat Rate Box</option>\
                    <option value="USPSPriorityMailPaddedFlatRateEnvelope">USPS Priority Mail Padded Flat Rate Envelope</option>\
                    <option value="USPSPriorityMailSmallFlatRateBox">USPS Priority Mail Small Flat Rate Box</option>\
                    <option value="ShippingMethodExpress">Expedited Shipping</option>\
                    <option value="ShippingMethodOvernight">One-day Shipping</option>\
                    <optgroup label="Other Services"></optgroup>\
                    <option value="US_FedExIntlEconomy">FedEx International Economy</option>\
                    <option value="US_UPSWorldwideExpeditedFromHK">UPS WorldWide Expedited From HK</option>\
                    <option value="US_UPSWorldwideExpeditedFromCN">UPS WorldWide Expedited From CN</option>\
                    <option value="US_UPSWorldwideExpeditedFromTW">UPS WorldWide Expedited From TW</option>\
                    <option value="US_UPSWorldwideExpressSaverFromHK">UPS Worldwide Express Saver From HK</option>\
                    <option value="US_UPSWorldwideExpressSaverFromCN">UPS Worldwide Express Saver From CN</option>\
                    <option value="US_UPSWorldwideExpressSaverFromTW">UPS Worldwide Express Saver From TW</option>\
                    <option value="US_DHLGlobalMailParcelDirectFromHK">DHL Global Mail Parcel Direct From HK</option>\
                    <option value="US_DHLGlobalMailParcelDirectFromCN">DHL Global Mail Parcel Direct From CN</option>\
                    <option value="US_DHLGlobalMailParcelDirectFromTW">DHL Global Mail Parcel Direct From TW</option>\
                    <option value="US_EconomyShippingFromGC">Economy Shipping from China/Hong Kong/Taiwan to worldwide</option>\
                    <option value="EconomyShippingFromOutsideUS">Economy Shipping from outside US</option>\
                    <option value="ePacketChina">ePacket delivery from China</option>\
                    <option value="ePacketHongKong">ePacket delivery from Hong Kong</option>\
                    <option value="US_ExpeditedShippingFromGC">Expedited Shipping from China/Hong Kong/Taiwan to worldwide</option>\
                    <option value="ExpeditedShippingFromOutsideUS">Expedited Shipping from outside US</option>\
                    <option value="FlatRateFreight">Flat Rate Freight</option>\
                    <option value="US_StandardShippingFromGC">Standard Shipping from China/Hong Kong/Taiwan to worldwide</option>\
                    <option value="StandardShippingFromOutsideUS">Standard Shipping from outside US</option>\
                    <optgroup label="Local Pickup"></optgroup>\
                    <option value="Pickup">Local Pickup</option>\
                </select>\
            </div>\
            <div class="col-md-3">\
                <div class="form-group">\
                    <label>Cost</label>\
                    <label class="inline custom-control custom-checkbox block">\
                        <input type="checkbox" class="custom-control-input free_shipping_checkbox">\
                        <span class="custom-control-indicator"></span>\
                        <span class="custom-control-description ml-0"> <a href="#" onclick="return false;"> Free shipping</a></span>\
                    </label>\
                    <input type="text" class="form-control cost" placeholder="Enter Cost in USD">\
                </div>\
            </div>\
            <div class="col-md-3">\
                <div class="form-group">\
                    <label>Each Additional</label>\
                    <input type="text" class="form-control additional_cost" placeholder="Enter Additional Cost in USD">\
                </div>\
            </div>\
            <div class="col-md-3">\
                <div class="form-group">\
                    <label>AK/HI/PR Surcharge</label>\
                    <input type="text" class="form-control surcharge" placeholder="Enter Surcharge in USD">\
                </div>\
            </div>\
        </div>'
    );



    var lfm = function(options, cb) {

        var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';

        window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
        window.SetUrl = cb;
    };

    $("#upload_image_btn").click(function(){
        lfm({type: 'image', prefix: ''}, function(url, path) {
            var single_image_template = _.
            template('<li>\
                            <img src="<%- src %>" alt="">\
                            <a href="#" class="remove_img_btn">X</a>\
                        </li>');
            var html = single_image_template({src: url});
            $("#image_container ul li:last-child").before(html);
        });
    });

    $("#image_container").on('click', '.remove_img_btn', function(e){
        e.preventDefault();
        $(this).closest('li').remove();
    });


    $("#add_item_specifics_row").click(function(){
        $("#new_item_specifics_modal").modal('show');
    });

    $("#new_item_specifics_modal .save_btn").click(function(){
        var label = $("#input_new_item_specific_label").val();
        var template = _.template('<div class="col-md-3">\
                                        <div class="form-group">\
                                            <label for=""><%- label %></label>\
                                            <input type="text" class="form-control" value="">\
                                        </div>\
                                    </div>');
        var html = template({label: label});
        $("#item_specifics_container").append(html);
        $("#new_item_specifics_modal").modal('hide');
    });

    $("#edit_rate_table_btn").click(function(e){
        e.preventDefault();
        var template = Global.shipping_service_row_template;
        var html = template();
        $("#domestic_shipping_container").append(html);
    });

    $("#domestic_shipping_container").on('change', '.free_shipping_checkbox', function(){
        var checked = $(this).prop('checked');
        if(checked){
            $(this).closest('.domestic_shipping_row').find('input').val('0');
        }
    });

    $("#domestic_shipping_container").on('click', '.remove_btn', function(e){
        e.preventDefault();
        $(this).closest('.domestic_shipping_row').remove();
    });

});