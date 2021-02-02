function setVideoPreview(input, id) {
    
    $('#' + id + '_error').hide();
    $('#' + id + '_error_lrv').hide();
    $('#preview_' + id).hide();
    $('#' + id).removeClass('is-invalid');
    
    var videoExtensions = ["mp4"];
    var videoName = $('#' + id).val();
    var videoExt = videoName.substring(videoName.lastIndexOf('.') + 1).toLowerCase();

    if (!videoExtensions.includes(videoExt) || input.files[0].size > 10485760) {
        
        $('#' + id + '_error').show();
        $('#' + id).addClass('is-invalid');
        $('#' + id).val('');
        $('#preview_' + id).html('');
        
        return false;
    }

    var video = '';

    video += '<video style="width:100%;" class="img-responsive article_video_preview" controls>';
    video += '<source src="' + URL.createObjectURL(input.files[0]) + '">';
    video += 'Your browser does not support HTML5 video.';
    video += '</video>';

    $('#preview_' + id).html(video);
    $('#preview_' + id).show();
}