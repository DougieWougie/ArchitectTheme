# GDPR Cookie Banner Design

## Summary

Add a GDPR-compliant cookie notification banner to the Baffled Architect WordPress theme. The site uses essential cookies only, so this is an informational banner — no cookie blocking/enabling logic is needed.

## Behavior

- On page load, check `localStorage` for a `cookie-consent` key
- If no value exists, show the banner with a slide-up animation
- **Accept** button: sets `cookie-consent: accepted`, hides banner with slide-down animation
- **Decline** button: sets `cookie-consent: declined`, hides banner with slide-down animation
- Banner does not reappear once a choice is made
- Consent value persists for 365 days (tracked via a stored timestamp; if older than 365 days, banner reappears)

## Banner Text

> "This site uses essential cookies to ensure it functions properly. No tracking or advertising cookies are used."

## Visual Design

- Fixed to bottom of viewport, full width
- Uses existing CSS custom properties: `--color-surface`, `--color-primary`, `--color-border`, `--font-primary`, `--color-accent`
- Accept button: solid style using `--color-accent`
- Decline button: secondary/outline style
- Dark mode support via `[data-theme="dark"]` (inherits automatically through CSS custom properties)
- Smooth slide-up animation on appear, slide-down on dismiss
- Responsive: buttons stack vertically on mobile

## Files to Create

### `assets/css/cookie-banner.css`
- Banner container styles (fixed positioning, background, border, padding)
- Button styles (accept primary, decline secondary)
- Animation keyframes (slide-up, slide-down)
- Responsive breakpoint for mobile button stacking
- No dark mode overrides needed — CSS custom properties handle this automatically

### `assets/js/cookie-banner.js`
- On `DOMContentLoaded`, check `localStorage` for `cookie-consent` and `cookie-consent-timestamp`
- If no consent or timestamp older than 365 days, show the banner
- Accept/Decline click handlers: store value + timestamp, animate out, remove from DOM
- No external dependencies

## Files to Modify

### `footer.php`
- Add banner HTML markup before `<?php wp_footer(); ?>`
- Structure: container div > text paragraph + button wrapper with two buttons

### `inc/enqueue-scripts.php`
- Enqueue `cookie-banner.css` with dependency on `baffled-architect-base`
- Enqueue `cookie-banner.js` with no dependencies, loaded in footer

## Out of Scope

- Cookie preference categories/toggles (not needed — essential cookies only)
- Cookie policy page generation
- Server-side cookie blocking
- Admin settings panel for banner customization
