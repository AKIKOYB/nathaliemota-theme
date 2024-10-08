<?php
/**
 * Template part for displaying a list of photos
 *
 * @package Nathaliemota_Theme
 */
$photo_title = get_the_title();
$photo_category = get_the_terms(get_the_ID(), 'categorie'); 
$photo_reference = get_post_meta(get_the_ID(), 'reference', true);
?>

<div class="photo-item" data-reference="<?php echo esc_attr($photo_reference); ?>" data-category="<?php echo esc_attr($photo_category[0]->name); ?>">
    <?php if (has_post_thumbnail()) : ?>
        <div class="photo-image">
            <a href="<?php the_permalink(); ?>" class="photo-link">
                <?php the_post_thumbnail('full'); ?>
                <div class="photo-overlay">
                    <div class="photo-icons">
                        <a href="<?php the_permalink(); ?>" class="info-icon" title="Voir les détails">
                        </a>
                        <a href="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" 
                           class="fullscreen-icon" data-ref-number="<?php echo esc_html(get_post_meta(get_the_ID(), 'reference', true)); ?>" 
                            data-category="
                            <?php
                                if ($photo_category && !is_wp_error($photo_category)) {
                                    foreach ($photo_category as $category) {
                                        echo esc_html($category->name);
                                    }
                                }
                            ?>
                            " title="Plein écran">
                        </a>
                    </div>
                    <div class="photo-details">
                        <p class="photo-title"><?php echo esc_html($photo_title); ?></p>
                        <p class="photo-category"><?php
                            if ($photo_category && !is_wp_error($photo_category)) {
                                foreach ($photo_category as $category) {
                                    echo esc_html($category->name);
                                }
                            }
                            ?></p>
                    </div>
                </div>
            </a>
        </div>
    <?php endif; ?>
</div>