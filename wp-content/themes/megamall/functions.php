<?php

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) exit;

// ---------------------------------------
// 1. Load Parent + Child Theme Styles
// ---------------------------------------
add_action( 'wp_enqueue_scripts', function() {
    // Parent theme stylesheet
    wp_enqueue_style(
        'twentytwentyfive-style',
        get_template_directory_uri() . '/style.css'
    );

    // Child theme stylesheet
    wp_enqueue_style(
        'megamall-style',
        get_stylesheet_directory_uri() . '/style.css',
        ['twentytwentyfive-style'],
        filemtime(get_stylesheet_directory() . '/style.css')
    );
});

// ---------------------------------------
// 2. Theme Supports
// ---------------------------------------
add_action( 'after_setup_theme', function() {

    // Enable block styles
    add_theme_support( 'wp-block-styles' );

    // Editor styles
    add_theme_support( 'editor-styles' );

    // Support for featured images
    add_theme_support( 'post-thumbnails' );

    // Full site editing features
    add_theme_support('appearance-tools');

});
// ---------------------------------------
// 3. CSS
// ---------------------------------------
add_action('wp_enqueue_scripts', function() {

    // Load parent theme styles
    wp_enqueue_style(
        'twentytwentyfive-style',
        get_template_directory_uri() . '/style.css'
    );

    // Load main CSS file for MegaMall
    wp_enqueue_style(
        'megamall-main',
        get_stylesheet_directory_uri() . '/assets/css/main.css',
        ['twentytwentyfive-style'],
        filemtime(get_stylesheet_directory() . '/assets/css/main.css')
    );
});

// ---------------------------------------
// 4. Swiper.js
// ---------------------------------------
add_action('wp_enqueue_scripts', function() {

    // Swiper CSS
    wp_enqueue_style(
        'swiper-css',
        "https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"
    );

    // Swiper JS
    wp_enqueue_script(
        'swiper-js',
        "https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js",
        [],
        null,
        true
    );

});
function allow_svg_uploads_admin_only( $mimes ) {
    if ( current_user_can( 'manage_options' ) ) {
        $mimes['svg'] = 'image/svg+xml';
    }
    return $mimes;
}
add_filter( 'upload_mimes', 'allow_svg_uploads_admin_only' );

register_nav_menus([
    'primary' => __('Primary Menu', 'mega-mall'),
]);
add_action('after_setup_theme', function () {
    register_nav_menus([
        'footer_visitor' => __('Footer Visitor Information', 'mega-mall'),
        'footer_customer' => __('Footer Customer Service', 'mega-mall'),
    ]);
});
add_action('wp_ajax_mm_filter_tenants', 'mm_filter_tenants');
add_action('wp_ajax_nopriv_mm_filter_tenants', 'mm_filter_tenants');

function mm_filter_tenants() {

    $paged    = intval($_POST['page'] ?? 1);
    $search   = sanitize_text_field($_POST['search'] ?? '');
    $category = sanitize_text_field($_POST['category'] ?? '');
    $order    = $_POST['order'] === 'DESC' ? 'DESC' : 'ASC';

    $args = [
        'post_type'      => 'tenant',
        'posts_per_page' => 12,
        'paged'          => $paged,
        's'              => $search,
        'orderby'        => 'title',
        'order'          => $order,
    ];

    if (!empty($category)) {
        $args['tax_query'] = [
            [
                'taxonomy' => 'tenant_category',
                'field'    => 'slug',
                'terms'    => $category,
            ]
        ];
    }

    $query = new WP_Query($args);

    ob_start();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            ?>
            <article class="mm-tenant-card">
                <a href="<?php the_permalink(); ?>">
                    <div class="mm-tenant-image">
                        <?php the_post_thumbnail('medium_large'); ?>
                    </div>
                    <h3 class="mm-tenant-title"><?php the_title(); ?></h3>
                </a>
            </article>
            <?php
        }
    } else {
        echo '<p>No tenants found.</p>';
    }

    wp_reset_postdata();

    wp_send_json([
        'html' => ob_get_clean(),
        'max'  => $query->max_num_pages
    ]);
}
add_action('wp_enqueue_scripts', function () {

    wp_enqueue_script(
        'mm-tenants-ajax',
        get_stylesheet_directory_uri() . '/assets/js/tenants-ajax.js',
        ['jquery'],
        null,
        true
    );

    wp_localize_script('mm-tenants-ajax', 'mmTenants', [
        'ajaxurl' => admin_url('admin-ajax.php'),
    ]);
});
add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
});
function allow_ico_uploads($mimes) {
    $mimes['ico'] = 'image/x-icon';
    return $mimes;
}
add_filter('upload_mimes', 'allow_ico_uploads');
