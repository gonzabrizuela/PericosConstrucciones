
var subTaskCount = 0;
var subTaskActiveCount = 0;
var taskId = 0;
var taskFileName = "";
var taskFileType = 0;

$(document).ready(function () {
    setTasks();
});

function setTasks() {

    var params = new Object();
    params.reduced_task_view = reduced_task_view;

    ajaxRequest("GET", get_tasks_ajax_url, params, "setTasksResponse");
}

function setTasksResponse(data) {

    $('#tasks_box').empty();

    if (data.success) {
        $('#tasks_box').html(data.html);
    }
}

function onOpenTask(id) {

    event.preventDefault();

    subTaskCount = 0;
    subTaskActiveCount = 0;
    taskId = id;
    taskFileName = "";
    taskFileType = 0;

    $('.pop_task .task .content .row.items .progress .bar').width(0);
    $('#add_task_comment_text').css('border-color', '#CCC');
    $('#task_file').val('');
    $('#task_file_text_btn').removeClass("attach_text_error");
    $('#task_file_text_btn').empty();
    
    var params = new Object();
    params.task_id = id;

    ajaxRequest("GET", get_task_ajax_url, params, "showTaskModal");
}

function showTaskModal(data) {

    $('#task_modal_title').html(data.title);
    $('#task_modal_description').html(data.description);

    setTaskFiles(data.files);
    setTaskSubTasks(data.sub_tasks);
    setTaskComments(data.comments);

    $('.pop_task').fadeIn(400);
}

function setTaskFiles(files) {

    $('#task_modal_files').empty();

    $.each(files, function (key, value) {

        var file = '<div class="item">';
        file += '<a href="/uploads/task/file/' + $(this)[0].file + '" target="_blank">' + $(this)[0].name + '</a>';

        if ($(this)[0].user_id == user_id) {
            file += '<span onClick="(deleteTaskFile(' + $(this)[0].id + '))" class="delete">eliminar</span>';
        }

        file += '</div>';

        $('#task_modal_files').append(file);
    });
}

function setTaskSubTasks(subTasks) {

    subTaskCount = subTasks.length;
    subTaskActiveCount = 0;
    var subTaskBlock = '';

    $.each(subTasks, function (key, value) {

        subTaskBlock += '<div class="item n' + $(this)[0].id + '">';

        if ($(this)[0].status == 1) {
            subTaskActiveCount++;
            subTaskBlock += '<div data-checked="1" class="check" style="background-position: bottom;" onclick="setSubTaskStatus(' + $(this)[0].id + ');"></div>';
        } else {
            subTaskBlock += '<div data-checked="0" class="check" style="background-position: top;" onclick="setSubTaskStatus(' + $(this)[0].id + ');"></div>';
        }

        subTaskBlock += '<div class="text">' + $(this)[0].name + '</div>';
        subTaskBlock += '</div>';
    });

    $('.row.items .items_c').html(subTaskBlock);

    printBar();
}

function setTaskComments(comments) {

    $('#task_comments').empty();
    var taskCommentBlock = '';

    $.each(comments, function (key, value) {

        taskCommentBlock += '<div class="comment">';
        taskCommentBlock += '<div class="user">';
        if ($(this)[0].user_type == 1) {
            taskCommentBlock += '<div class="initials" style="background-color:#000; border: 2px solid #ff2d00;">' + $(this)[0].initials + '</div>';
        } else {
            taskCommentBlock += '<div class="initials" style="background-color: ' + $(this)[0].color + ';">' + $(this)[0].initials + '</div>';
        }
        taskCommentBlock += '<div class="name">' + $(this)[0].name + ' ' + $(this)[0].last_name;
        taskCommentBlock += '<span class="date">' + $(this)[0].created_at.substring(0, 10) + '</span>';
        if ($(this)[0].user_id == user_id) {
            taskCommentBlock += '<span onClick="(deleteTaskComment(' + $(this)[0].id + '))" class="delete">eliminar</span>';
        }
        taskCommentBlock += '</div>';
        taskCommentBlock += '<div class="text">' + $(this)[0].comment + '</div>';
        taskCommentBlock += '</div>';
        taskCommentBlock += '</div>';
    });

    $('#task_comments').append(taskCommentBlock);
}

function onHideTask() {
    $('.pop_task').fadeOut(250);
}

function setSubTaskStatus(subTaskId) {

    event.preventDefault();

    var params = new Object();
    params._token = csrf_token;
    params.task_id = taskId;
    params.sub_task_id = subTaskId;

    ajaxRequest("POST", set_sub_task_status_url, params, "setSubTaskStatusResponse");
}

