
var quill = '';
var currentBlock = '';
var customBoxCount = 0;
var currentOrder = 0;
var delBlocks = new Array();

$(document).ready(function () {
    initTextEditor();
});

function initTextEditor() {

    quill = new Quill('#editor-container', {
        modules: {
            syntax: true,
            toolbar: '#toolbar-container'
        },
        placeholder: 'Texto',
        theme: 'snow'
    });
}

$(document).on('click', '.add_custom_block', function () {
    currentBlock = $(this);
    addTaskBlock($(this).data("type"));
});

function addTaskBlock(blockId = "", text = "") {

    if (blockId > 0) {
        customBoxCount = blockId;
        currentOrder++;
    } else {
        customBoxCount++;
        currentOrder = parseInt(currentBlock.data("order"));
    }

    var textBlock = '';

    textBlock += '<div id="custom_block_' + customBoxCount + '" class="form-group custom_block_form_group">';
    textBlock += '<input type="hidden" class="block_order" id="block_order_' + customBoxCount + '" name="block_order_' + customBoxCount + '" value="' + currentOrder + '"/>';
    textBlock += '<div class="form-group">';
    textBlock += '<label>Sub Tarea</label>';
    textBlock += '<input id="sub_task_' + customBoxCount + '" name="sub_task_' + customBoxCount + '" maxlength="250" class="form-control sub_task_input" placeholder="Sub Tarea" value="' + text + '" />';
    textBlock += '</div>';

    textBlock += getRemoveBlockBtn();
    textBlock += '</div>';

    if (text.length > 0) {
        $('#sub_task_box').append(textBlock).children(':last').hide().fadeIn();
    } else {
        setCustomBlockOrder();
        currentBlock.parent().after(textBlock).children(':last').hide().fadeIn();
    }

    $('#custom_block_' + customBoxCount).after(getAddBlockBtn());
}

function getRemoveBlockBtn() {

    var btn = '';

    btn += '<div class="custom_block_remove">';
    btn += '<button type="button" class="btn btn-outline-danger remove_block_btn" data-block_id="' + customBoxCount + '">X</button>';
    btn += '</div>';

    return btn;
}

function getAddBlockBtn() {

    var btn = '';
    var order = currentOrder + 1;

    btn += '<div id="add_custom_block_' + customBoxCount + '" class="add_custom_block_box">';
    btn += '<button type="button" class="btn btn-outline-success add_custom_block" data-order="' + order + '">agregar sub tarea</button>';
    btn += '</div>';

    return btn;
}

function setCustomBlockOrder() {

    $(".add_custom_block").each(function () {
        if (parseInt($(this).data("order")) > currentOrder) {
            $(this).data("order", parseInt($(this).data("order")) + 1);
            //console.log($(this).data("order") + " > " + currentBlock.data("order"));
        }
    });

    $(".block_order").each(function () {
        if (parseInt($(this).val()) >= currentOrder) {
            $(this).val(parseInt(parseInt($(this).val()) + 1));
            console.log($(this).val() + " > " + currentBlock.data("order") + " => " + parseInt(parseInt($(this).val()) + 1));
        }
    });

}

$(document).on('click', '.remove_block_btn', function () {

    $('#deleteBlockModal').modal('show');
    delBlockButtonId = $(this).data("block_id");
});

function deleteCustomBlock(delBlockButtonId) {

    delBlocks.push(delBlockButtonId);

    console.log(delBlocks);

    $('#add_custom_block_' + delBlockButtonId).fadeOut("slow", function () {
        $(this).remove();
    });

    $('#custom_block_' + delBlockButtonId).fadeOut("slow", function () {
        $(this).remove();
    });

    $('#deleteBlockModal').modal('hide');
}

function setMaxBlockId(blockId) {

    customBoxCount = blockId;
}
