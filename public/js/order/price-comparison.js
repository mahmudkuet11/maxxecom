$(document).ready(function(){
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
        $el.price_comparison_section.show();
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
    updateInvoice: function(){
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

    }
};