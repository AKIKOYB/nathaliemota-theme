<?php get_header(); ?>
<div class="photo-page-wrapper">
    <div class="photo-info">
        <h2><?php the_title(); ?></h2>
        <div class="photo-meta">
            <p>Référence: <?php the_field('reference'); ?></p>
            <!-- Catégorie without <a> tags --> <!--ex<p>Catégorie: <?php the_terms($post->ID, 'categorie'); ?></p>-->
            <?php 
            $categories = get_the_terms($post->ID, 'categorie');
            if ($categories && !is_wp_error($categories)) {
                $category_names = array();
                foreach ($categories as $category) {
                    $category_names[] = $category->name;
                }
                echo '<p>Catégorie: ' . implode(', ', $category_names) . '</p>';
            } else {
                echo '<p>Catégorie: None</p>';
            }
            ?>
            <!-- Format without <a> tags --> <!--ex<p>Format: <?php the_terms($post->ID, 'format'); ?></p>-->
            <?php 
                $formats = get_the_terms($post->ID, 'format');
                if ($formats && !is_wp_error($formats)) {
                    $format_names = array();
                    foreach ($formats as $format) {
                        $format_names[] = $format->name;
                    }
                    echo '<p>Format: ' . implode(', ', $format_names) . '</p>';
                } else {
                    echo '<p>Format: None</p>';
                }
                ?>        
            <p>Type: <?php the_field('type'); ?></p>
            <!-- Année without <a> tags --><!--<p>Année: <?php the_terms($post->ID,'annee'); ?></p> -->
            <?php 
            $annees = get_the_terms($post->ID, 'annee');
            if ($annees && !is_wp_error($annees)) {
                $annee_names = array();
                foreach ($annees as $annee) {
                    $annee_names[] = $annee->name;
                }
                echo '<p>Année: ' . implode(', ', $annee_names) . '</p>';
            } else {
                echo '<p>Année: None</p>';
            }
            ?>
        </div>
    </div>

    <div class="photo-display">
        <div class="photo-image">
            <?php the_post_thumbnail('full'); ?>
        </div>
    </div>
</div>

<div class="photo-interactions">
    <div class="contact-navigation">
        <div class="contact-section">
            <p>Cette photo vous intéresse ?</p>
            <button id="contact-btn" data-ref="<?php the_field('reference'); ?>">Contact</button>
        </div>
        <div class="navigation-links">
            <?php
            // Get next post
            $next_post = get_next_post();
            if ($next_post) : ?>
                <div class="nav-thumbnail">
                    <a href="<?php echo get_permalink($next_post->ID); ?>">
                        <img src="<?php echo get_the_post_thumbnail_url($next_post->ID, array(81, 71)); ?>" alt="Next Photo">
                    </a>
                </div>

                <div class="nav-arrows">
                    <?php
                    // Get previous post
                    $prev_post = get_previous_post();
                    if ($prev_post) : ?>
                        <a href="<?php echo get_permalink($prev_post->ID); ?>" class="prev-arrow">
                            <span>←</span>
                        </a>
                    <?php endif; ?>

                    <a href="<?php echo get_permalink($next_post->ID); ?>" class="next-arrow">
                        <span>→</span>
                    </a>
                </div>
            <?php endif; ?>
        </div> 
    </div> 
</div>

<?php get_template_part('template-parts/related-photos'); ?>
<?php get_footer(); ?>
