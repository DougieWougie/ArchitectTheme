<?php
/**
 * Custom Helper Functions
 *
 * @package Baffled_Architect
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Custom excerpt length
 */
function baffled_architect_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'baffled_architect_excerpt_length');

/**
 * Custom excerpt more text
 */
function baffled_architect_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'baffled_architect_excerpt_more');

/**
 * Estimated reading time
 */
function baffled_architect_reading_time() {
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // Average reading speed: 200 words per minute

    if ($reading_time === 1) {
        $timer = ' minute';
    } else {
        $timer = ' minutes';
    }

    return $reading_time . $timer;
}

/**
 * Get social sharing links
 */
function baffled_architect_social_sharing() {
    $post_url = urlencode(get_permalink());
    $post_title = urlencode(get_the_title());

    $twitter_url = 'https://twitter.com/intent/tweet?url=' . $post_url . '&text=' . $post_title;
    $facebook_url = 'https://www.facebook.com/sharer/sharer.php?u=' . $post_url;
    $linkedin_url = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $post_url . '&title=' . $post_title;

    echo '<div class="social-sharing">';
    echo '<a href="' . esc_url($twitter_url) . '" target="_blank" rel="noopener noreferrer" class="share-twitter">Twitter</a>';
    echo '<a href="' . esc_url($facebook_url) . '" target="_blank" rel="noopener noreferrer" class="share-facebook">Facebook</a>';
    echo '<a href="' . esc_url($linkedin_url) . '" target="_blank" rel="noopener noreferrer" class="share-linkedin">LinkedIn</a>';
    echo '</div>';
}

/**
 * Pagination for archive pages
 */
function baffled_architect_pagination() {
    if ($GLOBALS['wp_query']->max_num_pages <= 1) {
        return;
    }

    $args = array(
        'mid_size'           => 2,
        'prev_text'          => __('&larr; Previous', 'baffled-architect'),
        'next_text'          => __('Next &rarr;', 'baffled-architect'),
        'screen_reader_text' => __('Posts navigation', 'baffled-architect'),
    );

    echo '<nav class="pagination" role="navigation">';
    echo paginate_links($args);
    echo '</nav>';
}

/**
 * Post navigation for single posts
 */
function baffled_architect_post_navigation() {
    $prev_post = get_previous_post();
    $next_post = get_next_post();

    if (!$prev_post && !$next_post) {
        return;
    }

    echo '<nav class="post-navigation" role="navigation">';
    echo '<div class="nav-links">';

    if ($prev_post) {
        echo '<div class="nav-previous">';
        echo '<a href="' . esc_url(get_permalink($prev_post->ID)) . '" rel="prev">';
        echo '<span class="nav-icon">←</span>';
        echo '<span class="nav-subtitle">' . esc_html__('Previous Post', 'baffled-architect') . '</span>';
        echo '<span class="nav-title">' . esc_html(get_the_title($prev_post->ID)) . '</span>';
        echo '</a>';
        echo '</div>';
    }

    if ($next_post) {
        echo '<div class="nav-next">';
        echo '<a href="' . esc_url(get_permalink($next_post->ID)) . '" rel="next">';
        echo '<span class="nav-subtitle">' . esc_html__('Next Post', 'baffled-architect') . '</span>';
        echo '<span class="nav-title">' . esc_html(get_the_title($next_post->ID)) . '</span>';
        echo '<span class="nav-icon">→</span>';
        echo '</a>';
        echo '</div>';
    }

    echo '</div>';
    echo '</nav>';
}
