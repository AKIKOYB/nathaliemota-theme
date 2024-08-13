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
 <!-- content 
    <div class="footer-links">
        <a href="<?php echo esc_url(home_url('/mentions-legales')); ?>">MENTIONS LÉGALES</a>
        <a href="<?php echo esc_url(get_privacy_policy_url()); ?>">VIE PRIVÉE</a>
        <a>TOUS DROITS RÉSERVÉS</a>
    </div>-->
    <?php get_template_part('template-parts/modal', 'contact'); ?>
</footer>
</body>
</html>
