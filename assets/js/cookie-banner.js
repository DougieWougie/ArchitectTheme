/**
 * GDPR Cookie Consent Banner
 * Shows a banner for cookie consent, stores choice in localStorage
 *
 * @package Baffled_Architect
 * @since 1.4.0
 */

(function() {
  'use strict';

  const STORAGE_KEY = 'cookie-consent';
  const TIMESTAMP_KEY = 'cookie-consent-timestamp';
  const EXPIRY_DAYS = 365;

  /**
   * Check if consent has expired
   */
  function isConsentExpired() {
    const timestamp = localStorage.getItem(TIMESTAMP_KEY);
    if (!timestamp) return true;

    const consentDate = new Date(parseInt(timestamp, 10));
    const now = new Date();
    const diffDays = (now - consentDate) / (1000 * 60 * 60 * 24);

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

    const fallback = setTimeout(() => banner.remove(), 500);

    banner.addEventListener('transitionend', function() {
      clearTimeout(fallback);
      banner.remove();
    }, { once: true });
  }

  /**
   * Initialize the cookie banner
   */
  function init() {
    const consent = localStorage.getItem(STORAGE_KEY);

    if (consent && !isConsentExpired()) {
      return;
    }

    const banner = document.getElementById('cookie-banner');
    if (!banner) return;

    const acceptBtn = document.getElementById('cookie-accept');
    const declineBtn = document.getElementById('cookie-decline');

    // Show banner on next frame to allow CSS transition
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
