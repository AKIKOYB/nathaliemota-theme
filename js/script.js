// Ensure the DOM is fully loaded
jQuery(document).ready(function ($) {

    // Existing modal and AJAX functionalities
    var modal = $('#contact-modal');
    var primaryMenuBtn = $('.contact-menu-item a');
    var contactSectionBtn = $('.contact-section button');

    primaryMenuBtn.on('click', function (event) {
        event.preventDefault(); 
        modal.fadeIn();
    });

    contactSectionBtn.on('click', function (event) {
        event.preventDefault();
        var photoRef = $(this).data('ref');
        $('#contact-modal input[name="your-subject"]').val(photoRef);
        modal.fadeIn();
    });

    $(window).on('click', function (event) {
        if ($(event.target).is(modal)) {
            modal.fadeOut();
        }
    });

    $(document).on('keydown', function (event) {
        if (event.key === "Escape") {
            modal.fadeOut();
        }
    });

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
            beforeSend: function () {
                $('#plus').text('Loading...');
            },
            success: function (response) {
                if (response) {
                    if (append) {
                        $('.photo-gallery').append(response);
                    } else {
                        $('.photo-gallery').html(response);
                    }
                    $('#plus').data('page', page);
                    $('#plus').text('Charger plus');
                } else {
                    if (!button.hasClass('no-more-photos')) {
                        button.text('No more photos');
                        button.prop('disabled', true);
                        button.addClass('no-more-photos');
                    }
                }
            }
        });
    }

    $('#filter-category, #filter-format, #filter-date').on('change', function () {
        loadPhotos(1, false);
    });

    $('#plus').on('click', function () {
        var page = $(this).data('page') + 1;
        loadPhotos(page);
    });

    // Lightbox functionality
    $('.fullscreen-icon').on('click', function (event) {
        event.preventDefault();
        let imageUrl = $(this).attr('href');
        let refNumber = $(this).closest('.photo-item').find('.photo-title').data('reference');
        let category = $(this).closest('.photo-item').find('.photo-category').text();
        
        $('#lightbox-image').attr('src', imageUrl);
        $('#lightbox-ref-number').text(refNumber);
        $('#lightbox-category').text(category);
        
        $('#lightbox-overlay').fadeIn();
    });

    $('#lightbox-close, #lightbox-overlay').on('click', function (e) {
        if (e.target.id === 'lightbox-overlay' || e.target.id === 'lightbox-close') {
            $('#lightbox-overlay').fadeOut();
        }
    });

    $('#lightbox-prev').on('click', function () {
        // Logic to show previous image
    });

    $('#lightbox-next').on('click', function () {
        // Logic to show next image
    });

    // Dropdown styling and color changes
    $('select').each(function () {
        var $this = $(this),
            numberOfOptions = $(this).children('option').length;

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
            if ($this.children('option').eq(i).is(':selected')) {
                $('li[rel="' + $this.children('option').eq(i).val() + '"]').addClass('is-selected');
            }
        }

        var $listItems = $list.children('li');

        $styledSelect.click(function (e) {
            e.stopPropagation();
            $('div.select-styled.active').not(this).each(function () {
                $(this).removeClass('active').next('ul.select-options').hide();
            });
            $(this).toggleClass('active').next('ul.select-options').toggle();
        });

        $listItems.click(function (e) {
            e.stopPropagation();
            $styledSelect.text($(this).text()).removeClass('active');
            $this.val($(this).attr('rel'));
            $list.find('li.is-selected').removeClass('is-selected');
            $list.find('li[rel="' + $(this).attr('rel') + '"]').addClass('is-selected');
            $list.hide();
            // Trigger change event to load photos if necessary
            $this.trigger('change');
        });

        $(document).click(function () {
            $styledSelect.removeClass('active');
            $list.hide();
        });
    });

}); // End of document ready function
