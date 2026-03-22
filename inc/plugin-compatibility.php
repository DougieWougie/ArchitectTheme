<?php
/**
 * Plugin Compatibility
 * Ensures theme works well with common plugins
 *
 * @package Baffled_Architect
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Detect and support common plugins
 */
function baffled_architect_plugin_support() {
    // MathJax support - Add body class for conditional styling
    if (class_exists('MathJax_Latex') || function_exists('mathjax_loader')) {
        add_filter('body_class', function($classes) {
            if (is_singular()) {
                $classes[] = 'has-mathjax';
            }
            return $classes;
        });
    }

    // Prism/Code Syntax Block support
    if (function_exists('code_syntax_block_init') || wp_script_is('prism', 'enqueued')) {
        add_filter('body_class', function($classes) {
            $classes[] = 'has-syntax-highlighting';
            return $classes;
        });
    }

    // Contact Form 7 support
    if (class_exists('WPCF7')) {
        add_theme_support('wpcf7');
    }

    // WooCommerce support (if needed in future)
    if (class_exists('WooCommerce')) {
        add_theme_support('woocommerce');
    }
}
add_action('after_setup_theme', 'baffled_architect_plugin_support');

/**
 * Ensure jQuery compatibility
 * Most theme scripts use vanilla JS, but ensure jQuery doesn't conflict
 */
function baffled_architect_jquery_compatibility() {
    // Only modify on frontend
    if (!is_admin()) {
        // WordPress includes jQuery in no-conflict mode by default
        // This just ensures it's loaded in footer for better performance
        wp_script_add_data('jquery', 'group', 1);
        wp_script_add_data('jquery-core', 'group', 1);
        wp_script_add_data('jquery-migrate', 'group', 1);
    }
}
add_action('wp_enqueue_scripts', 'baffled_architect_jquery_compatibility', 1);
