<?php
/**
 * The template for displaying single posts
 *
 * @package Baffled_Architect
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php
    while (have_posts()) :
        the_post();
        get_template_part('template-parts/content', 'single');

        baffled_architect_post_navigation();

        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;
    endwhile;
    ?>
</main>

<?php
get_sidebar();
get_footer();
