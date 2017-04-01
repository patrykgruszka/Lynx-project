(function($, document) {
    $(function() {
        $("ul.kanban-group").sortable({
            connectWith: "ul.kanban-group",
            placeholder: "kanban-task-placeholder",
            items: "li.kanban-task",
            tolerance: "pointer",
            cursor: "move",
            dropOnEmpty: true
            // start: function( event, ui ) {
            //     $(ui.placeholder).height($(ui.helper).outerHeight());
            // }
        });
    });
}(jQuery, document));