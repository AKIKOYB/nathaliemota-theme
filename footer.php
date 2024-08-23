<footer class="site-footer">
    <nav class="footer-nav">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'footer',
            'menu_class'     => 'footer-menu',
            'container'      => false,
            'fallback_cb'    => 'wp_page_menu', // debug,Optional fallback
        ));
        ?>
    </nav>
<?php get_template_part('template-parts/modal', 'contact'); ?>
</footer>
<!-- Lightbox Structure -->
    <div id="lightbox-overlay" class="lightbox-overlay" style="display: none;">
        <div id="lightbox-content" class="lightbox-content">
            <button id="lightbox-close" class="lightbox-close">✖</button>
            <button id="lightbox-prev" class="lightbox-prev">← Précédente</button>
            <img id="lightbox-image" src="" alt="Lightbox Image" />
            <div id="lightbox-info" class="lightbox-info">
                <p id="lightbox-ref-number" class="lightbox-ref-number"></p>
                <p id="lightbox-category" class="lightbox-category"></p>
            </div>
            <button id="lightbox-next" class="lightbox-next">Suivante →</button>
        </div>
    </div>
    <?php wp_footer(); ?>
</body>
</html>
