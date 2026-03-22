<?php
/**
 * The template for displaying 404 pages
 *
 * @package Baffled_Architect
 * @since 1.2.0
 */

get_header();
?>

<main id="primary" class="site-main">
    <section class="error-404 not-found">
        <div class="glitch-wrapper">
            <h1 class="glitch-text" data-text="<?php esc_attr_e('UH-OH', 'baffled-architect'); ?>"><?php esc_html_e('UH-OH', 'baffled-architect'); ?></h1>
        </div>

        <p class="error-404-message"><?php esc_html_e('This page got lost in the blueprints.', 'baffled-architect'); ?></p>

        <a href="<?php echo esc_url(home_url('/')); ?>" class="error-404-home">
            <?php esc_html_e('Return to Safety', 'baffled-architect'); ?>
        </a>
    </section>
</main>

<script>
// Add 'settled' class after glitch intro animation (2.5s in 404.css) to trigger idle flicker
(function() {
    var el = document.querySelector('.glitch-text');
    if (el) {
        setTimeout(function() { el.classList.add('settled'); }, 2600);
    }
})();
</script>

<?php
get_footer();
