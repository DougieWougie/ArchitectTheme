<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php baffled_architect_post_thumbnail(); ?>

    <header class="entry-header animate-on-scroll animate-fade-in">
        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>

        <div class="entry-meta">
            <?php
            baffled_architect_post_meta();
            ?>
            <span class="reading-time">
                <?php echo baffled_architect_reading_time(); ?> read
            </span>
        </div>
    </header>

    <div class="entry-content">
        <?php
        the_content(
            sprintf(
                wp_kses(
                    __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'baffled-architect'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            )
        );

        wp_link_pages(
            array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'baffled-architect'),
                'after'  => '</div>',
            )
        );
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
