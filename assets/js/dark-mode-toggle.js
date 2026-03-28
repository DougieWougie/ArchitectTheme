/**
 * Dark Mode Toggle
 * Manages theme switching with localStorage persistence
 *
 * @package Baffled_Architect
 * @since 1.0.0
 */

(function() {
  'use strict';

  // Check for saved theme preference or default to light mode
  const currentTheme = localStorage.getItem('theme') || 'light';

  // Apply theme immediately (this is also done inline in header for FOUC prevention)
  document.documentElement.setAttribute('data-theme', currentTheme);

  /**
   * Toggle between light and dark themes
   */
  function toggleTheme() {
    const current = document.documentElement.getAttribute('data-theme');
    const next = current === 'dark' ? 'light' : 'dark';

    document.documentElement.setAttribute('data-theme', next);
    localStorage.setItem('theme', next);

    // Update toggle button
    updateToggleButton(next);

    // Dispatch custom event for other scripts
    document.dispatchEvent(new CustomEvent('themeChanged', {
      detail: { theme: next }
    }));
  }

  /**
   * Update toggle button appearance based on current theme
   */
  function updateToggleButton(theme) {
    const toggle = document.querySelector('.theme-toggle');
    if (!toggle) return;

    const icon = toggle.querySelector('.theme-toggle-icon');
    const label = toggle.querySelector('.theme-toggle-label');

    if (theme === 'dark') {
      icon.innerHTML = '☀️'; // Sun icon for switching to light mode
      if (label) label.textContent = 'Light Mode';
      toggle.setAttribute('aria-label', 'Switch to light mode');
      toggle.setAttribute('title', 'Switch to light mode');
    } else {
      icon.innerHTML = '🌙'; // Moon icon for switching to dark mode
      if (label) label.textContent = 'Dark Mode';
      toggle.setAttribute('aria-label', 'Switch to dark mode');
      toggle.setAttribute('title', 'Switch to dark mode');
    }
  }

  /**
   * Initialize when DOM is ready
   */
  function init() {
    const toggle = document.querySelector('.theme-toggle');
    if (!toggle) return;

    // Set initial button state
    updateToggleButton(currentTheme);

    // Add click handler
    toggle.addEventListener('click', toggleTheme);

    // Optional: Listen for system preference changes
    if (window.matchMedia) {
      const prefersDark = window.matchMedia('(prefers-color-scheme: dark)');

      // Check if user has a saved preference
      const hasUserPreference = localStorage.getItem('theme') !== null;

      // Only auto-switch if user hasn't set a preference
      prefersDark.addEventListener('change', (e) => {
        if (!hasUserPreference) {
          const newTheme = e.matches ? 'dark' : 'light';
          document.documentElement.setAttribute('data-theme', newTheme);
          updateToggleButton(newTheme);
          document.dispatchEvent(new CustomEvent('themeChanged', {
            detail: { theme: newTheme }
          }));
        }
      });
    }
  }

  // Initialize when DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
