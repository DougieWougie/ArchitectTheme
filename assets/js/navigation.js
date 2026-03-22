/**
 * Navigation
 * Mobile menu toggle and keyboard navigation
 *
 * @package Baffled_Architect
 * @since 1.0.0
 */

(function() {
  'use strict';

  let menuToggle = null;
  let navigation = null;

  /**
   * Initialize navigation
   */
  function init() {
    menuToggle = document.querySelector('.menu-toggle');
    navigation = document.querySelector('.main-navigation');

    if (!menuToggle || !navigation) return;

    // Add click handler for menu toggle
    menuToggle.addEventListener('click', toggleMenu);

    // Close menu when clicking outside
    document.addEventListener('click', handleClickOutside);

    // Handle escape key
    document.addEventListener('keydown', handleEscapeKey);

    // Handle window resize
    window.addEventListener('resize', handleResize);
  }

  /**
   * Toggle mobile menu
   */
  function toggleMenu(e) {
    e.stopPropagation();

    const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';

    menuToggle.setAttribute('aria-expanded', !isExpanded);
    navigation.classList.toggle('toggled');

    // Focus first menu item when opening
    if (!isExpanded) {
      const firstMenuItem = navigation.querySelector('a');
      if (firstMenuItem) {
        setTimeout(() => firstMenuItem.focus(), 100);
      }
    }
  }

  /**
   * Close menu when clicking outside
   */
  function handleClickOutside(e) {
    if (!navigation.classList.contains('toggled')) return;

    if (!navigation.contains(e.target) && !menuToggle.contains(e.target)) {
      closeMenu();
    }
  }

  /**
   * Close menu on escape key
   */
  function handleEscapeKey(e) {
    if (e.key === 'Escape' && navigation.classList.contains('toggled')) {
      closeMenu();
      menuToggle.focus();
    }
  }

  /**
   * Close menu
   */
  function closeMenu() {
    menuToggle.setAttribute('aria-expanded', 'false');
    navigation.classList.remove('toggled');
  }

  /**
   * Handle window resize
   */
  function handleResize() {
    // Close mobile menu on desktop
    if (window.innerWidth >= 1024 && navigation.classList.contains('toggled')) {
      closeMenu();
    }
  }

  /**
   * Trap focus within mobile menu
   */
  function trapFocus(element) {
    const focusableElements = element.querySelectorAll(
      'a[href], button:not([disabled]), textarea:not([disabled]), input:not([disabled]), select:not([disabled])'
    );

    const firstFocusable = focusableElements[0];
    const lastFocusable = focusableElements[focusableElements.length - 1];

    element.addEventListener('keydown', (e) => {
      if (e.key !== 'Tab') return;

      if (e.shiftKey) {
        // Shift + Tab
        if (document.activeElement === firstFocusable) {
          e.preventDefault();
          lastFocusable.focus();
        }
      } else {
        // Tab
        if (document.activeElement === lastFocusable) {
          e.preventDefault();
          firstFocusable.focus();
        }
      }
    });
  }

  // Initialize when DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
