$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function(){
    $('.ui.dropdown').dropdown();
    $('.ui.checkbox').checkbox();
    $('.message .close')
        .on('click', function() {
            $(this)
                .closest('.message')
                .transition('hide')
            ;
        });
});
