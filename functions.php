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
    
}
add_action('wp_enqueue_scripts', 'nathaliemota_enqueue_scripts');

// photo size for related-photos.php
add_image_size('large-photo', 564, 495, true); // 564px by 495px with cropping
