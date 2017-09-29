var Settings = {
    add_new_paypal_email_row_template: null,
    $add_new_paypal_email_row_btn: $("#add_new_paypal_email_row_btn"),
    $paypal_email_address_container: $("#paypal_email_address_container"),
    $save_settings_btn: $("#save_settings"),
    init: function(){
        this.add_new_paypal_email_row_template = _.template('\
            <div class="col-md-12 margin-top-10 paypal_email_address_row">\
                <div class="input-group">\
                    <input type="email" class="form-control">\
                    <span class="input-group-btn">\
                        <button class="btn btn-danger remove_row" type="button">X</button>\
                    </span>\
                </div>\
            </div>');

        this.listen();

    },
    listen: function(){
        this.$add_new_paypal_email_row_btn.click(_.bind(this.addNewPaypalEmailAddressRow, this));
        this.$paypal_email_address_container.on('click', '.remove_row', this.removePaypalEmailAddressRow);
        this.$save_settings_btn.click(_.bind(this.saveSettings, this));

    },
    addNewPaypalEmailAddressRow: function(){
        this.$paypal_email_address_container.append(this.add_new_paypal_email_row_template());
    },
    removePaypalEmailAddressRow: function(){
        $(this).closest('.paypal_email_address_row').remove();
    },
    saveSettings: function(){
        $("body").trigger('pre_loader:show');
        var paypal_emails = this.getPaypalEmailAddresses();
        $.ajax({
            method: 'POST',
            url: Global.settings_update_url,
            data: {
                paypal_emails: paypal_emails
            },
            success: function(res){
                $("body").trigger('pre_loader:hide');
                if(res.status == 'success'){
                    $("body").trigger('pre_loader:notification:show', ['success', res.msg]);
                }else{
                    $("body").trigger('pre_loader:notification:show', ['danger', 'Settings could not be updated']);
                }
            },
            error: function(){
                $("body").trigger('pre_loader:hide');
                $("body").trigger('pre_loader:notification:show', ['danger', 'Settings could not be updated']);
            }
        });
    },
    getPaypalEmailAddresses: function(){
        var emails = [];
        this.$paypal_email_address_container.find('.paypal_email_address_row').each(function(){
            var email = $(this).find('input').val();
            if(email){
                emails.push(email);
            }
        });
        return emails;
    }
};

$(document).ready(function(){

    Settings.init();

});