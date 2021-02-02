function onGalleryThumb(pic) {
    
    var mainPic = $('.main_pic').attr('src');
    var currPic = pic.attr('src');
        
    $('.main_pic').attr('src', currPic);
    pic.attr('src', mainPic);
}
