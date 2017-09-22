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
        Item.fetchByItemID(Global.item_id, this.fillUpWizard);
        this.listen();
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
        $("#input_title").val(item.title);
    }
};

$(document).ready(function(){
    Listing.init();
});