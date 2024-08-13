<!DOCTYPE html>
<html lang = "fr-FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <header class = "header" >
        <div class="site-logo">
            <a href="<?php echo home_url('/'); ?>">
            <img src="<?php echo get_template_directory_uri(); ?> /img/logo.svg" alt="Logo">
            </a>​​  
        </div>
        <nav>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class'     => 'primary-menu',
                'container'      => false,
            ));
            ?>
        </nav>
    </header>