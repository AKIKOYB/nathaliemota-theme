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
