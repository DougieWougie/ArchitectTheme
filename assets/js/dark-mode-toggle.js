/**
 * Theme Toggle
 * Three states: auto (follow the OS), light, dark.
 *
 * <html data-theme-mode> holds the visitor's choice and <html data-theme>
 * the theme actually shown. The inline script in inc/enqueue-scripts.php
 * sets both before first paint; this file handles changes afterwards.
 * Only an explicit light/dark choice is stored; "auto" stores nothing.
 *
 * @package Baffled_Architect
 * @since 1.0.0
 */

(function() {
  'use strict';

  var STORAGE_KEY = 'theme';
  var root = document.documentElement;
  var prefersDark = window.matchMedia('(prefers-color-scheme: dark)');
  var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

  // Tracked here rather than read back from the DOM, because a cross-fade
  // commits the attribute change asynchronously.
  var currentMode = 'auto';

  function getSavedMode() {
    try {
      var saved = localStorage.getItem(STORAGE_KEY);
      return saved === 'light' || saved === 'dark' ? saved : 'auto';
    } catch (e) {
      return 'auto';
    }
  }

  function saveMode(mode) {
    try {
      if (mode === 'auto') {
        localStorage.removeItem(STORAGE_KEY);
      } else {
        localStorage.setItem(STORAGE_KEY, mode);
      }
    } catch (e) {
      // Storage unavailable: the choice lasts for this page only.
    }
  }

  function systemTheme() {
    return prefersDark.matches ? 'dark' : 'light';
  }

  function resolveTheme(mode) {
    return mode === 'auto' ? systemTheme() : mode;
  }

  /**
   * Order the cycle so every click from "auto" visibly changes the page:
   * auto -> opposite of the OS theme -> same as the OS theme -> auto.
   */
  function nextMode(mode) {
    var system = systemTheme();
    var opposite = system === 'dark' ? 'light' : 'dark';

    if (mode === 'auto') return opposite;
    if (mode === opposite) return system;
    return 'auto';
  }

  function updateToggle(mode) {
    var toggle = document.querySelector('.theme-toggle');
    if (!toggle) return;

    var label = toggle.getAttribute('data-label-' + mode);
    if (label) {
      toggle.setAttribute('aria-label', label);
      toggle.setAttribute('title', label);
    }
  }

  /**
   * Apply a mode to the document. Cross-fades with the View Transitions
   * API where available so the whole page changes together.
   */
  function applyMode(mode, animate) {
    var theme = resolveTheme(mode);
    var themeChanged = resolveTheme(currentMode) !== theme || root.getAttribute('data-theme') !== theme;

    currentMode = mode;

    function commit() {
      root.setAttribute('data-theme-mode', mode);
      root.setAttribute('data-theme', theme);
      updateToggle(mode);
    }

    if (animate && themeChanged && document.startViewTransition && !prefersReducedMotion.matches) {
      document.startViewTransition(commit);
    } else {
      commit();
    }

    if (themeChanged) {
      document.dispatchEvent(new CustomEvent('themeChanged', {
        detail: { theme: theme, mode: mode }
      }));
    }
  }

  function init() {
    currentMode = getSavedMode();
    updateToggle(currentMode);

    var toggle = document.querySelector('.theme-toggle');
    if (toggle) {
      toggle.addEventListener('click', function() {
        var mode = nextMode(currentMode);
        saveMode(mode);
        applyMode(mode, true);
      });
    }

    // Follow the OS while in auto mode
    prefersDark.addEventListener('change', function() {
      if (getSavedMode() === 'auto') {
        applyMode('auto', false);
      }
    });

    // Keep other open tabs in step
    window.addEventListener('storage', function(e) {
      if (e.key === STORAGE_KEY || e.key === null) {
        applyMode(getSavedMode(), false);
      }
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
