var Item = {
    item: null,
    init: function(){

    },
    listen: function(){

    },
    fetchByItemID: function(id, callback){
        $.ajax({
            method: 'GET',
            url: Global.item_get_url,
            success: function(res){
                this.item = res;
                if(callback) callback(this.item);
            },
            error: function(){
                console.log('error on revise-listing.js line 18');
            }
        });
    }
};

var Listing = {
    init: function(){
        Item.fetchByItemID(Global.item_id, _.bind(this.fillUpWizard, this));
        this.listen();
        Compatibility.init();
    },
    listen: function(){
        var _this = this;
        $("body").on('listing:wizard:finished', function(){
            _this.onWizardSubmit();
        });
    },
    onWizardSubmit: function(){
        var item = {
            title: $("#input_title").val(),
            primary_category_id: $("#input_category").val(),
            sku: $("#input_sku").val(),
            store_category_id: $("#input_store_category_id").val(),
            upc: $("#input_upc").val(),
            store_category2_id: $("#input_store_category2_id").val(),
            description: CKEDITOR.instances.description_editor.getData(),
            duration: $("#input_listing_duration").val(),
            condition_id: $("#input_condition_id").val(),
            price: $("#input_price").val(),
            quantity: $("#input_quantity").val(),
            paypal_email: $("#input_paypal_email").val(),
            return_option: $("input[name='is_return_accepted']:checked").val(),
            returns_within: $("#input_returns_within").val(),
            refund_option: $("#input_refund_given_as").val(),
            return_shipping_paid_by: $("#input_return_shipping_paid_by").val(),
            return_policy_desc: $("#return_policy_description").val(),
            restocking_fee: $("#input_restocking_fee").val(),
            shipping_package_type: $("#input_shipping_package_type").val(),
            package_length: $("#input_package_length").val(),
            package_width: $("#input_package_width").val(),
            package_depth: $("#input_package_depth").val(),
            weight_major: $("#input_weight_major").val(),
            weight_minor: $("#input_weight_minor").val(),
            country: $("#input_country").val(),
            location: $("#input_location").val(),
            max_dispatch_time: $("#input_dispatch_time_max").val(),
        };
        var item_specifics = [];
        $("#item_specifics_container .form-group").each(function(){
            item_specifics.push({
                name: $(this).find('label').text(),
                value: $(this).find('input').val()
            });
        });
        item.specifics = item_specifics;
        var compatibilities = [];
        $("#compatibility_list_container table tbody tr").each(function(){
            compatibilities.push({
                make: $(this).find('td:nth-child(1)').text(),
                model: $(this).find('td:nth-child(2)').text(),
                year: $(this).find('td:nth-child(3)').text(),
                trim: $(this).find('td:nth-child(4)').text(),
                engine: $(this).find('td:nth-child(5)').text(),
            });
        });
        item.compatibilities = compatibilities;

        var shipping_services = [];
        $(".domestic_shipping_row").each(function(){
            var service = $(this).find('select').val();
            var cost = $(this).find('input.cost').val();
            var additional_cost = $(this).find('input.additional_cost').val();
            var surcharge = $(this).find('input.surcharge').val();
            var isFree = $(this).find('input.free_shipping_checkbox').prop('checked');
            shipping_services.push({
                shipping_service: service,
                cost: cost,
                additional_cost: additional_cost,
                surcharge: surcharge,
                is_free: isFree
            });
        });
        item.domestic_shipping_services = shipping_services;
        var images = [];
        $("#image_container img").each(function(){
            images.push($(this).attr('src'));
        });
        item.images = images;
        $("body").trigger('pre_loader:show');
        $.ajax({
            method: 'POST',
            url: Global.post_revise_item_url,
            data: item,
            success: function(res){
                $("body").trigger('pre_loader:hide');
                if(res.status == 'success'){
                    $("body").trigger('pre_loader:notification:show', ['success', res.msg]);
                }else{
                    $("body").trigger('pre_loader:notification:show', ['danger', res.msg]);
                }
            },
            error: function(){
                $("body").trigger('pre_loader:notification:show', ['danger', 'Sorry, there is a error']);
                $("body").trigger('pre_loader:show');
            }
        });

    },
    fillUpWizard: function(item){
        console.log(item);
        // step 1
        $("#input_title").val(item.title);
        $("#input_category").val(item.item_details.primary_category_id);
        $("#input_sku").val(item.sku);
        $("#input_store_category_id").val(item.item_details.store_category_id);
        //$("#input_second_category").val(item.item_details.);
        $("#input_store_category2_id").val(item.item_details.store_category2_id);
        $("#input_upc").val(item.item_details.upc);

        this.fillUpImages(item);

        // Item specifics
        this.fillUpItemSpecifics(item);

        // compatibility
        Compatibility.renderCompatibility(item.compatibility_metas);
        CKEDITOR.instances.description_editor.insertHtml(item.item_details.description);

        // step 2
        $("#input_listing_duration").val(item.listing_duration);
        $("#input_condition_id").val(item.item_details.condition_id);
        $("#input_price").val(item.current_price);
        $("#input_quantity").val(item.quantity);
        $("#input_paypal_email").val(item.item_details.paypal_email);
        $("#input_checkout_instruction").val(item.item_details.paypal_email);
        $("input[name='is_return_accepted'][value='yes']").prop('checked', item.item_details.returns_accepted_option == 'ReturnsAccepted');
        $("#input_returns_within").val(item.item_details.returns_within_option);
        $("#input_refund_given_as").val(item.item_details.refund_option);
        $("#input_return_shipping_paid_by").val(item.item_details.return_shipping_cost_paid_by);
        $("#return_policy_description").val(item.item_details.return_policy_description);
        $("#input_restocking_fee").val(item.item_details.return_restocking_fee);
        $("input[name='is_return_accepted'][value='no']").prop('checked', item.item_details.returns_accepted_option == 'ReturnsNotAccepted');

        // step 3
        this.fillUpDomesticShippingServices(item);
        $("#input_dispatch_time_max").val(item.item_details.dispatch_time_max);
        $("#input_shipping_package_type").val(item.item_details.shipping_package);
        $("#input_package_length").val(item.item_details.package_length);
        $("#input_package_width").val(item.item_details.package_width);
        $("#input_package_depth").val(item.item_details.package_depth);
        $("#input_weight_major").val(item.item_details.weight_major);
        $("#input_weight_minor").val(item.item_details.weight_minor);
        $("#input_country").val(item.item_details.country);
        $("#input_location").val(item.item_details.location);
    },
    fillUpItemSpecifics: function(item){
        var specs = _.filter(item.specifics_metas, {scope: "ITEM_SPECIFICS"});
        var template = _.template('<% _.forEach(specs, function(spec){ %>\
                                        <div class="col-md-3">\
                                            <div class="form-group">\
                                                <label for=""><%- spec.name %></label>\
                                                <input type="text" class="form-control" value="<%- spec.value %>">\
                                            </div>\
                                        </div>\
                                    <% }); %>');
        var compiled = template({specs: specs});
        $("#item_specifics_container").html(compiled);
    },
    fillUpImages: function(item){
        var images = item.images;
        var single_image_template = _.
        template('<li>\
                    <img src="<%- src %>" alt="">\
                    <a href="#" class="remove_img_btn">X</a>\
                </li>');
        for(var i in images){
            var html = single_image_template({src: images[i].url});
            $("#image_container ul li:last-child").before(html);
        }
    },
    fillUpDomesticShippingServices: function(item){
        var services = item.shipping_service_options;
        for(var i in services){
            var html = Global.shipping_service_row_template();
            $("#domestic_shipping_container").append(html);
            $("#domestic_shipping_container .domestic_shipping_row:not(:first-child)").find('.free_shipping_checkbox').closest('label').remove();
            var row = $("#domestic_shipping_container .domestic_shipping_row:last-child");
            row.find('select').val(services[i].shipping_service);
            row.find('input.cost').val(services[i].shipping_service_cost);
            row.find('input.additional_cost').val(services[i].shipping_service_additional_cost);
            row.find('input.surcharge').val(services[i].surcharge);
            row.find('input.free_shipping_checkbox').prop('checked', services[i].free_shipping);
        }
    }
};

var Compatibility = {
    compatibilityRowTemplate: null,
    $compatibilityRowTbody: null,
    init: function(){
        this.$compatibilityRowTbody = $("#compatibility_list_container table tbody");
        this.initTemplate();
    },
    initTemplate: function(){
        this.compatibilityRowTemplate = _.template('<tr>\
            <td class="text-truncate"><%- Make %></td>\
            <td class="text-truncate"><%- Model %></td>\
            <td class="text-truncate"><%- Year %></td>\
            <td class="text-truncate"><%- Trim %></td>\
            <td class="text-truncate"><%- Engine %></td>\
            </tr>');
    },
    renderCompatibility: function(compatibilities){
        this.$compatibilityRowTbody.html('');
        _.each(compatibilities, _.bind(this.addRow, this));
    },
    addRow: function(compatibility){
        var data = JSON.parse(compatibility.value);
        var row = this.compatibilityRowTemplate(data);
        this.$compatibilityRowTbody.append(row);
    }
};

$(document).ready(function(){
    Listing.init();
});