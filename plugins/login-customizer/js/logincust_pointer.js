jQuery(document).ready( function($) {
    logincust_pointer_open_pointer(0);
    function logincust_pointer_open_pointer(i) {
        pointer = logincust.pointers[i];
        options = $.extend(pointer.options, {
            close: function () {
                $.post(ajaxurl, {
                    pointer: pointer.pointer_id,
                    action: 'dismiss-wp-pointer'
                });
            }
        });
        $(pointer.target).pointer(options).pointer('open');
    }
});