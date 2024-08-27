<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Space+Mono&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <header class="header">
        <div class="site-logo">
            <a href="<?php echo home_url('/'); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="Logo">
            </a>
        </div>
        
        <!-- Desktop Menu -->
        <nav class="desktop-menu">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class'     => 'primary-menu',
                'container'      => false,
                'fallback_cb'    => false,
            ));
            ?>
        </nav>

        <!-- Mobile Menu Toggle -->
        <div class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
            <span class="menu-icon">&#9776;</span> <!-- Burger icon -->
        </div>

        <!-- Mobile Menu (moved inside header) -->
        <nav id="primary-menu" class="mobile-menu">
            <button class="close-menu" aria-label="Close Menu">&times;</button>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class'     => 'menu-items',
                'container'      => false,
                'fallback_cb'    => false,
            ));
            ?>
        </nav>
    </header>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var menuToggle = document.querySelector('.menu-toggle');
        var mobileMenu = document.querySelector('.mobile-menu');
        var closeMenu = document.querySelector('.close-menu');

        // Toggle mobile menu open/close
        menuToggle.addEventListener('click', function() {
            mobileMenu.classList.toggle('open');
            // Update aria-expanded to true or false based on the menu state
            var isExpanded = menuToggle.getAttribute('aria-expanded') === 'true' || false;
            menuToggle.setAttribute('aria-expanded', !isExpanded);
        });

        // Close menu button functionality
        closeMenu.addEventListener('click', function() {
            mobileMenu.classList.remove('open');
            menuToggle.setAttribute('aria-expanded', false);
        });
    });
    </script>

    <?php wp_footer(); ?>
</body>
</html>
