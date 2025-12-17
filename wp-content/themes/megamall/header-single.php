<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header class="mm-header single_tenant_header">
    <div class="mm-header-inner">

        <!-- LOGO (LEFT) -->
        <div class="mm-header-logo">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo_mega_colored.png" alt="MegaMall Logo">
            </a>
        </div>

        <!-- NAVIGATION (CENTER DESKTOP / RIGHT MOBILE) -->
        <nav class="mm-header-nav" id="mmHeaderNav">
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'mm-menu',
                'fallback_cb'    => false
            ]);
            ?>
        </nav>

        <!-- SEARCH ICON (RIGHT DESKTOP ONLY) -->
        <div class="mm-header-search">
            <button type="button" aria-label="Search">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/search_icon_dark.svg" alt="Search Icon">
            </button>
        </div>

        <!-- MOBILE TOGGLE -->
        <button class="mm-menu-toggle" aria-label="Menu" aria-expanded="false">
            ☰
        </button>

    </div>
</header>
