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
                console.log('error on listing.js line 17');
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

        // Item specifics
        this.fillUpItemSpecifics(item);

        // compatibility
        Compatibility.renderCompatibility(item.compatibility_metas);
        CKEDITOR.instances.description_editor.insertHtml(item.item_details.description);

        // step 2
        $("#input_listing_duration").val(item.listing_duration);
        $("#input_price").val(item.buy_it_now_price);
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
        $("#input_shipping_package_type").val(item.item_details.shipping_package);
        $("#input_package_length").val(item.item_details.package_length);
        $("#input_package_width").val(item.item_details.package_width);
        $("#input_package_depth").val(item.item_details.package_depth);
        $("#input_weight_major").val(item.item_details.weight_major);
        $("#input_weight_minor").val(item.item_details.weight_minor);
        $("#input_location").val(item.item_details.location);
    },
    fillUpItemSpecifics: function(item){
        var specs = _.filter(item.specifics_metas, {scope: "ITEM_SPECIFICS"});
        var template = _.template('<% _.forEach(specs, function(spec){ %>\
                                        <div class="col-md-3">\
                                            <div class="form-group">\
                                                <label for=""><%- spec.name %></label>\
                                                <input type="text" class="form-control" value="<%- spec.name %>">\
                                            </div>\
                                        </div>\
                                    <% }); %>');
        var compiled = template({specs: specs});
        $("#item_specifics_container").html(compiled);
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