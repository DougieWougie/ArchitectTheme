<?php
/**
 * Enqueue Scripts and Styles
 *
 * @package Baffled_Architect
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue theme styles and scripts
 */
function baffled_architect_enqueue_assets() {
    // Google Fonts
    wp_enqueue_style(
        'baffled-architect-fonts',
        'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Special+Elite&display=swap',
        array(),
        null
    );

    // Main stylesheet (with theme header)
    wp_enqueue_style(
        'baffled-architect-style',
        get_stylesheet_uri(),
        array('baffled-architect-fonts'),
        BAFFLED_ARCHITECT_VERSION
    );

    // Theme base styles
    wp_enqueue_style(
        'baffled-architect-base',
        BAFFLED_ARCHITECT_URI . '/assets/css/theme-base.css',
        array('baffled-architect-style'),
        BAFFLED_ARCHITECT_VERSION
    );

    // Dark mode styles
    wp_enqueue_style(
        'baffled-architect-dark',
        BAFFLED_ARCHITECT_URI . '/assets/css/theme-dark.css',
        array('baffled-architect-base'),
        BAFFLED_ARCHITECT_VERSION
    );

    // Animations
    wp_enqueue_style(
        'baffled-architect-animations',
        BAFFLED_ARCHITECT_URI . '/assets/css/animations.css',
        array('baffled-architect-base'),
        BAFFLED_ARCHITECT_VERSION
    );

    // Responsive styles
    wp_enqueue_style(
        'baffled-architect-responsive',
        BAFFLED_ARCHITECT_URI . '/assets/css/responsive.css',
        array('baffled-architect-base'),
        BAFFLED_ARCHITECT_VERSION
    );

    // Search widget styles
    wp_enqueue_style(
        'baffled-architect-search',
        BAFFLED_ARCHITECT_URI . '/assets/css/search-widget.css',
        array('baffled-architect-base'),
        BAFFLED_ARCHITECT_VERSION
    );

    // 404 page styles
    if (is_404()) {
        wp_enqueue_style(
            'baffled-architect-404',
            BAFFLED_ARCHITECT_URI . '/assets/css/404.css',
            array('baffled-architect-base', 'baffled-architect-animations'),
            BAFFLED_ARCHITECT_VERSION
        );
    }

    // Main theme JavaScript
    wp_enqueue_script(
        'baffled-architect-main',
        BAFFLED_ARCHITECT_URI . '/assets/js/theme.js',
        array(),
        BAFFLED_ARCHITECT_VERSION,
        true
    );

    // Dark mode toggle
    wp_enqueue_script(
        'baffled-architect-dark-mode',
        BAFFLED_ARCHITECT_URI . '/assets/js/dark-mode-toggle.js',
        array(),
        BAFFLED_ARCHITECT_VERSION,
        true
    );

    // Scroll to top
    wp_enqueue_script(
        'baffled-architect-scroll-top',
        BAFFLED_ARCHITECT_URI . '/assets/js/scroll-to-top.js',
        array(),
        BAFFLED_ARCHITECT_VERSION,
        true
    );

    // Animations
    wp_enqueue_script(
        'baffled-architect-animations',
        BAFFLED_ARCHITECT_URI . '/assets/js/animations.js',
        array(),
        BAFFLED_ARCHITECT_VERSION,
        true
    );

    // Navigation
    wp_enqueue_script(
        'baffled-architect-navigation',
        BAFFLED_ARCHITECT_URI . '/assets/js/navigation.js',
        array(),
        BAFFLED_ARCHITECT_VERSION,
        true
    );

    // Search widget
    wp_enqueue_script(
        'baffled-architect-search',
        BAFFLED_ARCHITECT_URI . '/assets/js/search-widget.js',
        array(),
        BAFFLED_ARCHITECT_VERSION,
        true
    );

    // Comments reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'baffled_architect_enqueue_assets');

/**
 * Add inline script for dark mode to prevent FOUC (Flash of Unstyled Content)
 * This must run before any styles are loaded
 */
function baffled_architect_dark_mode_inline() {
    ?>
    <script>
    (function() {
        const theme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', theme);
    })();
    </script>
    <?php
}
add_action('wp_head', 'baffled_architect_dark_mode_inline', 1);

/**
 * Add preconnect for Google Fonts
 */
function baffled_architect_resource_hints($urls, $relation_type) {
    if (wp_style_is('baffled-architect-fonts', 'queue') && 'preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://fonts.googleapis.com',
            'crossorigin',
        );
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }
    return $urls;
}
add_filter('wp_resource_hints', 'baffled_architect_resource_hints', 10, 2);
