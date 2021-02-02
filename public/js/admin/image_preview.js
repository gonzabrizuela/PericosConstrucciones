function setImagePreview(input, id) {

    $('#' + id + '_error').hide();
    $('#' + id + '_error_lrv').hide();
    $('#preview_' + id).hide();
    $('#' + id).removeClass('is-invalid');
 
    var imageExtensions = ["png", "gif", "jpg", "jpeg", "mp4"];

    if (input.files && input.files[0]) {

        var imageName = $('#' + id).val();
        var imageExt = imageName.substring(imageName.lastIndexOf('.') + 1).toLowerCase();

        if (!imageExtensions.includes(imageExt) || input.files[0].size > 1048576) {
            
            $('#' + id + '_error').show();
            $('#' + id).addClass('is-invalid');
            $('#' + id).val('');
            $('#preview_' + id).html('');
            
            return false;
        }

        var reader = new FileReader();

        reader.onload = function (e) {
            $('#preview_' + id).html('<img id="image_preview" src="' + e.target.result + '" alt="" class="img-fluid article_image_preview">');
            $('#preview_' + id).show();
        };

        reader.readAsDataURL(input.files[0]);
    }
}