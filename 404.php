<?php
/**
 * The template for displaying 404 pages
 *
 * @package Baffled_Architect
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
    <section class="error-404 not-found">
        <header class="page-header">
            <h1 class="page-title"><?php esc_html_e('404 - Page Not Found', 'baffled-architect'); ?></h1>
        </header>

        <div class="page-content">
            <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try searching?', 'baffled-architect'); ?></p>

            <?php get_search_form(); ?>

            <div class="widget widget_categories">
                <h2 class="widget-title"><?php esc_html_e('Most Used Categories', 'baffled-architect'); ?></h2>
                <ul>
                    <?php
                    wp_list_categories(
                        array(
                            'orderby'    => 'count',
                            'order'      => 'DESC',
                            'show_count' => 1,
                            'title_li'   => '',
                            'number'     => 10,
                        )
                    );
                    ?>
                </ul>
            </div>

            <div class="widget widget_archive">
                <h2 class="widget-title"><?php esc_html_e('Archives', 'baffled-architect'); ?></h2>
                <ul>
                    <?php
                    wp_get_archives(
                        array(
                            'type'  => 'monthly',
                            'limit' => 12,
                        )
                    );
                    ?>
                </ul>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
