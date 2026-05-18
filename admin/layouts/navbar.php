<?php
/* Fetch role + last_login for profile dropdown */
$_navAdmin = [];
if (isset($_SESSION['admin_id']) && isset($conn)) {
    $__r = mysqli_query($conn, "SELECT full_name, email, role, last_login FROM admin_users WHERE admin_id='" . intval($_SESSION['admin_id']) . "' LIMIT 1");
    if ($__r) $_navAdmin = mysqli_fetch_assoc($__r) ?: [];
}
$_navRole      = htmlspecialchars($_navAdmin['role']      ?? 'Admin');
$_navEmail     = htmlspecialchars($_navAdmin['email']     ?? ($_SESSION['admin_email'] ?? ''));
$_navFullName  = htmlspecialchars($_navAdmin['full_name'] ?? ($_SESSION['admin_name']  ?? ''));
$_navLastLogin = !empty($_navAdmin['last_login'])
    ? date('d M Y, h:i A', strtotime($_navAdmin['last_login']))
    : 'First session';
$_navInitial   = strtoupper(substr($_navFullName, 0, 1));
?>
<header class="admin-navbar" id="adminNavbar">

    <div class="navbar-left">
        <button class="navbar-toggle" id="sidebarToggle" onclick="toggleSidebar()" aria-label="Toggle sidebar">
            <i class="bi bi-list"></i>
        </button>
        <span class="navbar-page-title">Athlete Management</span>
    </div>

    <div class="navbar-right">

        <!-- Profile dropdown trigger -->
        <div class="navbar-profile" id="navbarProfile">
            <button class="navbar-profile-btn" onclick="toggleProfileDropdown(event)" aria-label="Admin profile">
                <div class="navbar-admin-avatar"><?php echo $_navInitial; ?></div>
                <span class="navbar-admin-name"><?php echo $_navFullName; ?></span>
                <i class="bi bi-chevron-down navbar-profile-chevron"></i>
            </button>

            <div class="navbar-profile-dropdown" id="navbarProfileDropdown">

                <!-- Header -->
                <div class="npd-header">
                    <div class="npd-avatar"><?php echo $_navInitial; ?></div>
                    <div class="npd-header-info">
                        <div class="npd-name"><?php echo $_navFullName; ?></div>
                        <div class="npd-email"><?php echo $_navEmail; ?></div>
                    </div>
                </div>

                <div class="npd-divider"></div>

                <!-- Info rows -->
                <div class="npd-info-list">
                    <div class="npd-info-row">
                        <span class="npd-info-label"><i class="bi bi-shield-fill"></i> Role</span>
                        <span class="npd-info-val npd-role-badge"><?php echo $_navRole; ?></span>
                    </div>
                    <div class="npd-info-row">
                        <span class="npd-info-label"><i class="bi bi-clock-fill"></i> Last Login</span>
                        <span class="npd-info-val"><?php echo $_navLastLogin; ?></span>
                    </div>
                </div>

                <div class="npd-divider"></div>

                <!-- Sign out -->
                <a href="#" class="npd-logout" onclick="openLogoutModal(event)">
                    <i class="bi bi-box-arrow-right"></i>
                    Sign Out
                </a>

            </div>
        </div>

    </div>

</header>

<!-- Logout Confirmation Modal -->
<div class="logout-modal-backdrop" id="logoutModalBackdrop" role="dialog" aria-modal="true" aria-labelledby="logoutModalTitle">
    <div class="logout-modal">
        <div class="logout-modal-icon">
            <i class="bi bi-box-arrow-right"></i>
        </div>
        <h2 class="logout-modal-title" id="logoutModalTitle">Sign Out?</h2>
        <p class="logout-modal-desc">You're about to sign out of the admin dashboard. Any unsaved changes will be lost.</p>
        <div class="logout-modal-actions">
            <button class="btn-modal-cancel" onclick="closeLogoutModal()">Stay</button>
            <a href="../auth/logout.php" class="btn-modal-confirm">
                <i class="bi bi-power"></i> Sign Out
            </a>
        </div>
    </div>
</div>