/**
 * Prism.js Theme Sync
 * Re-highlights code blocks when the theme is toggled
 *
 * @package Baffled_Architect
 * @since 1.4.0
 */
(function() {
  'use strict';

  document.addEventListener('themeChanged', function() {
    if (typeof Prism !== 'undefined') {
      Prism.highlightAll();
    }
  });
})();
