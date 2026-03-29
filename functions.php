<?php
/**
 * Baffled Architect Theme Functions
 *
 * @package Baffled_Architect
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define theme constants
define('BAFFLED_ARCHITECT_VERSION', '1.7.1');
define('BAFFLED_ARCHITECT_DIR', get_template_directory());
define('BAFFLED_ARCHITECT_URI', get_template_directory_uri());

// Set content width for embedded content
if (!isset($content_width)) {
    $content_width = 720;
}

// Load theme files
require_once BAFFLED_ARCHITECT_DIR . '/inc/theme-setup.php';
require_once BAFFLED_ARCHITECT_DIR . '/inc/enqueue-scripts.php';
require_once BAFFLED_ARCHITECT_DIR . '/inc/custom-functions.php';
require_once BAFFLED_ARCHITECT_DIR . '/inc/plugin-compatibility.php';
require_once BAFFLED_ARCHITECT_DIR . '/inc/template-tags.php';
