//toggle menu
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const mobileMenu = document.querySelector('.mobile-menu');
    const closeMenu = document.querySelector('.close-menu');

    menuToggle.addEventListener('click', function() {
        mobileMenu.classList.toggle('open');
        menuToggle.classList.toggle('open');
        menuToggle.setAttribute('aria-expanded', mobileMenu.classList.contains('open'));
    });

    closeMenu.addEventListener('click', function() {
        mobileMenu.classList.remove('open');
        menuToggle.classList.remove('open');
        menuToggle.setAttribute('aria-expanded', 'false');
    });
});


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
// Handle the filter and sort changes
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
                    if (!button.hasClass('no-more-photos')) {
                        button.text('No more photos'); // Change text if no more photos
                        button.prop('disabled', true); // Disable the button
                        button.addClass('no-more-photos');
                    }
                }
            }
        });
    }

    // Handle filter changes
    $('#filter-category, #filter-format, #filter-date').on('change', function() {
        loadPhotos(1, false); // Reset to page 1 and replace photos
    });

    // Handle "Load More" button
    $('#plus').on('click', function() {
        var page = $(this).data('page') + 1;
        loadPhotos(page);
    });




// lightbox.js
jQuery(document).ready(function($) {
    // Open lightbox
    $('.fullscreen-icon').on('click', function(event) {
        event.preventDefault();
        
        // Get image URL, reference number, and category
        let imageUrl = $(this).attr('href');
        let refNumber = $(this).closest('.photo-item').find('.photo-title').data('reference');
        let category = $(this).closest('.photo-item').find('.photo-category').text();
        
        // Set lightbox content
        $('#lightbox-image').attr('src', imageUrl);
        $('#lightbox-ref-number').text(refNumber);
        $('#lightbox-category').text(category);
        
        // Show lightbox
        $('#lightbox-overlay').fadeIn();
    });

    // Close lightbox
    $('#lightbox-close, #lightbox-overlay').on('click', function(e) {
        if (e.target.id === 'lightbox-overlay' || e.target.id === 'lightbox-close') {
            $('#lightbox-overlay').fadeOut();
        }
    });

    // Previous and Next functionality
    $('#lightbox-prev').on('click', function() {
        // Logic to show previous image
    });

    $('#lightbox-next').on('click', function() {
        // Logic to show next image
    });
});

// JavaScript for Dropdown Styling

$('select').each(function(){
    var $this = $(this), numberOfOptions = $(this).children('option').length;
  
    $this.addClass('select-hidden'); 
    $this.wrap('<div class="select"></div>');
    $this.after('<div class="select-styled"></div>');

    var $styledSelect = $this.next('div.select-styled');
    $styledSelect.text($this.children('option').eq(0).text());
  
    var $list = $('<ul />', {
        'class': 'select-options'
    }).insertAfter($styledSelect);
  
    for (var i = 0; i < numberOfOptions; i++) {
        $('<li />', {
            text: $this.children('option').eq(i).text(),
            rel: $this.children('option').eq(i).val()
        }).appendTo($list);
        if ($this.children('option').eq(i).is(':selected')){
          $('li[rel="' + $this.children('option').eq(i).val() + '"]').addClass('is-selected')
        }
    }
  
    var $listItems = $list.children('li');
  
    $styledSelect.click(function(e) {
        e.stopPropagation();
        $('div.select-styled.active').not(this).each(function(){
            $(this).removeClass('active').next('ul.select-options').hide();
        });
        $(this).toggleClass('active').next('ul.select-options').toggle();
    });
  
    $listItems.click(function(e) {
        e.stopPropagation();
        $styledSelect.text($(this).text()).removeClass('active');
        $this.val($(this).attr('rel'));
      $list.find('li.is-selected').removeClass('is-selected');
      $list.find('li[rel="' + $(this).attr('rel') + '"]').addClass('is-selected');
        $list.hide();
        //console.log($this.val());
    });
  
    $(document).click(function() {
        $styledSelect.removeClass('active');
        $list.hide();
    });

});
});