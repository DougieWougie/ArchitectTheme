<?php
/**
 * The main template file
 *
 * @package Baffled_Architect
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php if (have_posts()) : ?>

        <?php if (is_home() && !is_front_page()) : ?>
            <header class="page-header">
                <h1 class="page-title"><?php single_post_title(); ?></h1>
            </header>
        <?php endif; ?>

        <div class="posts-container">
            <?php
            while (have_posts()) :
                the_post();
                get_template_part('template-parts/content', get_post_type());
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
