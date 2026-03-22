/**
 * Main Theme JavaScript
 * Theme initialization and utilities
 *
 * @package Baffled_Architect
 * @since 1.0.0
 */

(function() {
  'use strict';

  /**
   * Initialize theme
   */
  function init() {
    // Add loaded class to body when everything is ready
    document.body.classList.add('theme-loaded');

    // Set content offset to match fixed header height
    initHeaderOffset();

    // Initialize smooth scroll for anchor links
    initSmoothScroll();

    // Initialize external link handling
    initExternalLinks();

    // Initialize skip link focus fix
    initSkipLinkFocus();
  }

  /**
   * Measure fixed header and set --header-height for content offset
   */
  function initHeaderOffset() {
    var header = document.querySelector('.site-header');
    if (!header) return;

    function update() {
      document.documentElement.style.setProperty(
        '--header-height', header.offsetHeight + 'px'
      );
    }

    update();
    window.addEventListener('resize', debounce(update, 150));
  }

  /**
   * Smooth scroll for anchor links
   */
  function initSmoothScroll() {
    const anchorLinks = document.querySelectorAll('a[href^="#"]');

    anchorLinks.forEach(link => {
      link.addEventListener('click', (e) => {
        const targetId = link.getAttribute('href');

        // Ignore empty hash and hash-only links
        if (!targetId || targetId === '#') return;

        const targetElement = document.querySelector(targetId);

        if (targetElement) {
          e.preventDefault();

          targetElement.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });

          // Update URL hash
          if (history.pushState) {
            history.pushState(null, null, targetId);
          }

          // Focus target element for accessibility
          targetElement.focus();

          if (targetElement !== document.activeElement) {
            targetElement.setAttribute('tabindex', '-1');
            targetElement.focus();
          }
        }
      });
    });
  }

  /**
   * Add rel="noopener" to external links
   */
  function initExternalLinks() {
    const links = document.querySelectorAll('a[href]');

    links.forEach(link => {
      // Check if link is external
      if (link.hostname && link.hostname !== window.location.hostname) {
        // Add security attributes
        if (!link.hasAttribute('rel')) {
          link.setAttribute('rel', 'noopener noreferrer');
        }

        // Add target blank if not already set
        if (!link.hasAttribute('target')) {
          link.setAttribute('target', '_blank');
        }
      }
    });
  }

  /**
   * Fix skip link focus in Webkit
   */
  function initSkipLinkFocus() {
    const skipLink = document.querySelector('.skip-link');

    if (!skipLink) return;

    skipLink.addEventListener('click', (e) => {
      const target = document.querySelector(skipLink.getAttribute('href'));

      if (target) {
        target.setAttribute('tabindex', '-1');
        target.focus();

        target.addEventListener('blur', () => {
          target.removeAttribute('tabindex');
        }, { once: true });
      }
    });
  }

  /**
   * Debounce function for performance
   */
  function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
      const later = () => {
        clearTimeout(timeout);
        func(...args);
      };
      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
    };
  }

  /**
   * Throttle function for performance
   */
  function throttle(func, limit) {
    let inThrottle;
    return function(...args) {
      if (!inThrottle) {
        func.apply(this, args);
        inThrottle = true;
        setTimeout(() => inThrottle = false, limit);
      }
    };
  }

  // Initialize when DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

  // Export utilities to global scope if needed
  window.BaffledArchitect = {
    debounce: debounce,
    throttle: throttle
  };
})();
