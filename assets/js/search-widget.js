/**
 * Search Widget - History & Effects
 *
 * @package Baffled_Architect
 * @since 1.0.3
 */

(function () {
  'use strict';

  var STORAGE_KEY = 'ba_search_history';
  var MAX_HISTORY = 5;

  function getHistory() {
    try {
      return JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];
    } catch (e) {
      return [];
    }
  }

  function saveHistory(history) {
    try {
      localStorage.setItem(STORAGE_KEY, JSON.stringify(history));
    } catch (e) {
      // localStorage unavailable
    }
  }

  function addToHistory(term) {
    term = term.trim();
    if (!term) return;

    var history = getHistory();
    // Remove duplicates (case-insensitive)
    history = history.filter(function (item) {
      return item.toLowerCase() !== term.toLowerCase();
    });
    // Add to front
    history.unshift(term);
    // Keep only the last MAX_HISTORY
    history = history.slice(0, MAX_HISTORY);
    saveHistory(history);
  }

  function clearChildren(el) {
    while (el.firstChild) {
      el.removeChild(el.firstChild);
    }
  }

  function initSearchForm(form) {
    var field = form.querySelector('.ba-search-field');
    var historyPanel = form.querySelector('.ba-search-history');
    var historyList = form.querySelector('.ba-search-history-list');
    var clearBtn = form.querySelector('.ba-search-history-clear');

    if (!field || !historyPanel || !historyList) return;

    function renderHistory() {
      var history = getHistory();
      clearChildren(historyList);

      if (history.length === 0) {
        var empty = document.createElement('li');
        empty.className = 'ba-search-history-empty';
        empty.textContent = historyList.getAttribute('data-empty-text') || 'No recent searches';
        historyList.appendChild(empty);
        if (clearBtn) clearBtn.style.display = 'none';
        return;
      }

      if (clearBtn) clearBtn.style.display = '';

      history.forEach(function (term) {
        var li = document.createElement('li');
        li.className = 'ba-search-history-item';

        var link = document.createElement('a');
        link.className = 'ba-search-history-link';
        var url = new URL(form.action, window.location.origin);
        url.searchParams.set('s', term);
        link.href = url.toString();
        link.textContent = term;

        link.addEventListener('click', function (e) {
          e.preventDefault();
          field.value = term;
          hideHistory();
          form.submit();
        });

        li.appendChild(link);
        historyList.appendChild(li);
      });
    }

    function showHistory() {
      renderHistory();
      historyPanel.style.display = '';
    }

    function hideHistory() {
      historyPanel.style.display = 'none';
    }

    // Show history on focus
    field.addEventListener('focus', function () {
      showHistory();
    });

    // Hide history on click outside
    document.addEventListener('click', function (e) {
      if (!form.contains(e.target)) {
        hideHistory();
      }
    });

    // Hide on escape
    field.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') {
        hideHistory();
        field.blur();
      }
    });

    // Clear history
    if (clearBtn) {
      clearBtn.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        saveHistory([]);
        renderHistory();
      });
    }

    // Save search on form submit
    form.addEventListener('submit', function () {
      addToHistory(field.value);
    });
  }

  // Save current search query on page load (from search results page)
  function saveCurrentSearch() {
    var params = new URLSearchParams(window.location.search);
    var query = params.get('s');
    if (query) {
      addToHistory(query);
    }
  }

  // Initialize
  function init() {
    saveCurrentSearch();

    var forms = document.querySelectorAll('.ba-search-form');
    for (var i = 0; i < forms.length; i++) {
      initSearchForm(forms[i]);
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
