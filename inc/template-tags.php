<?php
/**
 * Template Tags
 * Custom template helper functions
 *
 * @package Baffled_Architect
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Display post meta information
 */
function baffled_architect_post_meta() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

    $time_string = sprintf(
        $time_string,
        esc_attr(get_the_date(DATE_W3C)),
        esc_html(get_the_date())
    );

    $posted_on = sprintf(
        esc_html_x('Posted on %s', 'post date', 'baffled-architect'),
        '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
    );

    $byline = sprintf(
        esc_html_x('by %s', 'post author', 'baffled-architect'),
        '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
    );

    echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';
}

/**
 * Display post categories
 */
function baffled_architect_post_categories() {
    $categories_list = get_the_category_list(esc_html__(', ', 'baffled-architect'));
    if ($categories_list) {
        printf(
            '<span class="cat-links">' . esc_html__('Posted in %1$s', 'baffled-architect') . '</span>',
            $categories_list
        );
    }
}

/**
 * Display post tags
 */
function baffled_architect_post_tags() {
    $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'baffled-architect'));
    if ($tags_list) {
        printf(
            '<span class="tags-links">' . esc_html__('Tagged %1$s', 'baffled-architect') . '</span>',
            $tags_list
        );
    }
}

/**
 * Display edit post link
 */
function baffled_architect_edit_post_link() {
    edit_post_link(
        sprintf(
            wp_kses(
                __('Edit <span class="screen-reader-text">%s</span>', 'baffled-architect'),
                array(
                    'span' => array(
                        'class' => array(),
                    ),
                )
            ),
            get_the_title()
        ),
        '<span class="edit-link">',
        '</span>'
    );
}

/**
 * Display comment count
 */
function baffled_architect_comment_count() {
    if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
        echo '<span class="comments-link">';
        comments_popup_link(
            sprintf(
                wp_kses(
                    __('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'baffled-architect'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            )
        );
        echo '</span>';
    }
}

/**
 * Display post thumbnail with responsive handling
 */
function baffled_architect_post_thumbnail() {
    if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
        return;
    }

    if (is_singular()) {
        ?>
        <div class="post-thumbnail">
            <?php the_post_thumbnail('baffled-architect-featured'); ?>
        </div>
        <?php
    } else {
        ?>
        <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
            <?php the_post_thumbnail('baffled-architect-featured'); ?>
        </a>
        <?php
    }
}
