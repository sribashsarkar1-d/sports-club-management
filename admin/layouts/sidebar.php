<aside class="admin-sidebar" id="adminSidebar">

    <!-- Brand -->
    <div class="sidebar-brand">
        <div class="sidebar-brand-icon">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L8 6H4V10C4 14.4 7.4 18.2 12 19C16.6 18.2 20 14.4 20 10V6H16L12 2Z" fill="#000052"/>
                <path d="M8 6H4V10C4 12.5 5.4 14.8 7.5 16.3L8 6Z" fill="rgba(0,0,82,0.35)"/>
                <path d="M10 21H14V23H10V21Z" fill="#000052"/>
                <path d="M8 23H16V24H8V23Z" fill="#000052"/>
            </svg>
        </div>
        <div class="sidebar-brand-text">
            Sports Club
            <span>Management</span>
        </div>
    </div>

    <div class="sidebar-divider"></div>

    <!-- Navigation — only Dashboard is active; other items commented out for single-page focus -->
    <nav class="sidebar-nav">

        <div class="sidebar-nav-label">Main</div>

        <a href="../dashboard/index.php" class="sidebar-nav-link <?php echo (($activePage ?? 'dashboard') === 'dashboard') ? 'active' : ''; ?>">
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span>
        </a>

        <?php if (($activePage ?? '') === 'athlete-view'): ?>
        <a href="javascript:history.back()" class="sidebar-nav-link active">
            <i class="bi bi-person-badge-fill"></i>
            <span>Athlete Profile</span>
        </a>
        <?php endif; ?>

        <!--
        <a href="../dashboard/athletes.php" class="sidebar-nav-link">
            <i class="bi bi-people"></i>
            <span>All Athletes</span>
        </a>

        <a href="../dashboard/pending-athletes.php" class="sidebar-nav-link">
            <i class="bi bi-clock-history"></i>
            <span>Pending Athletes</span>
        </a>

        <a href="../dashboard/approved-athletes.php" class="sidebar-nav-link">
            <i class="bi bi-check-circle"></i>
            <span>Approved Athletes</span>
        </a>

        <a href="../dashboard/rejected-athletes.php" class="sidebar-nav-link">
            <i class="bi bi-x-circle"></i>
            <span>Rejected Athletes</span>
        </a>

        <a href="../dashboard/activity-logs.php" class="sidebar-nav-link">
            <i class="bi bi-clock"></i>
            <span>Activity Logs</span>
        </a>

        <a href="../dashboard/notifications.php" class="sidebar-nav-link">
            <i class="bi bi-bell"></i>
            <span>Notifications</span>
        </a>
        -->

    </nav>

    <!-- Footer: Logout -->
    <div class="sidebar-footer">
        <a href="#" class="sidebar-logout-btn" onclick="openLogoutModal(event)">
            <i class="bi bi-box-arrow-right"></i>
            <span>Sign Out</span>
        </a>
    </div>

</aside>

<!-- Mobile backdrop -->
<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>