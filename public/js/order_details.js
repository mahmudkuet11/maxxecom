// Invoice

$(document).ready(function(){

    Invoice.init();

    $("#transaction_details_table input[name='price_comparison_section']").each(function(){
        $.ajax({
            url: Global.store.price.url,
            method: 'GET',
            data: {
                sku: $(this).val()
            },
            success: function(res){
                Global.store.price.data = res;
            },
            error: function(){
                alert('Can not fetch store price');
            }
        });
    });

    var $el = {
        price_comparison_section: $("#price_comparison_section"),
        price_comparison_radio_btn: $("input[name='price_comparison_section']"),
        store_list_item: $("#store_list_ul .list-group-item")
    };

    $el.price_comparison_section.hide();

    $el.price_comparison_radio_btn.change(function(){
        var sku = $(this).val();
        var transaction_id = $(this).closest('tr').attr('data-transaction-id');
        $el.price_comparison_section.show();
        Invoice.reset();
        Invoice.initInvoice(transaction_id, sku);
    });


    $el.store_list_item.click(function(){
        $el.store_list_item.removeClass('active');
        $(this).addClass('active');
        Invoice.updateInvoice();

    });

    $("#invoice_container input").keyup(function(){
        Invoice.updateInputFieldOnKeyUp();
    });


});

var Invoice = {
    store: {
        keystone_qi: {
            next_state: 'awaiting_tracking'
        },
        keystone_local: {
            next_state: 'print_label'
        },
        wr: {
            next_state: 'print_label'
        },
        pf: {
            next_state: 'awaiting_tracking'
        },
        bs: {
            next_state: 'awaiting_tracking'
        },
        cap: {
            next_state: 'print_label'
        },
        apw: {
            next_state: 'awaiting_tracking'
        },
        ra: {
            next_state: 'awaiting_tracking'
        },
        pg: {
            next_state: 'awaiting_tracking'
        },
        amazon: {
            next_state: 'awaiting_tracking'
        },
        ebay: {
            next_state: 'awaiting_tracking'
        },
        atd: {
            next_state: 'print_label'
        },
        future: {
            next_state: 'print_label'
        }
    },
    init: function(){
        this.listen();
    },
    listen: function(){
        var _this = this;
        $("#save_invoice_btn").click(function (e) {
            e.preventDefault();
            _this.save();
        });
    },
    updateInvoice: function(){
        var transaction_id = $("#transaction_details_table input[name='price_comparison_section']").closest('tr').attr('data-transaction-id');
        var sku = $("#transaction_details_table input[name='price_comparison_section']").val();

        var invoices = Global.order.invoices;
        var hasInvoice = false;
        for (var i=0; i<invoices.length; i++){
            if(invoices[i].transaction_id == transaction_id && invoices[i].sku == sku){
                hasInvoice = true;
                $("input#sold_price_input").val(invoices[i].sold_price);
                $("input#product_cost_input").val(invoices[i].product_cost);
                $("input#shipping_cost_input").val(invoices[i].shipping_cost);
                $("input#handling_cost_input").val(invoices[i].handling_cost);
                $("input#fees_input").val(invoices[i].fees);
                $("input#profit_input").val(invoices[i].profit);
            }
        }
        hasInvoice = false;

        if(!hasInvoice){
            var $selectedStore = $("#store_list_ul .list-group-item.active");
            var store = $selectedStore.attr('data-store');
            var price = Global.store.price.data[store];
            var sold_price = $("input[name='price_comparison_section']:checked").closest('tr').attr('data-price');
            var product_cost = 0;
            var shipping_cost = 0;
            var handling_cost = 0;
            var fees = 0;
            if(price){
                product_cost = price.price;
                shipping_cost = price.shipping_cost;
                handling_cost = price.handling_cost;

            }
            var profit = sold_price - (product_cost + shipping_cost + handling_cost);

            $("input#sold_price_input").val(sold_price);
            $("input#product_cost_input").val(product_cost);
            $("input#shipping_cost_input").val(shipping_cost);
            $("input#handling_cost_input").val(handling_cost);
            $("input#fees_input").val(fees);
            $("input#profit_input").val(profit);
        }
    },
    updateInputFieldOnKeyUp: function(){
        var amount = {
            sold_price: $("#sold_price_input").val(),
            product_cost: $("#product_cost_input").val(),
            shipping_cost: $("#shipping_cost_input").val(),
            handling_cost: $("#handling_cost_input").val(),
            fees: $("#fees_input").val(),
            profit: 0
        };
        amount.sold_price = amount.sold_price ? parseInt(amount.sold_price) : 0;
        amount.product_cost = amount.product_cost ? parseInt(amount.product_cost) : 0;
        amount.shipping_cost = amount.shipping_cost ? parseInt(amount.shipping_cost) : 0;
        amount.handling_cost = amount.handling_cost ? parseInt(amount.handling_cost) : 0;
        amount.fees = amount.fees ? parseInt(amount.fees) : 0;
        amount.profit = amount.sold_price - (amount.product_cost + amount.shipping_cost + amount.handling_cost + amount.fees);
        $("input#profit_input").val(amount.profit);
    },
    save: function(){
        var store_name = $("#store_list_ul .list-group-item.active").attr('data-store');
        var store_type = 'regular';
        var next_state = "";
        if(store_name){
            next_state = this.store[store_name].next_state;
        }else{
            store_name = $("#custom_store_input").val();
            store_type = 'custom';
            next_state = $("#custom_store_next_state_select").val();
        }
        var invoice= {
            order_id: Global.order.id,
            transaction_id: $("#transaction_details_table input[name='price_comparison_section']:checked").closest('tr').attr('data-transaction-id'),
            sku: $("#transaction_details_table input[name='price_comparison_section']:checked").val(),
            store_type: store_type,
            store_name: store_name,
            next_state: next_state,
            sold_price: $("#sold_price_input").val(),
            product_cost: $("#product_cost_input").val(),
            shipping_cost: $("#shipping_cost_input").val(),
            handling_cost: $("#handling_cost_input").val(),
            fees: $("#fees_input").val(),
            profit: $("#profit_input").val(),
        };
        $("#save_invoice_btn").prop('disabled', true);
        $.ajax({
            method: 'POST',
            url: Global.invoice.url_save,
            data: invoice,
            success: function(res){
                $("#save_invoice_btn").prop('disabled', false);
                if(res.status == 'success'){
                    window.location.reload(true);
                }else{
                    alert(res.msg);
                }
            },
            error: function(){
                $("#save_invoice_btn").prop('disabled', false);
                if(res.status != 'success'){
                    $("#save_invoice_btn").prop('disabled', false);
                }
                alert("Invoice could not be saved");
            }
        });
    },
    initInvoice: function(transaction_id, sku){
        var invoices = Global.order.invoices;
        for (var i=0; i<invoices.length; i++){
            if(invoices[i].transaction_id == transaction_id && invoices[i].sku == sku){
                $("#store_list_ul .list-group-item.active").removeClass('active');
                if(invoices[i].store_type == 'regular'){
                    $("#store_list_ul .list-group-item[data-store='"+ invoices[i].store_name +"']").addClass('active');
                }
                if(invoices[i].store_type == 'custom'){
                    $("#custom_store_next_state_select").closest('.list-group-item').addClass('active');
                    $("#custom_store_input").val(invoices[i].store_name);
                    $("#custom_store_next_state_select").val(invoices[i].next_state);
                }
                $("input#sold_price_input").val(invoices[i].sold_price);
                $("input#product_cost_input").val(invoices[i].product_cost);
                $("input#shipping_cost_input").val(invoices[i].shipping_cost);
                $("input#handling_cost_input").val(invoices[i].handling_cost);
                $("input#fees_input").val(invoices[i].fees);
                $("input#profit_input").val(invoices[i].profit);

            }
        }
    },
    reset: function(){
        $("#store_list_ul .list-group-item.active").removeClass('active');
        $("#custom_store_input").val('');
        $("#custom_store_next_state_select").val('');
        $("#invoice_container input").val('');
    }
};



