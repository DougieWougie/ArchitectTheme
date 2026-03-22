<article id="post-<?php the_ID(); ?>" <?php post_class('post-card animate-on-scroll animate-fade-in-up hover-lift'); ?>>
    <?php baffled_architect_post_thumbnail(); ?>

    <header class="entry-header">
        <?php
        if (is_singular()) {
            the_title('<h1 class="entry-title">', '</h1>');
        } else {
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
        }
        ?>

        <?php if ('post' === get_post_type()) : ?>
            <div class="entry-meta">
                <?php
                baffled_architect_post_meta();
                baffled_architect_comment_count();
                ?>
            </div>
        <?php endif; ?>
    </header>

    <div class="entry-content">
        <?php
        the_excerpt();
        ?>
    </div>

    <footer class="entry-footer">
        <?php
        baffled_architect_post_categories();
        baffled_architect_post_tags();
        baffled_architect_edit_post_link();
        ?>
    </footer>
</article>
