<div class="related-photos">
    <h3>VOUS AIMERZ AUSSI</h3>
    <div class="photo-list">
        <?php
        $categories = wp_get_post_terms($post->ID, 'categorie');
        $category_ids = wp_list_pluck($categories, 'term_id');

        $related_photos = new WP_Query(array(
            'post_type' => 'photo',
            'posts_per_page' => 2,
            'post__not_in' => array($post->ID),
            'tax_query' => array(
                array(
                    'taxonomy' => 'categorie',
                    'field' => 'term_id',
                    'terms' => $category_ids,
                ),
            ),
        ));

        if ($related_photos->have_posts()) :
            while ($related_photos->have_posts()) : $related_photos->the_post(); ?>
                <div class="photo-block">
                    <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('large-photo'); ?> 
                    </a>
                </div>
            <?php endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
</div>
