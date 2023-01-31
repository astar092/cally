$(function() {
    var $form = $('.farm-application');
    var $input_groups = $form.find('.input-groups');
    var $text_input =  $input_groups.find('.input input[type=text]');
    var $file_input = $form.find('.js-attach-file');
    var $input =  $input_groups.find('.input input[type=file]');

    $input.on('change', createNewInput);
    $text_input.click(function() {
        $(this).parent().find("input:file").click();
    });

    $file_input.click(function() {
        $(this).parent().find("input:file").click();
    });

    function createNewInput(e) {
        var name = e.target.files[0].name;
        $text_input = $(this).closest('.ui.input').find('input[type=text]');
        $input = $(this).closest('.ui.input').find('input[type=file]')
        $text_input.val(name);

        if ($(this).closest('.ui.input').index() != $(this).closest('.input-groups').find('.ui.input').length - 1)
            return;

        var $new_input_group = $input.closest('.input').clone();
        var $new_input = $new_input_group.find('input[type=file]');
        var $new_text_input = $new_input_group.find('input[type=text]');
        // to open file
        var $new_file_input = $new_input_group.find('.js-attach-file');

        $new_input.val('');
        $new_text_input.val('');

        $input_groups.append($new_input_group);

        $new_input.on('change', createNewInput);
        $new_text_input.on('click', function() {
            $(this).parent().find("input:file").click();
        });

        // to open file
        $new_file_input.on('click', function() {
            $(this).parent().find("input:file").click();
        });
    }

    function openBox(e) {
        var $usage_block = $(this).closest('.usage-block');
        $usage_block.removeClass('closed');
        $usage_block.addClass('open');
        $usage_block.find('.js-close-box').off('click').on('click', closeBox);
    }

    function closeBox(e) {
        var $usage_block = $(this).closest('.usage-block');

        $usage_block.removeClass('open');
        $usage_block.addClass('closed');

        var $short_info_block = $usage_block.find('.short-info');
        var dose = $usage_block.find('input.dose').val();
        var culture_object_data = $usage_block.find('select.culture_object').select2('data');
        var harmfull_object_data = $usage_block.find('select.harmfull_object').select2('data');
        var culture_object_text = generateObjectText(culture_object_data);
        var harmfull_object_text = generateObjectText(harmfull_object_data);

        $short_info_block.find('.dose').text(dose);
        $short_info_block.find('.culture-object').text(culture_object_text);
        $short_info_block.find('.harmfull-object').text(harmfull_object_text);
    }

    function generateObjectText(data) {
        var text = "";
        for (var i = 0; i < data.length; i++) {
            text += data[i].text + (i + 1 == data.length ? "" : ", ");
        }

        return text;
    }


    if ($form.hasClass('edit')) {
        $form.find('.usage-block .closed-info .js-open-box').on('click', openBox);
    }

    if ($form.hasClass('view-only')) {
        $form.find('select.select2').select2({"disabled": true});
    }

    $('body').on('click', '.js-open-decline-popup', function() {
        var $ele = $(this);

        $('#application-decline-modal').modal().modal('show');
    });

    $('body').on('click', '.js-remove-block', function() {
        var $ele = $(this);
        var $usage_block = $ele.closest('.usage-block');
        var $drug_form_block = $ele.closest('.drug-form-block');

        openDeleteConfirmationPopup(function() {
            if ($usage_block.length)
                $usage_block.remove();
            else if ($drug_form_block.length)
                $drug_form_block.remove();
        });
    });

    $('body').on('click', '.js-issue-certificate', function() {
        var $ele = $(this);

        $('#application-issue-certificate-modal').modal().modal('show');
        initilizeCertificateModal();
    });

    $('.js-decline-modal-button').on('click', function(e){
        $modal = $('#application-decline-modal');
        $reason_input = $('.decline-reason-input');

        $reason_input.val($modal.find('#decline-reason').val());
        $('.decline-status').val(1);

        $form.submit();
    });

    $('.js-submit-accept-form').on('click', function(e){
        $('.accept-status').val(1);

        $form.submit();
    });


    $form.on('submit', function(e) {
        if (!validateBlock($form)) {
            e.preventDefault();
            $form.find('.application-error').removeClass('hidden');
            return;
        }


        // remove disabled attr from year selectors
        $(this).find('.year_selector').prop('disabled', false);
    });
});

function initilizeCertificateModal() {
    /*-----------------------------*/
    let farm_name = $('#name').val();
    let certificate_number = $('#certificate_number').val();
    let certificate_date = $('#certificate_date').val();
    $('td.name  input').val(farm_name);
    $('td.certificate_number  input').val(certificate_number);
    $('td.certificate_date  input').val(certificate_date);
    /*-----------------------------*/

    var  $modal = $('#application-issue-certificate-modal');
    var $form = $('.farm-application');
    var $accepted_table = $modal.find('.accepted-drugs');
    var $declined_table = $modal.find('.declined-drugs');
    var $modal_accepted_rows = $accepted_table.find('tbody tr');
    var clonned_modal_accepted_row = $modal_accepted_rows.filter('.sample-row').clone().removeClass('sample-row');
    var $modal_declined_rows = $declined_table.find('tbody tr');
    var clonned_modal_declined_row = $modal_declined_rows.filter('.sample-row').clone().removeClass('sample-row');

    $modal_accepted_rows.not('.sample-row').remove();
    $modal_declined_rows.not('.sample-row').remove();

    $modal.find('.js-issue-certificate-modal-button').off('click').on('click', function() {
        $('.certificate-issue-status').val(1);
        $modal.modal('hide');
        $form.submit();
    });
}