function setSubTaskStatusResponse(data) {

    setTaskSubTasks(data);
    setTasks();
}

function printBar() {

    var itemPercent = Math.ceil(100 / subTaskCount * subTaskActiveCount);

    $('.pop_task .task .content .row.items .progress .bar').animate({width: itemPercent + '%'});
}

$('#task_file').change(function () {

    $('#task_file_text_btn').empty();
    $('#task_file_text_btn').removeClass("attach_text_error");

    var validImageExtensions = ["png", "gif", "jpg", "jpeg"];
    var validVideoExtensions = ["mp4"];
    var validDocExtensions = ["doc", "docx", "ppt", "pptx", "xls", "xlsx", "pdf"];
    var validFileExtensions = ["zip", "rar"];

    if ($(this).prop('files').length > 0) {

        var file = $(this).prop('files')[0];
        var fileExt = file.name.substring(file.name.lastIndexOf('.') + 1);

        if (validImageExtensions.includes(fileExt)) { // || input.files[0].size > 1048576
            taskFileType = 1;
        } else if (validVideoExtensions.includes(fileExt)) { // || input.files[0].size > 1048576
            taskFileType = 2;
        } else if (validDocExtensions.includes(fileExt)) { // || input.files[0].size > 1048576
            taskFileType = 3;
        } else if (validFileExtensions.includes(fileExt)) { // || input.files[0].size > 1048576
            taskFileType = 4;
        } else {

            $('#task_file').val('');
            $('#task_file_text_btn').html("invalid file extension");
            $('#task_file_text_btn').addClass("attach_text_error");
            
            return false;
        }

        taskFileName = file.name.substring(0, file.name.lastIndexOf('.'));

        $('#task_file_text_btn').html(file.name);
    }
});

$('#add_task_comment_btn').click(function () {

    event.preventDefault();
    formdata = new FormData();
    
    var commentBox = $('#add_task_comment_text');
    commentBox.css('border-color', '#CCC');

    if (commentBox.val().length < 1) {
        commentBox.css('border-color', '#fa0505');
        return false;
    }
    
    formdata.append("_token", csrf_token);
    formdata.append("task_id", taskId);
    formdata.append("task_comment", commentBox.val());

    if ($('#task_file').prop('files').length > 0) {
        file = $('#task_file').prop('files')[0];
        formdata.append("task_file", file);
        formdata.append("file_name", taskFileName);
        formdata.append("file_type", taskFileType);
    }

    ajaxRequest("POST", add_task_comment_url, formdata, "addTaskCommentResponse", "formdata");
});

function addTaskCommentResponse(data) {

    taskFileName = "";
    taskFileType = 0;
    $('#task_file_text_btn').empty();
    $('#add_task_comment_text').val('');

    var oData = JSON.parse(data);

    if (oData.files) {
        setTaskFiles(oData.files);
    }

    setTaskComments(oData.comments);
}

function deleteTaskComment(commentId) {

    event.preventDefault();

    var params = new Object();
    params._token = csrf_token;
    params.task_id = taskId;
    params.task_comment_id = commentId;

    ajaxRequest("POST", delete_task_comment_url, params, "deleteTaskCommentResponse");
}

function deleteTaskCommentResponse(data) {

    setTaskComments(data);
}

function deleteTaskFile(fileId) {

    event.preventDefault();

    var params = new Object();
    params._token = csrf_token;
    params.task_id = taskId;
    params.task_file_id = fileId;

    ajaxRequest("POST", delete_task_file_url, params, "deleteTaskFileResponse");
}

function deleteTaskFileResponse(data) {

    setTaskFiles(data);
}

function ajaxRequest(type, url, params, callBack, dataType = "json") {

    jQuery.support.cors = true;
    
    if (type !== "GET" && dataType != "formdata") {
        params = JSON.stringify(params);
    }

    $.ajax({
        type: type,
        url: url,
        data: params,
        contentType: dataType == "formdata" ? false : "application/json; charset=utf-8",
        dataType: dataType == "formdata" ? false : "json",
        processData: dataType == "formdata" ? false : true,
        beforeSend: function () {
            if (dataType == "formdata") {
                $('#ajaxLoader').show();
            }
        },
        complete: function () {
            $('#ajaxLoader').hide();
        },
        success: function (data) {
            //console.log("REQUEST [ " + type + " ] [ " + url + " ] SUCCESS");
            //console.log(data);
            window[callBack](data);
        },
        error: function (msg, url, line) {
            //console.log('ERROR !!! msg = ' + msg + ', url = ' + url + ', line = ' + line);
        }
    });
}