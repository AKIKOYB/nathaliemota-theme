<?php
/**
 * Template part for displaying a single photo
 *
 * @package Nathaliemota_Theme
 */

?>

<div class="photo-item">
    <?php if (has_post_thumbnail()) : ?>
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('medium'); ?>
        </a>
    <?php endif; ?>
</div>
