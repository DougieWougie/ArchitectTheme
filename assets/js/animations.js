/**
 * Scroll Animation Controller
 * Uses Intersection Observer API for performance
 *
 * @package Baffled_Architect
 * @since 1.0.0
 */

(function() {
  'use strict';

  // Check for reduced motion preference
  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  if (prefersReducedMotion) {
    // Skip animations if user prefers reduced motion
    return;
  }

  // Intersection Observer configuration
  const observerOptions = {
    root: null, // viewport
    rootMargin: '0px 0px -100px 0px', // Trigger slightly before element is visible
    threshold: 0.1 // Trigger when 10% of element is visible
  };

  /**
   * Callback for when elements enter viewport
   */
  function handleIntersect(entries, observer) {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        // Add animated class to trigger animation
        entry.target.classList.add('animated');

        // Stop observing this element (animate once)
        observer.unobserve(entry.target);
      }
    });
  }

  // Create observer
  const observer = new IntersectionObserver(handleIntersect, observerOptions);

  /**
   * Initialize animations
   */
  function init() {
    // Find all elements with animate-on-scroll class
    const animatedElements = document.querySelectorAll('.animate-on-scroll');

    // Observe each element
    animatedElements.forEach(element => {
      observer.observe(element);
    });
  }

  // Initialize when DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

  // Re-initialize on AJAX page loads (for SPA-like behavior)
  document.addEventListener('contentLoaded', init);
})();
