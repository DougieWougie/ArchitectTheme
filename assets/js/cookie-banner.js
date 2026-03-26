/**
 * GDPR Cookie Consent Banner
 * Shows a banner for cookie consent, stores choice in localStorage
 *
 * @package Baffled_Architect
 * @since 1.4.0
 */

(function() {
  'use strict';

  var STORAGE_KEY = 'cookie-consent';
  var TIMESTAMP_KEY = 'cookie-consent-timestamp';
  var EXPIRY_DAYS = 365;

  /**
   * Check if consent has expired
   */
  function isConsentExpired() {
    var timestamp = localStorage.getItem(TIMESTAMP_KEY);
    if (!timestamp) return true;

    var consentDate = new Date(parseInt(timestamp, 10));
    var now = new Date();
    var diffDays = (now - consentDate) / (1000 * 60 * 60 * 24);

    return diffDays > EXPIRY_DAYS;
  }

  /**
   * Store the user's consent choice
   */
  function storeConsent(value) {
    localStorage.setItem(STORAGE_KEY, value);
    localStorage.setItem(TIMESTAMP_KEY, Date.now().toString());
  }

  /**
   * Hide the banner with animation, then remove from DOM
   */
  function hideBanner(banner) {
    banner.classList.remove('visible');
    banner.classList.add('hiding');

    banner.addEventListener('transitionend', function() {
      banner.remove();
    }, { once: true });
  }

  /**
   * Initialize the cookie banner
   */
  function init() {
    var consent = localStorage.getItem(STORAGE_KEY);

    if (consent && !isConsentExpired()) {
      return;
    }

    var banner = document.getElementById('cookie-banner');
    if (!banner) return;

    var acceptBtn = document.getElementById('cookie-accept');
    var declineBtn = document.getElementById('cookie-decline');

    // Show banner with slight delay for slide-up animation
    requestAnimationFrame(function() {
      banner.classList.add('visible');
    });

    if (acceptBtn) {
      acceptBtn.addEventListener('click', function() {
        storeConsent('accepted');
        hideBanner(banner);
      });
    }

    if (declineBtn) {
      declineBtn.addEventListener('click', function() {
        storeConsent('declined');
        hideBanner(banner);
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
