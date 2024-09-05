<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
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

        <!-- Close Menu Button -->
        <button class="close-menu" aria-label="Close Menu">&times;</button>

        <!-- Mobile Menu -->
        <nav id="primary-menu" class="mobile-menu">
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
            var header = document.querySelector('.header'); // slide in doesnt work yet

            function toggleMenu() {
                var isMenuOpen = mobileMenu.classList.toggle('open');
                header.classList.toggle('open', isMenuOpen); // Toggle the open class for the header
                menuToggle.style.display = isMenuOpen ? 'none' : 'block';
                closeMenu.style.display = isMenuOpen ? 'block' : 'none';
                menuToggle.setAttribute('aria-expanded', isMenuOpen);
            }

            menuToggle.addEventListener('click', toggleMenu);
            closeMenu.addEventListener('click', toggleMenu);

            // Ensure correct initial visibility on load
            function updateMenuVisibility() {
                if (window.innerWidth <= 768) {
                    menuToggle.style.display = 'block';
                    closeMenu.style.display = 'none';
                } else {
                    menuToggle.style.display = 'none';
                    closeMenu.style.display = 'none';
                }
            }

            updateMenuVisibility();
            window.addEventListener('resize', updateMenuVisibility);
        });
</script>

    <?php wp_footer(); ?>
</body>
</html>
