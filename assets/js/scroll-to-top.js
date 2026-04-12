/**
 * Scroll to Top Button
 * Shows/hides based on scroll position with smooth scrolling
 *
 * @package Baffled_Architect
 * @since 1.0.0
 */

(function() {
  'use strict';

  const SCROLL_THRESHOLD = 300; // Show button after scrolling 300px

  let scrollButton = null;
  let rafId = null;

  /**
   * Initialize button
   */
  function init() {
    scrollButton = document.getElementById('scroll-to-top');
    if (!scrollButton) return;

    // Show/hide based on scroll position
    window.addEventListener('scroll', handleScroll, { passive: true });

    // Scroll to top on click
    scrollButton.addEventListener('click', scrollToTop);

    // Check initial position
    handleScroll();
  }

  /**
   * Handle scroll events with requestAnimationFrame for performance.
   * Cancels any pending frame before scheduling a new one so the callback
   * always reads the most recent scroll position — prevents the brief
   * show/hide flicker caused by dropped events during mobile momentum scrolling.
   */
  function handleScroll() {
    if (rafId !== null) {
      cancelAnimationFrame(rafId);
    }

    rafId = requestAnimationFrame(() => {
      rafId = null;
      const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

      if (scrollTop > SCROLL_THRESHOLD) {
        scrollButton.classList.add('visible');
      } else {
        scrollButton.classList.remove('visible');
      }
    });
  }

  /**
   * Smooth scroll to top
   */
  function scrollToTop() {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });

    // For older browsers without smooth scroll support
    if (!('scrollBehavior' in document.documentElement.style)) {
      smoothScrollPolyfill();
    }
  }

  /**
   * Polyfill for smooth scrolling (older browsers)
   */
  function smoothScrollPolyfill() {
    const scrollDuration = 500; // ms
    const scrollStep = -window.scrollY / (scrollDuration / 15);

    const scrollInterval = setInterval(() => {
      if (window.scrollY !== 0) {
        window.scrollBy(0, scrollStep);
      } else {
        clearInterval(scrollInterval);
      }
    }, 15);
  }

  // Initialize when DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
