

$(document).ready(function(){
    var $el = {
        price_comparison_section: $("#price_comparison_section"),
        price_comparison_radio_btn: $("input[name='price_comparison_section']")
    };

    $el.price_comparison_section.hide();

    $el.price_comparison_radio_btn.change(function(){
        var sku = $(this).val();
        $el.price_comparison_section.show();
    });

});