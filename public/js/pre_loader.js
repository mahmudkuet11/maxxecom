var PreLoader = {
    $messageModal: null,
    init: function(){
        this.initModal();
        this.listen();
    },
    initModal: function(){
        var html = '' +
            '<div class="modal fade in" id="pre_loader_msg_modal">\n' +
            '  <div class="modal-dialog">\n' +
            '    <div class="modal-content">\n' +
            '      <div class="modal-body">\n' +
            '        <div class="alert alert-dismissible alert-success">\n' +
            '          <strong></strong>\n' +
            '        </div>\n' +
            '      </div>\n' +
            '    </div>\n' +
            '  </div>\n' +
            '</div>' +
            '';
        $("body").append(html);
        this.$messageModal = $("#pre_loader_msg_modal");
    },
    listen: function(){
        var _this = this;
        $("body").on('pre_loader:show', {}, function(e){
            _this.showPreLoader();
        });
        $("body").on('pre_loader:hide', {}, function(e){
            _this.hidePreLoader();
        });
        $("body").on('pre_loader:notification:show', {}, function(e, type, message){
            _this.showMsg(type, message);
        });
    },
    showMsg: function(type, msg){
        this.$messageModal.find('.alert').removeClass('alert-success alert-danger').addClass('alert-' + type);
        this.$messageModal.find('.alert strong').html('<span style="color: #fff;">'+ msg +'</span>');
        this.$messageModal.modal('show');
    },
    showPreLoader: function(){
        $("body").prepend('<div class="pre_loader">Loading...</div>');
    },
    hidePreLoader: function(){
        $(".pre_loader").remove();
    }
};

$(document).ready(function(){
    PreLoader.init();
});