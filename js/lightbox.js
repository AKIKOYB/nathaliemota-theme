jQuery(document).ready(function($) {
    var currentImageIndex = 0;
    var images = $('.fullscreen-icon'); // Select all full-screen icons

    function openLightbox(index) {
        var imgSrc = $(images[index]).attr('href');
        var imgTitle = $(images[index]).closest('.photo-item').find('.photo-title').text();

        $('#lightbox-image').attr('src', imgSrc);
        $('#lightbox-title').text(imgTitle);
        $('#lightbox-overlay').fadeIn();
        currentImageIndex = index;
    }

    function closeLightbox() {
        $('#lightbox-overlay').fadeOut();
    }

    function showNextImage() {
        currentImageIndex = (currentImageIndex + 1) % images.length;
        openLightbox(currentImageIndex);
    }

    function showPrevImage() {
        currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
        openLightbox(currentImageIndex);
    }

    // Open lightbox on full-screen icon click
    $('.fullscreen-icon').click(function(e) {
        e.preventDefault();
        var index = $(this).closest('.photo-item').index('.photo-item');
        openLightbox(index);
    });

    // Close lightbox on close button or overlay click
    $('#lightbox-close, #lightbox-overlay').click(function(e) {
        if (e.target.id === 'lightbox-overlay' || e.target.id === 'lightbox-close') {
            closeLightbox();
        }
    });

    // Navigate through images
    $('#lightbox-next').click(function(e) {
        e.preventDefault();
        showNextImage();
    });

    $('#lightbox-prev').click(function(e) {
        e.preventDefault();
        showPrevImage();
    });
});
