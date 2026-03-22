<?php
/**
 * The template for displaying search results
 *
 * @package Baffled_Architect
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php if (have_posts()) : ?>

        <header class="page-header">
            <h1 class="page-title">
                <?php
                printf(
                    esc_html__('Search Results for: %s', 'baffled-architect'),
                    '<span>' . get_search_query() . '</span>'
                );
                ?>
            </h1>
        </header>

        <div class="posts-container">
            <?php
            while (have_posts()) :
                the_post();
                get_template_part('template-parts/content', 'search');
            endwhile;
            ?>
        </div>

        <?php baffled_architect_pagination(); ?>

    <?php else : ?>

        <?php get_template_part('template-parts/content', 'none'); ?>

    <?php endif; ?>
</main>

<?php
get_sidebar();
get_footer();
