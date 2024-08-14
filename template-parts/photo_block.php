<?php
/**
 * Template part for displaying a photo block
 *
 * @package Nathaliemota_Theme
 */

// Assuming you're using ACF (Advanced Custom Fields) to get custom field values
$photo_title = get_the_title();
$photo_reference = get_field('reference');
$photo_year = get_field('year');
$photo_format = get_field('format');
$photo_type = get_field('type');
$photo_category = get_the_terms(get_the_ID(), 'category'); // Replace 'category' with your actual taxonomy if different

?>

<div class="photo-block">
    <div class="photo-image">
        <?php if (has_post_thumbnail()) : ?>
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('medium'); // Adjust the size as needed ?>
            </a>
        <?php endif; ?>
    </div>
    <div class="photo-details">
        <h3 class="photo-title"><?php echo esc_html($photo_title); ?></h3>
        <p class="photo-reference"><?php echo esc_html($photo_reference); ?></p>
        <p class="photo-year"><?php echo esc_html($photo_year); ?></p>
        <p class="photo-format"><?php echo esc_html($photo_format); ?></p>
        <p class="photo-type"><?php echo esc_html($photo_type); ?></p>
        <p class="photo-category">
            <?php
            if ($photo_category && !is_wp_error($photo_category)) {
                foreach ($photo_category as $category) {
                    echo esc_html($category->name) . ' ';
                }
            }
            ?>
        </p>
    </div>
</div>
