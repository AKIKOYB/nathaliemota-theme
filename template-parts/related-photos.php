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
            while ($related_photos->have_posts()) : $related_photos->the_post();
                $photo_title = get_the_title();
                $photo_category = get_the_terms(get_the_ID(), 'categorie');
                $photo_reference = get_post_meta(get_the_ID(), 'reference', true);
                ?>
                <div class="photo-block" data-reference="<?php echo esc_attr($photo_reference); ?>" data-category="<?php echo esc_attr($photo_category[0]->name); ?>">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="photo-image">
                            <?php the_post_thumbnail('large-photo'); ?>
                            <div class="photo-overlay">
                                <div class="photo-icons">
                                    <a href="<?php the_permalink(); ?>" class="info-icon" title="Voir les détails">
                                        <!-- Info icon -->
                                    </a>
                                    <a href="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" 
                                       class="fullscreen-icon" 
                                       data-ref-number="<?php echo esc_html($photo_reference); ?>" 
                                       data-category="
                                        <?php
                                            if ($photo_category && !is_wp_error($photo_category)) {
                                                foreach ($photo_category as $category) {
                                                    echo esc_html($category->name);
                                                }
                                            }
                                        ?>
                                       " 
                                       title="Plein écran">
                                        <!-- Fullscreen icon  -->
                                    </a>
                                </div>
                                <div class="photo-details">
                                    <p class="photo-title"><?php echo esc_html($photo_title); ?></p>
                                    <p class="photo-category">
                                        <?php
                                        if ($photo_category && !is_wp_error($photo_category)) {
                                            foreach ($photo_category as $category) {
                                                echo esc_html($category->name);
                                            }
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
</div>