// Tracking Number
var TrackingNumber = {
    $selectedRow: null,
    $modal: null,
    $trackingList: null,
    url: Global.order.url,
    init: function(){
        this.$modal = $('#tracking_number_modal');
        this.$trackingList = $('#tracking_list');
        this.listen();
    },
    listen: function(){
        var _this = this;
        $(".add_tracking_no_btn").click(function(){
            _this.$selectedRow = $(this).closest("tr");
            _this.showModal();
        });
        this.$modal.on('shown.bs.modal', function(){
            _this.showTransactionInfo();
            _this.showTrackingNumbers();
        });
        $("#add_tracking_row_btn").click(function(){
            _this.appendNewRow();
        });
        $("#tracking_number_save_btn").click(function(){
            _this.saveTrackingNumbers();
        });
    },
    showModal: function(){
        this.$modal.modal('show');
    },
    hideModal: function(){
        this.$modal.modal('hide');
    },
    showTrackingNumbers: function(){
        var trackings = JSON.parse(this.$selectedRow.attr('data-tracking-details'));
        if(trackings.length == 0){
            this.addNewRow();
        }else{
            var template = Handlebars.compile($("#tracking_list_template").html());
            var html = template({trackings: trackings});
            this.$trackingList.html(html);
        }
    },
    showTransactionInfo: function(){
        var info = {
            order_line_item_id: this.$selectedRow.attr('data-order-line-item-id'),
            buyer_id: this.$selectedRow.attr('data-buyer-id'),
            buyer_name: this.$selectedRow.attr('data-buyer-name'),
            item_title: this.$selectedRow.attr('data-item-title'),
            item_id: this.$selectedRow.attr('data-item-id'),
        };
        this.$modal.find('#buyer_id').text(info.buyer_id);
        this.$modal.find('#buyer_name').text(info.buyer_name);
        this.$modal.find('#item_title').text(info.item_title);
        this.$modal.find('#item_id').text(info.item_id);
    },
    appendNewRow: function(){
        var template = Handlebars.compile($("#empty_tracking_row_template").html());
        var html = template();
        this.$trackingList.append(html);
    },
    addNewRow: function(){
        var template = Handlebars.compile($("#empty_tracking_row_template").html());
        var html = template();
        this.$trackingList.html(html);
    },
    saveTrackingNumbers: function(){
        var _this = this;
        var trackings = [];
        this.$trackingList.find('.tracking_row').each(function(index){
            var tracking = {
                tracking_no: $(this).find('.tracking_no_input').val(),
                carrier_used: $(this).find('.carrier_used_input').val()
            };
            if(tracking.tracking_no != '' && tracking.carrier_used != ''){
                trackings.push(tracking);
            }
        });
        $.ajax({
            method: 'POST',
            url: this.url,
            data: {
                order_id: $("#transaction_details_table").attr('data-order-id'),
                order_line_item_id: this.$selectedRow.attr('data-order-line-item-id'),
                trackings: trackings
            },
            success: function(resp){
                if(resp.status == true){
                    _this.$selectedRow.attr('data-tracking-details', JSON.stringify(trackings));
                    _this.hideModal();
                }else{
                    alert(resp.msg);
                }
            },
            error: function(){
                alert('Sorry, Tracking number could not be added. Please refresh the page and try again!');
            }
        });
    }
};