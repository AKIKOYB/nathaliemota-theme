jQuery(document).ready(function($) {
    var currentImageIndex = 0; // To track the current image index
    var images = $('.fullscreen-icon'); // Select all full-screen icons

    function openLightbox(index) {
        var imageUrl = $(images[index]).attr('href');
        var refNumber = $(images[index]).data('ref-number');
        var category = $(images[index]).data('category');

        $('#lightbox-image').attr('src', imageUrl);
        $('#lightbox-ref-number').text(refNumber);
        $('#lightbox-category').text(category);

        $('#lightbox-overlay').fadeIn();
        currentImageIndex = index;
    }

    function showNextImage() {
        currentImageIndex = (currentImageIndex + 1) % images.length; // Move to the next image, loop back if at the end
        openLightbox(currentImageIndex);
    }

    function showPrevImage() {
        currentImageIndex = (currentImageIndex - 1 + images.length) % images.length; // Move to the previous image, loop back if at the start
        openLightbox(currentImageIndex);
    }

    // Open lightbox on full-screen icon click
    $(document).on('click', '.fullscreen-icon', function(e) {
        e.preventDefault();
        var index = $(this).closest('.photo-block, .photo-item').index('.photo-block, .photo-item');
        openLightbox(index);
    });

    // Close lightbox on close button or overlay click
    $('#lightbox-close, #lightbox-overlay').on('click', function(e) {
        if (e.target.id === 'lightbox-overlay' || e.target.id === 'lightbox-close') {
            $('#lightbox-overlay').fadeOut();
        }
    });

    // Navigate through images
    $('#lightbox-next').on('click', function(e) {
        e.preventDefault();
        showNextImage();
    });

    $('#lightbox-prev').on('click', function(e) {
        e.preventDefault();
        showPrevImage();
    });

    // Update images variable whenever the DOM changes
    $(document).on('DOMNodeInserted', function(e) {
        images = $('.fullscreen-icon');
    });
});
