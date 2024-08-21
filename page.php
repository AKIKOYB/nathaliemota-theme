<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 
 */
 get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php
        while ( have_posts() ) :
            the_post();
            the_title( '<h3 class="entry-title">', '</h3>' );
            the_content();
        endwhile;
        ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
