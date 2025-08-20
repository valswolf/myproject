jQuery(document).ready(function($){
    var mediaUploader;

    $('.upload-logo').click(function(e) {
        e.preventDefault();
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }
        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Logo',
            button: { text: 'Choose Logo' },
            multiple: false
        });
        mediaUploader.on('select', function() {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#theme_logo').val(attachment.url);
        });
        mediaUploader.open();
    });
	
});

document.addEventListener("DOMContentLoaded", function(){
    var menuToggle = document.querySelector(".menu-toggle");
    var mainMenu = document.querySelector(".main-menu");

    if(menuToggle && mainMenu) {
        menuToggle.addEventListener("click", function(){
            mainMenu.classList.toggle("show");
        });
    }
});


// Upload Social Media Icon
$(document).on('click', '.upload-social-icon', function(e) {
    e.preventDefault();
    var button = $(this);
    var mediaUploader = wp.media({
        title: 'Select Social Media Icon',
        button: { text: 'Use This Icon' },
        multiple: false
    });
    mediaUploader.on('select', function() {
        var attachment = mediaUploader.state().get('selection').first().toJSON();
        button.prev('.social-icon-url').val(attachment.url);
    });
    mediaUploader.open();
});
