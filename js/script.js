jQuery(document).ready(function($) {
    // Get the modal contact form
    var modal = $('#contact-modal');
    // Get the button in the primary menu to open the modal
    var primaryMenuBtn = $('.contact-menu-item a');  //var btn = $('.contact-menu-item a');  old version which worked well
    // Get the button inside contact-section that opens the modal
    var contactSectionBtn = $('.contact-section button');
    
    // When the user clicks on the primary menu button, open the modal
    primaryMenuBtn.on('click', function(event) {
        event.preventDefault(); // Prevent default link behavior
        modal.fadeIn();
    });

    // When the user clicks on the contact section button, open the modal
    contactSectionBtn.on('click', function(event) {
        event.preventDefault(); // Prevent default link behavior
        var photoRef = $(this).data('ref');
        // Set the value of the 'your-subject' field in the contact form
        $('#contact-modal input[name="your-subject"]').val(photoRef);
        modal.fadeIn();
    });

    // old version which worked before adding 2nd contact When the user clicks on the button, open the modal
    //btn.on('click', function(event) {
    //    event.preventDefault(); // Prevent default link behavior

    //    var photoRef = $(this).data('ref');
        
        // Set the value of the reference field in the contact form
    //    $('#contact-modal input[name="reference-field"]').val(photoRef); // Assuming the reference field name is 'reference-field'
        
    //    modal.fadeIn();
    //});

    // When the user clicks anywhere outside of the modal, close it
    $(window).on('click', function(event) {
        if ($(event.target).is(modal)) {
            modal.fadeOut();
        }
    });

    // Accessibility: Close the modal when pressing the Esc key
    $(document).on('keydown', function(event) {
        if (event.key === "Escape") { // Check if the Esc key is pressed
            modal.fadeOut(); // Close the modal
        }
    });
});

//for AJAX Request
jQuery(document).ready(function($) {
    $('#plus').on('click', function() {
        var button = $(this);
        var page = button.data('page');
        var nextPage = page + 1;

        $.ajax({
            url: nathaliemota_ajax.ajax_url,
            type: 'post',
            data: {
                action: 'load_more_photos',
                page: nextPage
            },
            beforeSend: function() {
                button.text('Loading...'); // Change button text while loading
            },
            success: function(response) {
                if (response) {
                    $('.photo-gallery').append(response); // Append new photos
                    button.data('page', nextPage);
                    button.text('Charger plus'); // Reset button text
                } else {
                    button.text('No more photos'); // Change text if no more photos
                    button.prop('disabled', true);
                }
            }
        });
    });
});

//handle the filter and sort changes
jQuery(document).ready(function($) {
    function loadPhotos(page, append = true) {
        var category = $('#filter-category').val();
        var format = $('#filter-format').val();
        var order = $('#filter-date').val();

        $.ajax({
            url: nathaliemota_ajax.ajax_url,
            type: 'post',
            data: {
                action: 'load_more_photos',
                page: page,
                category: category,
                format: format,
                order: order,
            },
            beforeSend: function() {
                $('#plus').text('Loading...'); // Change button text while loading
            },
            success: function(response) {
                if (response) {
                    if (append) {
                        $('.photo-gallery').append(response); // Append new photos
                    } else {
                        $('.photo-gallery').html(response); // Replace photos
                    }
                    $('#plus').data('page', page);
                    $('#plus').text('Charger plus'); // Reset button text
                } else {
                    $('#plus').text('No more photos');
                    $('#plus').prop('disabled', true);
                }
            }
        });
    }

    $('#plus').on('click', function() {
        var button = $(this);
        var page = button.data('page') + 1;
        loadPhotos(page);
    });

    $('#filter-category, #filter-format, #filter-date').on('change', function() {
        loadPhotos(1, false); // Reset to page 1 and replace photos
    });
});


// lightbox.js
jQuery(document).ready(function($) {
    // Open lightbox
    $('.fullscreen-icon').on('click', function(event) {
        event.preventDefault();
        
        // Get image URL, reference number, and category
        let imageUrl = $(this).attr('href');
        let refNumber = $(this).data('reference');
        let category = $(this).data('categorie');
        
        // Set lightbox content
        $('#lightbox-image').attr('src', imageUrl);
        $('#lightbox-ref-number').text(refNumber);
        $('#lightbox-category').text(category);
        
        // Show lightbox
        $('#lightbox-overlay').addClass('active');
    });

    // Close lightbox
    $('#lightbox-close').on('click', function() {
        $('#lightbox-overlay').removeClass('active');
    });

    // Previous and Next functionality (implement logic as needed)
    $('#lightbox-prev').on('click', function() {
        // Logic to show previous image
    });

    $('#lightbox-next').on('click', function() {
        // Logic to show next image
    });
});

