(function($) {
    $.getStylesheet = function (href) {
        var $d = $.Deferred();
        var $link = $('<link/>', {
            rel: 'stylesheet',
            type: 'text/css',
            href: href
        }).appendTo('head');
        $d.resolve($link);
        return $d.promise();
    };
})(jQuery);

$(document).ready(function(){

    $.when($.getStylesheet('/css/jqtree.css'), $.getScript('/js/tree.jquery.js'))
        .then(function () {

            //Category tree

            var $category_tree = $(".ebay_category_tree");
            $category_tree.tree({
                closedIcon: $('<i class="fa icon-plus-square"></i>'),
                openedIcon: $('<i class="fa icon-minus-square"></i>'),
                dataFilter: function(data){
                    return _.map(data, function(category){
                        return {
                            label: category.name,
                            id: category.category_id,
                            load_on_demand: category.is_leaf == false
                        };
                    });
                }
            });

            $("#select_ebay_category").click(function(){
                $("#select_category_modal").modal('show');
            });

            $category_tree.bind(
                'tree.select',
                function(event) {
                    if (event.node) {
                        // node was selected
                        var node = event.node;
                        if(node.load_on_demand) return;
                        $("#input_category").val(node.id);
                        var category_hierarchy = [node.name];
                        while(node.parent){
                            node = node.parent;
                            if(node.name){
                                category_hierarchy.push(node.name);
                            }
                        }
                        category_hierarchy = category_hierarchy.reverse().join(" > ");
                        $("#category_hierarchy").text(category_hierarchy);
                    }
                    else {
                        // event.node is null
                        // a node was deselected
                        // e.previous_node contains the deselected node
                    }
                }
            );


            //Store Category tree

            var $store_category_tree = $(".ebay_store_category_tree");
            $store_category_tree.tree({
                closedIcon: $('<i class="fa icon-plus-square"></i>'),
                openedIcon: $('<i class="fa icon-minus-square"></i>'),
            });

            $("#select_ebay_store_category").click(function(){
                $("#select_store_category_modal").modal('show');
            });

            $store_category_tree.bind(
                'tree.select',
                function(event) {
                    if (event.node) {
                        // node was selected
                        var node = event.node;
                        $("#input_store_category_id").val(node.id);
                        var category_hierarchy = [node.name];
                        while(node.parent){
                            node = node.parent;
                            if(node.name){
                                category_hierarchy.push(node.name);
                            }
                        }
                        category_hierarchy = category_hierarchy.reverse().join(" > ");
                        $("#store_category_hierarchy").text(category_hierarchy);
                    }
                    else {
                        // event.node is null
                        // a node was deselected
                        // e.previous_node contains the deselected node
                    }
                }
            );


            //Store Category 2 tree

            var $store_category2_tree = $(".ebay_store_category2_tree");
            $store_category2_tree.tree({
                closedIcon: $('<i class="fa icon-plus-square"></i>'),
                openedIcon: $('<i class="fa icon-minus-square"></i>'),
            });

            $("#select_ebay_store_category2").click(function(){
                $("#select_store_category2_modal").modal('show');
            });

            $store_category2_tree.bind(
                'tree.select',
                function(event) {
                    if (event.node) {
                        // node was selected
                        var node = event.node;
                        $("#input_store_category2_id").val(node.id);
                        var category_hierarchy = [node.name];
                        while(node.parent){
                            node = node.parent;
                            if(node.name){
                                category_hierarchy.push(node.name);
                            }
                        }
                        category_hierarchy = category_hierarchy.reverse().join(" > ");
                        $("#store_category2_hierarchy").text(category_hierarchy);
                    }
                    else {
                        // event.node is null
                        // a node was deselected
                        // e.previous_node contains the deselected node
                    }
                }
            );

        }, function () {
            console.log('an error occurred somewhere');
        });




    $("#select_category_modal .save_btn").click(function(){

    });

});