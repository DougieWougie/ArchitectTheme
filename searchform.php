<?php
/**
 * Custom Search Form
 *
 * @package Baffled_Architect
 * @since 1.0.3
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

$unique_id = wp_unique_id('search-form-');
?>
<form role="search" method="get" class="ba-search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label class="screen-reader-text" for="<?php echo esc_attr($unique_id); ?>">
        <?php echo esc_html_x('Search for:', 'label', 'baffled-architect'); ?>
    </label>
    <div class="ba-search-input-wrap">
        <input type="search"
               id="<?php echo esc_attr($unique_id); ?>"
               class="ba-search-field"
               placeholder="<?php echo esc_attr_x('Search &hellip;', 'placeholder', 'baffled-architect'); ?>"
               value="<?php echo get_search_query(); ?>"
               name="s"
               autocomplete="off" />
        <button type="submit" class="ba-search-submit" aria-label="<?php esc_attr_e('Search', 'baffled-architect'); ?>">
            <svg class="ba-search-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"/>
                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
        </button>
    </div>
    <div class="ba-search-history" style="display: none;">
        <div class="ba-search-history-header">
            <span class="ba-search-history-title"><?php esc_html_e('Recent Searches', 'baffled-architect'); ?></span>
            <button type="button" class="ba-search-history-clear" aria-label="<?php esc_attr_e('Clear search history', 'baffled-architect'); ?>">
                <?php esc_html_e('Clear', 'baffled-architect'); ?>
            </button>
        </div>
        <ul class="ba-search-history-list" data-empty-text="<?php esc_attr_e('No recent searches', 'baffled-architect'); ?>"></ul>
    </div>
</form>
