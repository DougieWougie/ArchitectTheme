        </div>
    </div>

    <footer id="colophon" class="site-footer">
        <div class="footer-container">
            <?php if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3')) : ?>
                <div class="footer-widgets">
                    <?php if (is_active_sidebar('footer-1')) : ?>
                        <div class="footer-widget-area">
                            <?php dynamic_sidebar('footer-1'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (is_active_sidebar('footer-2')) : ?>
                        <div class="footer-widget-area">
                            <?php dynamic_sidebar('footer-2'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (is_active_sidebar('footer-3')) : ?>
                        <div class="footer-widget-area">
                            <?php dynamic_sidebar('footer-3'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="site-info">
                <div class="footer-navigation">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer',
                            'menu_class'     => 'footer-menu',
                            'depth'          => 1,
                            'fallback_cb'    => false,
                        )
                    );
                    ?>
                </div>

                <div class="copyright">
                    <p>
                        &copy; <?php echo date('Y'); ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <?php bloginfo('name'); ?>
                        </a>
                        <?php esc_html_e('- Every day is a school day.', 'baffled-architect'); ?>
                    </p>
                    <p>
                        <?php
                        printf(
                            esc_html__('Theme: Baffled Architect', 'baffled-architect')
                        );
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </footer>
</div>

<button id="scroll-to-top" class="scroll-to-top" aria-label="Scroll to top">
    <svg class="scroll-to-top-icon" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path fill="currentColor" d="M4,21 L4,9 L12,3 L20,9 L20,21 L14,21 L14,14 L10,14 L10,21 Z"/>
    </svg>
</button>

<?php wp_footer(); ?>

</body>
</html>
