<?php wp_footer(); ?>
<footer class="site-footer">
    <nav class="footer-nav">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'footer',
            'menu_class'     => 'footer-menu',
            'container'      => false,
        ));
        ?>
    </nav>
    <?php get_template_part('template-parts/modal', 'contact'); ?>
</footer>
</body>
</html>
