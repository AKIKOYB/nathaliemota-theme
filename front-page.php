<?php
/**
 * The homepage template file
 *
 * @package Nathaliemota_Theme
 */

get_header();
?>
<div class="homepage-content">
    <h1>Welcome to Nathalie Mota's Photography</h1>

    <div class="photo-gallery">
        <?php
        // Query to get photos from the 'photos' custom post type
        $args = array(
            'post_type' => 'photos', // Adjust this to your custom post type slug
            'posts_per_page' => 6, // Adjust the number of photos to display
        );
        $photo_query = new WP_Query($args);

        if ($photo_query->have_posts()) :
            while ($photo_query->have_posts()) : $photo_query->the_post();
                // Include the photo_block template part
                get_template_part('template-parts/photo_block');
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>No photos found.</p>';
        endif;
        ?>
    </div>
</div>

<?php
get_footer();