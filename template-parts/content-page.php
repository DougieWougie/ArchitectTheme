<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php baffled_architect_post_thumbnail(); ?>

    <header class="entry-header animate-on-scroll animate-fade-in">
        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
    </header>

    <div class="entry-content animate-on-scroll animate-fade-in">
        <?php
        the_content();

        wp_link_pages(
            array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'baffled-architect'),
                'after'  => '</div>',
            )
        );
        ?>
    </div>

    <?php if (get_edit_post_link()) : ?>
        <footer class="entry-footer">
            <?php baffled_architect_edit_post_link(); ?>
        </footer>
    <?php endif; ?>
</article>
