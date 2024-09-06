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

    // debug, not twice. custom scripts with jQuery
    //wp_enqueue_script('theme-scripts', get_template_directory_uri() . '/js/script.js', array('jquery'), null, true);

    // Enqueue AJAX script and provide the AJAX URL
    wp_enqueue_script('nathaliemota-ajax', get_template_directory_uri() . '/js/script.js', array('jquery'), null, true);
    
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
// functions.php

function load_more_photos_ajax() {
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
    $format = isset($_POST['format']) ? sanitize_text_field($_POST['format']) : '';
    $order = isset($_POST['order']) ? sanitize_text_field($_POST['order']) : 'desc';

    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'paged' => $page,
        'orderby' => 'date',
        'order' => $order,
    );

    if (!empty($category)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'categorie',
            'field'    => 'slug',
            'terms'    => $category,
        );
    }

    if (!empty($format)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'format',
            'field'    => 'slug',
            'terms'    => $format,
        );
    }

    // Query to get the total number of photos
    $total_photos_query = new WP_Query(array_merge($args, ['posts_per_page' => -1]));
    $total_photos = $total_photos_query->found_posts;
    $total_pages = ceil($total_photos / 8); // Calculate total number of pages

    $photo_query = new WP_Query($args);

    if ($photo_query->have_posts()) :
        while ($photo_query->have_posts()) : $photo_query->the_post();
            get_template_part('template-parts/photo_block');
        endwhile;
        wp_reset_postdata();
    endif;

    // Include total pages in the response
    echo '<div class="total-pages" data-total-pages="' . esc_attr($total_pages) . '"></div>';

    wp_die();
}

add_action('wp_ajax_load_more_photos', 'load_more_photos_ajax');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos_ajax');

// AJAX handler to dynamically load categories and formats even after the changes
function load_filters_terms() {
    // Get categories
    $categories = get_terms('categorie');
    $formats = get_terms('format');
    
    $response = [
        'categories' => [],
        'formats' => []
    ];

    // Prepare categories
    if (!empty($categories) && !is_wp_error($categories)) {
        foreach ($categories as $category) {
            $response['categories'][] = [
                'slug' => $category->slug,
                'name' => $category->name,
            ];
        }
    }

    // Prepare formats
    if (!empty($formats) && !is_wp_error($formats)) {
        foreach ($formats as $format) {
            $response['formats'][] = [
                'slug' => $format->slug,
                'name' => $format->name,
            ];
        }
    }

    wp_send_json($response);
}

add_action('wp_ajax_load_filters_terms', 'load_filters_terms');
add_action('wp_ajax_nopriv_load_filters_terms', 'load_filters_terms');

// Function to loop through posts when at the last or first post
function get_adjacent_post_link_loop($in_same_term = false, $excluded_terms = '', $previous = true, $taxonomy = 'category') {
    if ($previous && is_single()) {
        $post = get_previous_post($in_same_term, $excluded_terms, $taxonomy);
    } else {
        $post = get_next_post($in_same_term, $excluded_terms, $taxonomy);
    }

    if (!$post) {
        // No adjacent post, so loop to the other end
        $args = array(
            'posts_per_page' => 1,
            'order' => $previous ? 'DESC' : 'ASC',
            'post_type' => get_post_type(),
            'post_status' => 'publish'
        );

        $posts = get_posts($args);

        if ($posts) {
            $post = $posts[0];
        } else {
            return null; // No posts found, return null
        }
    }

    return $post;
}