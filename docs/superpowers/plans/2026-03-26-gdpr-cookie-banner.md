# GDPR Cookie Banner Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Add a GDPR-compliant cookie notification banner to the Baffled Architect WordPress theme.

**Architecture:** A fixed bottom bar with Accept/Decline buttons. Consent state stored in `localStorage` with a 365-day expiry. Pure CSS/JS — no WordPress admin settings or cookie-blocking logic needed since the site only uses essential cookies.

**Tech Stack:** PHP (WordPress template), vanilla CSS with CSS custom properties, vanilla JavaScript (IIFE pattern matching existing theme JS).

---

## File Structure

| Action | File | Responsibility |
|--------|------|---------------|
| Create | `assets/css/cookie-banner.css` | Banner layout, button styles, animations |
| Create | `assets/js/cookie-banner.js` | Show/hide logic, localStorage consent management |
| Modify | `footer.php` | Add banner HTML markup |
| Modify | `inc/enqueue-scripts.php` | Enqueue new CSS and JS assets |

---

### Task 1: Create Cookie Banner CSS

**Files:**
- Create: `assets/css/cookie-banner.css`

- [ ] **Step 1: Create the CSS file**

Create `assets/css/cookie-banner.css` with the following content. Uses existing CSS custom properties from `theme-base.css` — dark mode works automatically.

```css
/**
 * GDPR Cookie Banner Styles
 *
 * @package Baffled_Architect
 * @since 1.4.0
 */

/* ========================================================================
   Cookie Banner
   ======================================================================== */

.cookie-banner {
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  z-index: var(--z-modal);
  background: var(--color-surface);
  border-top: 1px solid var(--color-border);
  box-shadow: var(--shadow-lg);
  padding: var(--spacing-lg) var(--spacing-xl);
  transform: translateY(100%);
  transition: transform var(--theme-transition);
}

.cookie-banner.visible {
  transform: translateY(0);
}

.cookie-banner.hiding {
  transform: translateY(100%);
}

.cookie-banner-content {
  max-width: var(--container-max-width);
  margin: 0 auto;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: var(--spacing-lg);
}

.cookie-banner-text {
  font-family: var(--font-primary);
  font-size: var(--font-size-sm);
  color: var(--color-primary);
  line-height: 1.5;
  margin: 0;
}

.cookie-banner-buttons {
  display: flex;
  gap: var(--spacing-sm);
  flex-shrink: 0;
}

.cookie-banner-btn {
  font-family: var(--font-primary);
  font-size: var(--font-size-sm);
  font-weight: 500;
  padding: var(--spacing-sm) var(--spacing-lg);
  border-radius: var(--radius-md);
  cursor: pointer;
  transition: background var(--hover-transition), color var(--hover-transition), border-color var(--hover-transition);
  white-space: nowrap;
}

.cookie-banner-btn-accept {
  background: var(--color-accent);
  color: #ffffff;
  border: 1px solid var(--color-accent);
}

.cookie-banner-btn-accept:hover {
  background: var(--color-link-hover);
  border-color: var(--color-link-hover);
}

.cookie-banner-btn-decline {
  background: transparent;
  color: var(--color-secondary);
  border: 1px solid var(--color-border);
}

.cookie-banner-btn-decline:hover {
  color: var(--color-primary);
  border-color: var(--color-primary);
}

/* ========================================================================
   Responsive - Mobile
   ======================================================================== */

@media (max-width: 767px) {
  .cookie-banner {
    padding: var(--spacing-md);
  }

  .cookie-banner-content {
    flex-direction: column;
    text-align: center;
  }

  .cookie-banner-buttons {
    width: 100%;
  }

  .cookie-banner-btn {
    flex: 1;
  }
}
```

- [ ] **Step 2: Commit**

```bash
git add assets/css/cookie-banner.css
git commit -m "feat: add GDPR cookie banner styles"
```

---

### Task 2: Create Cookie Banner JavaScript

