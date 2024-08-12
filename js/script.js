jQuery(document).ready(function($) {
    // Get the modal
    var modal = $('#contact-modal');

    // Get the button that opens the modal
    var btn = $('.contact-menu-item a');

    // Get the <span> element that closes the modal
    var span = $('.close-btn');

    // When the user clicks on the button, open the modal
    btn.on('click', function(event) {
        event.preventDefault(); // Prevent default link behavior
        modal.show();
    });

    // When the user clicks on <span> (x), close the modal
    span.on('click', function() {
        modal.hide();
    });

    // When the user clicks anywhere outside of the modal, close it
    $(window).on('click', function(event) {
        if ($(event.target).is(modal)) {
            modal.hide();
        }
    });
});
