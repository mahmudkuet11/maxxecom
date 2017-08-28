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