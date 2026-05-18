/* ============================================================
   SPORTS MANAGEMENT SYSTEM — Admin Dashboard Script
   Filter tabs · Live search · Date range · Sidebar · Logout modal
   ============================================================ */

(function () {
  'use strict';

  /* ── Elements ── */
  var searchInput    = document.getElementById('searchInput');
  var filterTabs     = document.querySelectorAll('.filter-tab');
  var athleteRows    = document.querySelectorAll('.athlete-row');
  var emptyState     = document.getElementById('emptyState');
  var visibleCount   = document.getElementById('visibleCount');
  var statTotal      = document.getElementById('statTotal');
  var statApproved   = document.getElementById('statApproved');
  var statPending    = document.getElementById('statPending');
  var statRejected   = document.getElementById('statRejected');
  var sidebar        = document.getElementById('adminSidebar');
  var overlay        = document.getElementById('sidebarOverlay');

  /* ── Filter state ── */
  var activeFilter     = 'all';    // status tab
  var activeDatePreset = 'all';    // date preset key
  var customDateFrom   = null;     // Date object | null
  var customDateTo     = null;     // Date object | null

  /* ── Sidebar ── */
  window.toggleSidebar = function () {
    if (!sidebar) return;
    sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
  };

  function openSidebar() {
    sidebar.classList.add('open');
    if (overlay) overlay.classList.add('active');
  }

  window.closeSidebar = function () {
    sidebar  && sidebar.classList.remove('open');
    overlay  && overlay.classList.remove('active');
  };

  /* ── Date range helpers ── */
  function startOfDay(d) {
    return new Date(d.getFullYear(), d.getMonth(), d.getDate(), 0, 0, 0, 0);
  }

  function endOfDay(d) {
    return new Date(d.getFullYear(), d.getMonth(), d.getDate(), 23, 59, 59, 999);
  }

  /* Returns {from: Date|null, to: Date|null} or null (no filter) */
  function getDateRange() {
    var now   = new Date();
    var today = startOfDay(now);

    switch (activeDatePreset) {
      case 'all':
        return null;

      case 'today':
        return { from: today, to: endOfDay(now) };

      case '7days': {
        var from7 = new Date(today);
        from7.setDate(from7.getDate() - 6);
        return { from: from7, to: endOfDay(now) };
      }

      case 'month':
        return { from: new Date(now.getFullYear(), now.getMonth(), 1), to: endOfDay(now) };

      case 'custom':
        if (!customDateFrom && !customDateTo) return null;
        return { from: customDateFrom, to: customDateTo };

      default:
        return null;
    }
  }

  /* ── Core filter function (status + search + date) ── */
  function applyFilters() {
    var searchVal    = searchInput ? searchInput.value.trim().toLowerCase() : '';
    var range        = getDateRange();
    var shown        = 0;
    var cntApproved  = 0;
    var cntPending   = 0;
    var cntRejected  = 0;

    athleteRows.forEach(function (row) {
      var status  = (row.dataset.status  || '').toLowerCase();
      var name    = (row.querySelector('.athlete-name-cell')   || {}).textContent || '';
      var mobile  = (row.querySelector('.athlete-mobile-cell') || {}).textContent || '';
      var created = row.dataset.created || '';

      /* 1. Status tab */
      var matchesStatus =
        (
            activeFilter === 'all'
        ) ||
        (
            activeFilter === 'rejected' &&
            (
                status === 'rejected' ||
                status === 'cancelled' ||
                status === 'cancel'
            )
        ) ||
        (
            status === activeFilter
        );

      /* 2. Search */
      var matchesSearch = !searchVal ||
                          name.toLowerCase().includes(searchVal) ||
                          mobile.toLowerCase().includes(searchVal);

      /* 3. Date range */
      var matchesDate = true;
      if (range && created) {
        var rowDate = new Date(created.replace(' ', 'T'));
        if (!isNaN(rowDate)) {
          if (range.from && rowDate < range.from) matchesDate = false;
          if (range.to   && rowDate > range.to)   matchesDate = false;
        }
      }

      if (matchesStatus && matchesSearch && matchesDate) {
        row.classList.remove('hidden-row');
        shown++;
        /* count by status for card update */
        var s = (row.dataset.status || '').toLowerCase();
        if (s === 'approved') cntApproved++;
        else if (s === 'pending') cntPending++;
        else if (
              s === 'rejected' ||
              s === 'cancelled' ||
              s === 'cancel'
          ){
              cntRejected++;
          }
      } else {
        row.classList.add('hidden-row');
      }
    });

    /* Update stat cards to reflect filtered counts */
    if (statTotal)    statTotal.textContent    = shown;
    if (statApproved) statApproved.textContent = cntApproved;
    if (statPending)  statPending.textContent  = cntPending;
    if (statRejected) statRejected.textContent = cntRejected;

    if (visibleCount) {
      visibleCount.textContent = 'Showing ' + shown + (shown === 1 ? ' athlete' : ' athletes');
    }
    if (emptyState) {
      emptyState.style.display = shown === 0 ? 'block' : 'none';
    }
  }

  /* ── Status filter tabs ── */
  filterTabs.forEach(function (tab) {
    tab.addEventListener('click', function () {
      filterTabs.forEach(function (t) { t.classList.remove('active'); });
      this.classList.add('active');
      activeFilter = this.dataset.filter || 'all';
      applyFilters();
    });
  });

  /* ── Live search ── */
  if (searchInput) searchInput.addEventListener('input', applyFilters);

  /* ── Date filter UI ── */
  var dateFilterBtn    = document.getElementById('dateFilterBtn');
  var dateFilterPanel  = document.getElementById('dateFilterPanel');
  var dateCustomRange  = document.getElementById('dateCustomRange');
  var dateFilterLabel  = document.getElementById('dateFilterLabel');
  var dateFromInput    = document.getElementById('dateFrom');
  var dateToInput      = document.getElementById('dateTo');
  var applyRangeBtn    = document.getElementById('applyRangeBtn');
  var datePresets      = document.querySelectorAll('.date-preset');

  var PRESET_LABELS = {
    all:    'All Time',
    today:  'Today',
    '7days':'Last 7 Days',
    month:  'This Month',
    custom: 'Custom Range'
  };

  window.toggleDateFilter = function (e) {
    if (e) e.stopPropagation();
    var isOpen = dateFilterPanel && dateFilterPanel.classList.contains('open');
    isOpen ? closeDateFilter() : openDateFilter();
  };

  function openDateFilter() {
    if (dateFilterPanel) dateFilterPanel.classList.add('open');
    if (dateFilterBtn)   dateFilterBtn.classList.add('open');
  }

  function closeDateFilter() {
    if (dateFilterPanel) dateFilterPanel.classList.remove('open');
    if (dateFilterBtn)   dateFilterBtn.classList.remove('open');
  }

  /* Preset click */
  datePresets.forEach(function (btn) {
    btn.addEventListener('click', function () {
      var preset = this.dataset.preset;

      datePresets.forEach(function (b) { b.classList.remove('active'); });
      this.classList.add('active');
      activeDatePreset = preset;

      /* Show/hide custom inputs */
      if (dateCustomRange) {
        preset === 'custom'
          ? dateCustomRange.classList.add('visible')
          : dateCustomRange.classList.remove('visible');
      }

      /* Update button label */
      if (dateFilterLabel) dateFilterLabel.textContent = PRESET_LABELS[preset] || preset;

      /* Mark as having an active filter */
      if (dateFilterBtn) {
        preset === 'all'
          ? dateFilterBtn.classList.remove('has-filter')
          : dateFilterBtn.classList.add('has-filter');
      }

      /* Apply immediately for non-custom presets */
      if (preset !== 'custom') {
        customDateFrom = null;
        customDateTo   = null;
        applyFilters();
        if (preset !== 'custom') closeDateFilter();
      }
    });
  });

  /* Custom range — Apply button */
  if (applyRangeBtn) {
    applyRangeBtn.addEventListener('click', function () {
      var fromVal = dateFromInput ? dateFromInput.value : '';
      var toVal   = dateToInput   ? dateToInput.value   : '';

      customDateFrom = fromVal ? startOfDay(new Date(fromVal + 'T00:00:00')) : null;
      customDateTo   = toVal   ? endOfDay(new Date(toVal   + 'T00:00:00'))   : null;

      if (dateFilterLabel) {
        dateFilterLabel.textContent = (fromVal || toVal)
          ? (fromVal || '…') + ' → ' + (toVal || '…')
          : 'Custom Range';
      }

      if (dateFilterBtn) {
        (fromVal || toVal)
          ? dateFilterBtn.classList.add('has-filter')
          : dateFilterBtn.classList.remove('has-filter');
      }

      applyFilters();
      closeDateFilter();
    });
  }

  /* Close date panel on outside click */
  document.addEventListener('click', function (e) {
    var wrap = document.getElementById('dateFilterWrap');
    if (wrap && !wrap.contains(e.target)) closeDateFilter();
  });

  /* Initial run */
  applyFilters();

  /* ── Logout modal ── */
  var logoutBackdrop = document.getElementById('logoutModalBackdrop');

  window.openLogoutModal = function (e) {
    if (e) e.preventDefault();
    if (logoutBackdrop) {
      logoutBackdrop.classList.add('open');
      closeSidebar();
    }
  };

  window.closeLogoutModal = function () {
    if (logoutBackdrop) logoutBackdrop.classList.remove('open');
  };

  if (logoutBackdrop) {
    logoutBackdrop.addEventListener('click', function (e) {
      if (e.target === logoutBackdrop) closeLogoutModal();
    });
  }

  /* ── Profile dropdown ── */
  var navbarProfile  = document.getElementById('navbarProfile');

  window.toggleProfileDropdown = function (e) {
    if (e) e.stopPropagation();
    if (!navbarProfile) return;
    var isOpen = navbarProfile.classList.contains('open');
    isOpen ? closeProfileDropdown() : openProfileDropdown();
  };

  function openProfileDropdown() {
    if (navbarProfile) navbarProfile.classList.add('open');
    /* Close other overlays */
    closeDateFilter();
  }

  function closeProfileDropdown() {
    if (navbarProfile) navbarProfile.classList.remove('open');
  }

  /* Click outside closes dropdown */
  document.addEventListener('click', function (e) {
    if (navbarProfile && !navbarProfile.contains(e.target)) {
      closeProfileDropdown();
    }
  });

  /* Escape closes any open overlay */
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      closeSidebar();
      closeDateFilter();
      closeLogoutModal();
      closeProfileDropdown();
    }
  });

  /* ── Legacy: close on Escape (deduped above) ── */

})();