**Files:**
- Create: `assets/js/cookie-banner.js`

- [ ] **Step 1: Create the JavaScript file**

Create `assets/js/cookie-banner.js`. Follows the same IIFE + `DOMContentLoaded` pattern used by `scroll-to-top.js` and other theme JS files.

```javascript
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
```

- [ ] **Step 2: Commit**

```bash
git add assets/js/cookie-banner.js
git commit -m "feat: add GDPR cookie banner JavaScript"
```

---

### Task 3: Add Banner HTML to Footer

**Files:**
- Modify: `footer.php:63` (insert before the scroll-to-top button)

- [ ] **Step 1: Add banner markup to footer.php**

Insert the following HTML block in `footer.php` after the closing `</footer>` tag (line 60) and before the scroll-to-top button (line 63). Place it at line 62, between the `</footer>` closing tag and the `<button id="scroll-to-top"` element:

```php
<div id="cookie-banner" class="cookie-banner" role="dialog" aria-label="<?php esc_attr_e('Cookie consent', 'baffled-architect'); ?>">
    <div class="cookie-banner-content">
        <p class="cookie-banner-text">
            <?php esc_html_e('This site uses essential cookies to ensure it functions properly. No tracking or advertising cookies are used.', 'baffled-architect'); ?>
        </p>
        <div class="cookie-banner-buttons">
            <button id="cookie-accept" class="cookie-banner-btn cookie-banner-btn-accept">
                <?php esc_html_e('Accept', 'baffled-architect'); ?>
            </button>
            <button id="cookie-decline" class="cookie-banner-btn cookie-banner-btn-decline">
                <?php esc_html_e('Decline', 'baffled-architect'); ?>
            </button>
        </div>
    </div>
</div>
```

- [ ] **Step 2: Commit**

```bash
git add footer.php
git commit -m "feat: add GDPR cookie banner markup to footer"
```

---

### Task 4: Enqueue Banner Assets

**Files:**
- Modify: `inc/enqueue-scripts.php:72` (after search widget CSS) and `inc/enqueue-scripts.php:136` (after search widget JS)

- [ ] **Step 1: Add CSS enqueue**

In `inc/enqueue-scripts.php`, add the following block after the search widget CSS enqueue (after line 72, before the 404 conditional block):

```php
    // Cookie banner styles
    wp_enqueue_style(
        'baffled-architect-cookie-banner',
        BAFFLED_ARCHITECT_URI . '/assets/css/cookie-banner.css',
        array('baffled-architect-base'),
        BAFFLED_ARCHITECT_VERSION
    );
```

- [ ] **Step 2: Add JS enqueue**

In the same file, add the following block after the search widget JS enqueue (after line 136):

```php
    // Cookie banner
    wp_enqueue_script(
        'baffled-architect-cookie-banner',
        BAFFLED_ARCHITECT_URI . '/assets/js/cookie-banner.js',
        array(),
        BAFFLED_ARCHITECT_VERSION,
        true
    );
```

- [ ] **Step 3: Commit**

```bash
git add inc/enqueue-scripts.php
git commit -m "feat: enqueue GDPR cookie banner CSS and JS"
```

---

### Task 5: Manual Verification

- [ ] **Step 1: Verify all files exist**

```bash
ls -la assets/css/cookie-banner.css assets/js/cookie-banner.js
```

Expected: Both files exist and are non-empty.

- [ ] **Step 2: Check footer.php has the banner markup**

Search `footer.php` for `cookie-banner` to confirm the markup was added.

- [ ] **Step 3: Check enqueue-scripts.php has both enqueue calls**

Search `inc/enqueue-scripts.php` for `cookie-banner` to confirm both the CSS and JS enqueue calls are present.

- [ ] **Step 4: Verify no syntax errors in PHP files**

```bash
php -l footer.php
php -l inc/enqueue-scripts.php
```

Expected: "No syntax errors detected" for both files.
