$("#task_form").submit(function (event) {

    if (quill.getLength() > 1) {
        var contentInput = $('#description');
        contentInput.val(quill.container.firstChild.innerHTML);
    }

    if (validateTaskForm()) {
        event.preventDefault();
    }

    $('#delete_blocks').val(delBlocks.toString());

    //event.preventDefault();
});

function validateTaskForm() {

    $('#group_id_error').hide();
    $('#group_id').removeClass('is-invalid');
    $('#end_at_error').hide();
    $('#end_at').removeClass('is-invalid');
    $('#title_error').hide();
    $('#title').removeClass('is-invalid');
    $('#description_error').hide();
    $('#editor-container').css('border-color', '#ced4da');
    $('#sub_task_error').hide();

    var error = false;
    var subTaskError = true;

    if ($('#group_id').val() < 1) {
        $('#group_id_error').show();
        $('#group_id').addClass('is-invalid');
        error = true;
    }

    if ($('#end_at').val() == "") {
        $('#end_at_error').show();
        $('#end_at').addClass('is-invalid');
        error = true;
    }

    if ($('#title').val().length < 1 || $('#title').val().length > 250) {
        $('#title_error').show();
        $('#title').addClass('is-invalid');
        error = true;
    }

    if (quill.getLength() <= 1 || quill.container.firstChild.innerHTML.length > 12000) {
        $('#description_error').show();
        $('#editor-container').css('border-color', '#dc3545');
        error = true;
    }

    $(".sub_task_input").each(function () {
        if ($(this).val().length > 0) {
            subTaskError = false;
        }
    });

    if (subTaskError) {
        $('#sub_task_error').show();
        error = true;
    }

    return error;
}