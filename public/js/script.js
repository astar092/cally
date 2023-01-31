var locale = "ru";

$(function() {
    if (window.innerWidth <= 800) $('body').addClass('open-menu');
    
    $(window).resize(function() {
      if (window.innerWidth <= 800) $('body').addClass('open-menu');
    });

    $('.js-change-language').on('click', function() {
        $('.change-language-select-block').toggleClass('hidden');
    });
    $('.change-language-select-block select').on('change', function() {
        var val = $(this).val();
        window.location.href = APP_URL+'/language/'+val;
    });

    $('.top-menu .launch').on('click', function() {
        if ($('body').hasClass('open-menu')) {
            $('body').removeClass('open-menu');
        } else {
            $('body').addClass('open-menu');
        }
    });

    if($().datepicker) {
        $('.datepicker').each(function(k,v) {
            if (!$(v).val()) {
                $(v).datepicker({
                    language: 'ru',
                }).datepicker("setDate", new Date());
            } else {
                $(v).datepicker({
                    language: 'ru',
                });
            }
        });
    }

    $('body').on('click', '.open_modal', function() {
        var $ele = $(this);
        var _id = $ele.data('modal-id');

        $('#'+_id).modal('setting', "duration", "0").modal({
            onVisible: function () {
                if (_id == "drug-modal")
                    setDrugModalText($ele);
            }
        }).modal('show', 0);
    });

    $('.select2').select2();
});


$(function() {
    $('body').find('[data-toggle=confirmation]').confirmation({
        rootSelector: '[data-toggle=confirmation]',
        container: 'body',
        placement: 'bottom',
        title: 'Вы нажали кнопку удаления, продолжить?',
        btnOkLabel: 'Да',
        btnCancelLabel: 'Отменить',
        singleton: true,
        popout: true
    });
});

function getNameLocale(json) {
    return json['name_'+locale];
}

