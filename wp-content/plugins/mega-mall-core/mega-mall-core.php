<?php
/**
 * Plugin Name: Mega Mall Core
 * Description: Core functionality for Mega Mall (CPTs, Taxonomies, Meta, Gutenberg blocks, Settings).
 * Version: 1.0
 * Author: Kashif Iqbal
 * Text Domain: mega-mall
 */

if ( ! defined( 'ABSPATH' ) ) exit; // No direct access

class MegaMallCore {

    public function __construct() {
        // Register CPTs
        add_action('init', [$this, 'register_cpt_tenants']);
        add_action('init', [$this, 'register_cpt_offers']);
        add_action('init', [$this, 'register_cpt_events']);
        add_action('init', [$this, 'register_cpt_services']);

        // Register taxonomies
        add_action('init', [$this, 'register_tax_tenant_category']);

        // Activate plugin
        register_activation_hook(__FILE__, [$this, 'flush_rewrite']);

        // Blocks
    // Register all Gutenberg blocks in ONE init action
        add_action('init', function() {

            // Debug
            error_log("MM: unified block loader running");

            // Load compiled JS bundle
            if ( file_exists(__DIR__ . '/build/index.asset.php') ) {
                $asset = include __DIR__ . '/build/index.asset.php';

                wp_register_script(
                    'megamall-blocks',
                    plugins_url('build/index.js', __FILE__),
                    $asset['dependencies'],
                    $asset['version']
                );

                error_log("MM: block JS registered");
            } else {
                error_log("MM: index.asset.php missing");
            }

            // Register each block ONCE
            register_block_type(__DIR__ . '/blocks/tenant-grid');
            //register_block_type(__DIR__ . '/blocks/tenant-details');
            register_block_type_from_metadata(
                __DIR__ . '/blocks/hero-slider/block.json',
                [
                    'editor_script' => 'megamall-blocks',
                    'render_callback' => function ($attributes, $content, $block) {
                        ob_start();
                        require __DIR__ . '/blocks/hero-slider/render.php';
                        return ob_get_clean();
                    }
                ]
            );
            add_action('init', function () {
                register_block_type_from_metadata(
                    __DIR__ . '/blocks/tenant-grid/block.json',
                    [
                        'render_callback' => function ($attributes) {
                            ob_start();
                            require __DIR__ . '/blocks/tenant-grid/render.php';
                            return ob_get_clean();
                        }
                    ]
                );
            });




            //error_log("MM: all blocks registered");
        });

        // add_action('init', function () {
        //     $registry = WP_Block_Type_Registry::get_instance();
        //     $block = $registry->get_registered('megamall/hero-slider');

        //     if ($block) {
        //         error_log('MM DEBUG: hero-slider registered');
        //         error_log('MM DEBUG: render_callback = ' . (is_callable($block->render_callback) ? 'YES' : 'NO'));
        //     } else {
        //         error_log('MM DEBUG: hero-slider NOT registered');
        //     }
        // });







        add_action('acf/init', [$this, 'register_options_page']);

    }

    // ===============================
    // ACF OPTIONS PAGE

    public function register_options_page() {
    if( function_exists('acf_add_options_page') ) {
        acf_add_options_page([
            'page_title' => 'Mall Settings',
            'menu_title' => 'Mall Settings',
            'menu_slug'  => 'mall-settings',
            'capability' => 'manage_options',
            'redirect'   => false
        ]);
    }
    }


    // ===============================
    // TENANT CPT
    // ===============================
    public function register_cpt_tenants() {
        $labels = [
            'name' => 'Tenants',
            'singular_name' => 'Tenant',
        ];

        $args = [
            'labels' => $labels,
            'public' => true,
            'menu_icon' => 'dashicons-store',
            'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
            'has_archive' => true,
            'rewrite' => ['slug' => 'shops'],
            'show_in_rest' => true,
            'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        ];

        register_post_type('tenant', $args);
    }

    // ===============================
    // OFFERS CPT
    // ===============================
    public function register_cpt_offers() {
        $labels = [
            'name' => 'Offers',
            'singular_name' => 'Offer',
        ];

        $args = [
            'labels' => $labels,
            'public' => true,
            'menu_icon' => 'dashicons-tag',
            'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
            'has_archive' => true,
            'rewrite' => ['slug' => 'offers'],
            'show_in_rest' => true,
            'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        ];

        register_post_type('offer', $args);
    }

    // ===============================
    // EVENTS CPT
    // ===============================
    public function register_cpt_events() {
        $labels = [
            'name' => 'Events',
            'singular_name' => 'Event',
        ];

        $args = [
            'labels' => $labels,
            'public' => true,
            'menu_icon' => 'dashicons-calendar',
            'supports' => ['title', 'editor', 'thumbnail'],
            'has_archive' => true,
            'rewrite' => ['slug' => 'events'],
            'show_in_rest' => true,
            'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        ];

        register_post_type('event', $args);
    }

    // ===============================
    // SERVICES CPT
    // ===============================
    public function register_cpt_services() {
        $labels = [
            'name' => 'Services',
            'singular_name' => 'Service',
        ];

        $args = [
            'labels' => $labels,
            'public' => true,
            'menu_icon' => 'dashicons-admin-tools',
            'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
            'has_archive' => true,
            'rewrite' => ['slug' => 'services'],
            'show_in_rest' => true,
            'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        ];

        register_post_type('service', $args);
    }

    // ===============================
    // TENANT CATEGORY TAXONOMY
    // ===============================
    public function register_tax_tenant_category() {

        $labels = [
            'name' => 'Tenant Categories',
            'singular_name' => 'Tenant Category',
        ];

        $args = [
            'hierarchical' => true,
            'labels' => $labels,
            'public' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'rewrite' => ['slug' => 'tenant-category'],
            'show_in_rest' => true,
            'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        ];

        register_taxonomy('tenant_category', ['tenant'], $args);
    }

    // ===============================
    // FLUSH REWRITE RULES ON ACTIVATE
    // ===============================
    public function flush_rewrite() {
        $this->register_cpt_tenants();
        $this->register_cpt_offers();
        $this->register_cpt_events();
        $this->register_cpt_services();
        $this->register_tax_tenant_category();
        flush_rewrite_rules();
    }
}

new MegaMallCore();
