<?php
/**
 * The homepage template file
 *
 * @package Nathaliemota_Theme
 */

get_header();

// Query to get one random photo from the 'photo' custom post type
$args = array(
    'post_type'      => 'photo',
    'posts_per_page' => 1,
    'orderby'        => 'rand' // random
);

$random_photo_query = new WP_Query($args);

// Check if we have a post
if ($random_photo_query->have_posts()) {
    // Get the post data
    $random_photo_query->the_post();
    // Get the featured image URL
    $random_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
} else {
    // Fallback image if no photos are found
    $random_image = get_template_directory_uri() . '/images/default-hero.jpg';
}

// Reset Post Data
wp_reset_postdata();
?>

<!-- Hero Section -->
<div class="hero-section" style="background-image: url('<?php echo esc_url($random_image); ?>');">
    <div class="hero-content">
        <h1>PHOTOGRAPHE EVENT</h1>
    </div>
</div>

<div class="filters">
    <select id="filter-category">
        <option value="">CATÉGORIES</option>
    </select>

    <select id="filter-format">
        <option value="">FORMATS</option>
    </select>

    <select id="filter-date">
        <option value="desc">TRIER PAR</option>
    </select>
</div>

<div class="homepage-content">
    <div class="photo-gallery">
        <?php
        // Query to get photos from the 'photos' custom post type
        $args = array(
            'post_type'      => 'photo', 
            'posts_per_page' => 8, 
        );
        $photo_query = new WP_Query($args);

        if ($photo_query->have_posts()) :
            while ($photo_query->have_posts()) : $photo_query->the_post();
                // Display the photo without running a new query inside the template part
                get_template_part('template-parts/photo_block');
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>No photos found.</p>';
        endif;
        ?>
    </div>
</div>
<div class='plus-section'>
    <button id="plus">Charger plus</button>
</div>

<?php
get_footer();
