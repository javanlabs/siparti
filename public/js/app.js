$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function(){
    $('.ui.dropdown').dropdown();
    $('.ui.checkbox').checkbox();
    $('.ui.accordion').accordion({exclusive: false});
    $('.ui.embed').embed();
    $('.message .close')
        .on('click', function() {
            $(this)
                .closest('.message')
                .transition('hide')
            ;
        });

    $('.item-popup').each(function(){
        $(this)
            .popup({
                popup     : $(this).data('target'),
                hoverable : true,
                position  : 'bottom left',
                delay     : {
                    show: 100,
                    hide: 100
                }
            })
        ;
    });

    $('.browse-proker')
        .popup({
            popup     : '#popup-proker',
            hoverable : true,
            position  : 'bottom left',
            delay     : {
                show: 100,
                hide: 500
            }
        })
    ;

    $('#browse-user-menu')
        .popup({
            popup     : '#popup-user-menu',
            hoverable : true,
            position  : 'bottom left',
            delay     : {
                show: 100,
                hide: 500
            }
        })
    ;

    $('.section-audit-trails').on('click', '.btn-view-log', function(e){
        e.preventDefault();
        $($(this).data('target')).modal('show');
    });
});

