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

    // Dark mode extras (colours themselves live in theme-base.css)
    wp_enqueue_style(
        'baffled-architect-dark',
        BAFFLED_ARCHITECT_URI . '/assets/css/theme-dark.css',
        array('baffled-architect-base', 'prism-theme', 'prism-line-numbers'),
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

    // Cookie banner styles
    wp_enqueue_style(
        'baffled-architect-cookie-banner',
        BAFFLED_ARCHITECT_URI . '/assets/css/cookie-banner.css',
        array('baffled-architect-base'),
        BAFFLED_ARCHITECT_VERSION
    );

    // Gutenberg block styles
    wp_enqueue_style(
        'baffled-architect-blocks',
        BAFFLED_ARCHITECT_URI . '/assets/css/blocks.css',
        array('baffled-architect-base'),
        BAFFLED_ARCHITECT_VERSION
    );

    // Prism.js syntax colours - the theme's own stylesheet, driven by the
    // --code-* tokens so it follows light and dark mode
    wp_enqueue_style(
        'prism-theme',
        BAFFLED_ARCHITECT_URI . '/assets/css/prism-theme.css',
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

    // Cookie banner
    wp_enqueue_script(
        'baffled-architect-cookie-banner',
        BAFFLED_ARCHITECT_URI . '/assets/js/cookie-banner.js',
        array(),
        BAFFLED_ARCHITECT_VERSION,
        true
    );

    // Prism.js core
    wp_enqueue_script(
        'prism-core',
        'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js',
        array(),
        '1.29.0',
        true
    );

    // Prism.js Autoloader plugin - lazy-loads language grammars
    wp_enqueue_script(
        'prism-autoloader',
        'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/autoloader/prism-autoloader.min.js',
        array('prism-core'),
        '1.29.0',
        true
    );

    // Prism.js Toolbar plugin (required by Copy to Clipboard)
    wp_enqueue_style(
        'prism-toolbar',
        'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/toolbar/prism-toolbar.min.css',
        array('prism-theme'),
        '1.29.0'
    );

    wp_enqueue_script(
        'prism-toolbar',
        'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/toolbar/prism-toolbar.min.js',
        array('prism-core'),
        '1.29.0',
        true
    );

    // Prism.js Line Numbers plugin - add the `line-numbers` class to a code block
    wp_enqueue_style(
        'prism-line-numbers',
        'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/line-numbers/prism-line-numbers.min.css',
        array('prism-theme'),
        '1.29.0'
    );

    wp_enqueue_script(
        'prism-line-numbers',
        'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/line-numbers/prism-line-numbers.min.js',
        array('prism-core'),
        '1.29.0',
        true
    );

    // Prism.js Copy to Clipboard plugin
    wp_enqueue_script(
        'prism-copy-to-clipboard',
        'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js',
        array('prism-toolbar'),
        '1.29.0',
        true
    );

    // Comments reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'baffled_architect_enqueue_assets');

/**
 * Resolve the colour theme before first paint to prevent a flash.
 *
 * Sets two attributes on <html>:
 *   data-theme-mode  the visitor's choice: auto | light | dark
 *   data-theme       the theme actually shown: light | dark
 * "auto" (nothing saved) follows the OS preference. Keep this logic in step
 * with assets/js/dark-mode-toggle.js.
 */
function baffled_architect_dark_mode_inline() {
    ?>
    <meta name="color-scheme" content="light dark">
    <script>
    (function() {
        var mode = 'auto';
        try {
            var saved = localStorage.getItem('theme');
            if (saved === 'light' || saved === 'dark') {
                mode = saved;
            }
        } catch (e) {}
        var theme = mode;
        if (mode === 'auto') {
            theme = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        }
        var root = document.documentElement;
        root.setAttribute('data-theme-mode', mode);
        root.setAttribute('data-theme', theme);
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
    if (wp_script_is('prism-core', 'queue') && 'preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://cdnjs.cloudflare.com',
            'crossorigin',
        );
    }
    return $urls;
}
add_filter('wp_resource_hints', 'baffled_architect_resource_hints', 10, 2);
