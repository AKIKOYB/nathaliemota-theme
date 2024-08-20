<?php
function nathaliemota_theme_setup() {
    // Add support for custom logo
    add_theme_support('custom-logo');
    
    // Add support for menus
    add_theme_support('menus');

    // Add support for post thumbnails
    add_theme_support('post-thumbnails');

    // Add support for the title tag
    add_theme_support('title-tag');

    // Register a primary and footer menu locations
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'nathaliemota-theme'),
        'footer'  => __('Footer Menu', 'nathaliemota-theme'),
    ));
}
add_action('after_setup_theme', 'nathaliemota_theme_setup');

function nathaliemota_enqueue_scripts() {
    // Enqueue the main stylesheet
    wp_enqueue_style('theme-style', get_stylesheet_uri());

    // Enqueue custom scripts with jQuery as a dependency
    wp_enqueue_script('theme-scripts', get_template_directory_uri() . '/js/script.js', array('jquery'), null, true);

    // Enqueue AJAX script and provide the AJAX URL
    wp_enqueue_script('nathaliemota-ajax', get_template_directory_uri() . '/js/scripts.js', array('jquery'), null, true);
    
    // Localize script to pass AJAX URL
    wp_localize_script('nathaliemota-ajax', 'nathaliemota_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
    
    // Enqueue the lightbox script
    wp_enqueue_script('lightbox-js', get_template_directory_uri() . '/js/lightbox.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'nathaliemota_enqueue_scripts');

// photo size for related-photos.php
add_image_size('large-photo', 564, 495, true); // 564px by 495px with cropping

// AJAX handler for loading more photos
function load_more_photos() {
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;

    $args = array(
        'post_type'      => 'photo',
        'posts_per_page' => 8,
        'paged'          => $paged,
    );

    $photo_query = new WP_Query($args);

    if ($photo_query->have_posts()) :
        while ($photo_query->have_posts()) : $photo_query->the_post();
            get_template_part('template-parts/photo_block');
        endwhile;
        wp_reset_postdata();
    else :
        echo '<p>No more photos found.</p>';
    endif;

    wp_die(); // Stop the script
}

add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');
