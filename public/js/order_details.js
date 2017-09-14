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
        var sku_id = $(this).attr('data-sku-id');
        var invoice = Invoice.getBySkuID(sku_id);
        $el.price_comparison_section.show();
        Invoice.reset();
        Invoice.initInvoice(invoice);
    });


    $el.store_list_item.click(function(){
        $el.store_list_item.removeClass('active');
        $(this).addClass('active');
        Invoice.updateInvoice();

    });

    $("#invoice_container input").keyup(function(){
        Invoice.updateInputFieldOnKeyUp();
    });

    $("#submit_order_btn").click(function(e){
        e.preventDefault();
        Invoice.submitOrder();
    });


});

var Sku = {
    getBySkuID: function(sku_id){
        var transactions = Global.order.data.transactions;
        for(var i in transactions){
            var skus = transactions[i].skus;
            for(var j in skus){
                if(skus[j].id == sku_id) return skus[j];
            }
        }
        return null;
    },
    resetTrackingNumbers: function(sku_id, tracking_numbers){
        var transactions = Global.order.data.transactions;
        for(var i in transactions){
            var skus = transactions[i].skus;
            for(var j in skus){
                if(skus[j].id == sku_id){
                    skus[j].tracking_numbers = tracking_numbers;
                    transactions[i].skus = skus;
                    return;
                }
            }
        }
    }
};

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
        $("#show_order_id_modal_btn").click(function (e) {
            e.preventDefault();
            _this.showOrderIDModal();
        });
    },
    updateInvoice: function(){
        var sku_id = $("#transaction_details_table input[name='price_comparison_section']:checked").attr('data-sku-id');
        var invoice = this.getBySkuID(sku_id);
        var $selectedStore = $("#store_list_ul .list-group-item.active");
        if(invoice){
            if(invoice.store_name == $selectedStore.attr('data-store')){
                $("input#sold_price_input").val(invoice.sold_price);
                $("input#product_cost_input").val(invoice.product_cost);
                $("input#shipping_cost_input").val(invoice.shipping_cost);
                $("input#handling_cost_input").val(invoice.handling_cost);
                $("input#fees_input").val(invoice.fees);
                $("input#profit_input").val(invoice.profit);
            }else{
                this.setStorePriceToInvoice();
            }
        }else{
            this.setStorePriceToInvoice();
        }
    },
    setStorePriceToInvoice: function(){
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
        var invoice = this.getInvoice();
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
    showOrderIDModal: function(){
        $("#order_id_modal").modal('show');
        var invoice = this.getInvoice();
        var oldInvoice = this.getBySkuID(invoice.sku_id);
        if(this.isInvoiceChanged(oldInvoice, invoice)){
            $("#invoice_message_form_group").show();
        }else{
            $("#invoice_message_form_group").hide();
        }
    },
    submitOrder: function(){
        //validation
        var order_id = $("#order_id_modal input[name='order_id']").val();
        var message = $("#order_id_modal input[name='message']").val();
        if(order_id == ''){
            alert('Order ID is required');
            return;
        }
        var invoice = this.getInvoice();
        var oldInvoice = this.getBySkuID(invoice.sku_id);
        if(this.isInvoiceChanged(oldInvoice, invoice)){
            if(message == ''){
                alert('Message is required');
                return;
            }
        }
        //validation end

        $("#submit_order_btn").prop('disabled', true);
        invoice.order_id = order_id;
        invoice.msg = message ? message : '';
        $.ajax({
            method: 'POST',
            url: Global.invoice.order_submit,
            data: invoice,
            success: function(res){
                $("#submit_order_btn").prop('disabled', false);
                if(res.status == 'success'){
                    window.location.reload(true);
                }else{
                    alert(res.msg);
                }
            },
            error: function(){
                $("#submit_order_btn").prop('disabled', false);
                if(res.status != 'success'){
                    $("#submit_order_btn").prop('disabled', false);
                }
                alert("Invoice could not be saved");
            }
        });

    },
    getInvoice: function(){
        var selected_sku_id = $("#transaction_details_table input[name='price_comparison_section']:checked").attr('data-sku-id');
        var skuModel = Sku.getBySkuID(selected_sku_id);

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
            sku_id: selected_sku_id,
            store_type: store_type,
            store_name: store_name,
            next_state: next_state,
            sold_price: $("#sold_price_input").val(),
            product_cost: $("#product_cost_input").val(),
            shipping_cost: $("#shipping_cost_input").val(),
            handling_cost: $("#handling_cost_input").val(),
            fees: $("#fees_input").val(),
            profit: $("#profit_input").val()
        };
        return invoice;
    },
    getBySkuID: function(sku_id){
        var transactions = Global.order.data.transactions;
        for(var i in transactions){
            var skus = transactions[i].skus;
            for(var j in skus){
                if(skus[j].invoice){
                    if(skus[j].invoice.sku_id == sku_id){
                        return skus[j].invoice;
                    }
                }
            }
        }
        return null;
    },
    isInvoiceChanged: function(oldInvoice, newInvoice){
        return !(oldInvoice.sku_id == newInvoice.sku_id &&
        oldInvoice.store_type == newInvoice.store_type &&
        oldInvoice.store_name == newInvoice.store_name &&
        oldInvoice.next_state == newInvoice.next_state &&
        oldInvoice.sold_price == newInvoice.sold_price &&
        oldInvoice.product_cost == newInvoice.product_cost &&
        oldInvoice.shipping_cost == newInvoice.shipping_cost &&
        oldInvoice.handling_cost == newInvoice.handling_cost &&
        oldInvoice.fees == newInvoice.fees &&
        oldInvoice.profit == newInvoice.profit);
    },
    initInvoice: function(invoice){
        if(! invoice){
            $("#show_order_id_modal_btn").hide();
            return;
        }
        var status = Sku.getBySkuID(invoice.sku_id).status;
        if(status != 'AWAITING_SHIPMENT'){
            $("#save_invoice_btn").hide();
        }
        if(status != 'AWAITING_ORDER'){
            $("#show_order_id_modal_btn").hide();
        }


        $("#store_list_ul .list-group-item.active").removeClass('active');
        if(invoice.store_type == 'regular'){
            $("#store_list_ul .list-group-item[data-store='"+ invoice.store_name +"']").addClass('active');
        }
        if(invoice.store_type == 'custom'){
            $("#custom_store_next_state_select").closest('.list-group-item').addClass('active');
            $("#custom_store_input").val(invoice.store_name);
            $("#custom_store_next_state_select").val(invoice.next_state);
        }
        $("input#sold_price_input").val(invoice.sold_price);
        $("input#product_cost_input").val(invoice.product_cost);
        $("input#shipping_cost_input").val(invoice.shipping_cost);
        $("input#handling_cost_input").val(invoice.handling_cost);
        $("input#fees_input").val(invoice.fees);
        $("input#profit_input").val(invoice.profit);
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
    active_sku_id: null,
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
            _this.active_sku_id = $(this).closest("tr").attr('data-sku-id');
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
    getTrackingNumbers: function(){
        var tracking_numbers = [];
        var transaction_tracking_numbers = Transaction.getBySkuID(this.active_sku_id).tracking_numbers;
        var sku_tracking_numbers = Sku.getBySkuID(this.active_sku_id).tracking_numbers;
        for(var i in transaction_tracking_numbers){
            tracking_numbers.push(transaction_tracking_numbers[i]);
        }
        for(var i in sku_tracking_numbers){
            tracking_numbers.push(sku_tracking_numbers[i]);
        }
        return tracking_numbers;
    },
    showTrackingNumbers: function(){
        var tracking_numbers = this.getTrackingNumbers();
        if(tracking_numbers.length == 0){
            this.addNewRow();
        }else{
            var template = Handlebars.compile($("#tracking_list_template").html());
            var html = template({tracking_numbers: tracking_numbers});
            this.$trackingList.html(html);
        }
    },
    showTransactionInfo: function(){
        var transaction = Transaction.getBySkuID(this.active_sku_id);
        this.$modal.find('#buyer_id').text(Global.order.data.buyer_id);
        this.$modal.find('#buyer_name').text(transaction.buyer_user_first_name + ' ' + transaction.buyer_user_last_name);
        this.$modal.find('#item_title').text(transaction.item_title);
        this.$modal.find('#item_id').text(transaction.item_id);
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
        this.$trackingList.find('.tracking_row').each(function(){
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
                sku_id: this.active_sku_id,
                trackings: trackings
            },
            success: function(resp){
                if(resp.status == true){
                    Sku.resetTrackingNumbers(_this.active_sku_id, resp.tracking_numbers);
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


var Transaction = {
    getBySkuID: function(sku_id){
        var transactions = Global.order.data.transactions;
        for(var i in transactions){
            var skus = transactions[i].skus;
            for(var j in skus){
                if(skus[j].id == sku_id) return transactions[i];
            }
        }
        return null;
    }
};