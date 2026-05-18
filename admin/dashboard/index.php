<?php

include '../../config/session.php';
include '../../config/database.php';

if(!isset($_SESSION['admin_id'])){
    header("Location: ../auth/login.php");
    exit;
}

/* ── Main athlete query (unchanged logic) ── */
$query = mysqli_query(
    $conn,
    "SELECT
        a.athlete_id,
        a.full_name,
        a.mobile,
        a.athlete_status,
        a.created_at,
        cp.age_group,
        cp.competition_name
     FROM athletes a
     LEFT JOIN competitions cp ON a.athlete_id = cp.athlete_id
     ORDER BY a.athlete_id DESC"
);

/* ── Stat counts for display cards ── */
$statsQ = mysqli_query(
    $conn,
    "SELECT
        COUNT(*) AS total,
        SUM(CASE WHEN athlete_status = 'Approved' THEN 1 ELSE 0 END) AS approved,
        SUM(CASE WHEN athlete_status = 'Pending'  THEN 1 ELSE 0 END) AS pending,
        SUM(CASE WHEN athlete_status = 'Rejected' OR athlete_status = 'Cancelled' OR athlete_status = 'Cancel' THEN 1 ELSE 0 END) AS rejected
     FROM athletes"
);
$stats    = mysqli_fetch_assoc($statsQ);
$total    = (int)($stats['total']    ?? 0);
$approved = (int)($stats['approved'] ?? 0);
$pending  = (int)($stats['pending']  ?? 0);
$rejected = (int)($stats['rejected'] ?? 0);

$todayDate = date('d M Y');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Brand Logo / Favicon -->
    <link rel="icon" type="image/svg+xml" href="../assets/images/logo.svg">
    <title>Dashboard — Sports Management</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin-style.css">
</head>

<body>

<?php include '../layouts/sidebar.php'; ?>

<?php include '../layouts/navbar.php'; ?>

<!-- ── MAIN CONTENT ── -->
<div class="main-content">
<div class="page-body">

    <!-- Page Header -->
    <div class="dash-header">
        <div class="dash-header-left">
            <h1>Athlete Dashboard</h1>
            <p>Centralized athlete database — manage, filter, and track registrations</p>
        </div>
        <!-- Date Range Filter -->
        <div class="date-filter-wrap" id="dateFilterWrap">

            <button class="date-filter-btn" id="dateFilterBtn" type="button" onclick="toggleDateFilter(event)">
                <i class="bi bi-calendar3"></i>
                <span id="dateFilterLabel">All Time</span>
                <span class="date-active-dot"></span>
                <i class="bi bi-chevron-down date-filter-chevron"></i>
            </button>

            <div class="date-filter-panel" id="dateFilterPanel">

                <div class="date-filter-panel-hd">Filter by Registration Date</div>

                <div class="date-preset-list">
                    <button class="date-preset active" data-preset="all" type="button">
                        <i class="bi bi-infinity"></i> All Time
                    </button>
                    <button class="date-preset" data-preset="today" type="button">
                        <i class="bi bi-sun"></i> Today
                    </button>
                    <button class="date-preset" data-preset="7days" type="button">
                        <i class="bi bi-calendar-week"></i> Last 7 Days
                    </button>
                    <button class="date-preset" data-preset="month" type="button">
                        <i class="bi bi-calendar-month"></i> This Month
                    </button>
                    <button class="date-preset" data-preset="custom" type="button">
                        <i class="bi bi-sliders"></i> Custom Range
                    </button>
                </div>

                <div class="date-custom-range" id="dateCustomRange">
                    <div class="date-range-row">
                        <div class="date-range-field">
                            <label class="date-range-label" for="dateFrom">From</label>
                            <input type="date" id="dateFrom" class="date-range-input">
                        </div>
                        <i class="bi bi-arrow-right date-range-arrow"></i>
                        <div class="date-range-field">
                            <label class="date-range-label" for="dateTo">To</label>
                            <input type="date" id="dateTo" class="date-range-input">
                        </div>
                    </div>
                    <button class="btn-apply-range" id="applyRangeBtn" type="button">
                        Apply Range
                    </button>
                </div>

            </div>
        </div><!-- /date-filter-wrap -->
    </div>

    <!-- Stat Cards -->
    <div class="stats-grid">

        <div class="stat-card stat-card--total">
            <div class="stat-card-top">
                <span class="stat-card-label">Total Athletes</span>
                <div class="stat-card-icon">
                    <i class="bi bi-people-fill"></i>
                </div>
            </div>
            <div class="stat-card-number" id="statTotal"><?php echo $total; ?></div>
        </div>

        <div class="stat-card stat-card--approved">
            <div class="stat-card-top">
                <span class="stat-card-label">Approved</span>
                <div class="stat-card-icon">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
            </div>
            <div class="stat-card-number" id="statApproved"><?php echo $approved; ?></div>
        </div>

        <div class="stat-card stat-card--pending">
            <div class="stat-card-top">
                <span class="stat-card-label">Pending</span>
                <div class="stat-card-icon">
                    <i class="bi bi-hourglass-split"></i>
                </div>
            </div>
            <div class="stat-card-number" id="statPending"><?php echo $pending; ?></div>
        </div>

        <div class="stat-card stat-card--rejected">
            <div class="stat-card-top">
                <span class="stat-card-label">Rejected</span>
                <div class="stat-card-icon">
                    <i class="bi bi-x-circle-fill"></i>
                </div>
            </div>
            <div class="stat-card-number" id="statRejected"><?php echo $rejected; ?></div>
        </div>

    </div><!-- /stats-grid -->

    <!-- Control Bar: Search + Filter Tabs -->
    <div class="control-bar">

        <div class="search-wrapper">
            <i class="bi bi-search search-icon"></i>
            <input
                type="text"
                id="searchInput"
                class="search-input"
                placeholder="Search by name or mobile…"
                autocomplete="off">
        </div>

        <div class="filter-tabs" role="group" aria-label="Filter athletes by status">
            <button class="filter-tab active" data-filter="all">
                All
                <span class="tab-count"><?php echo $total; ?></span>
            </button>
            <button class="filter-tab" data-filter="approved">
                Approved
                <span class="tab-count"><?php echo $approved; ?></span>
            </button>
            <button class="filter-tab" data-filter="pending">
                Pending
                <span class="tab-count"><?php echo $pending; ?></span>
            </button>
            <button class="filter-tab" data-filter="rejected">
                Cancelled
                <span class="tab-count"><?php echo $rejected; ?></span>
            </button>
        </div>

    </div><!-- /control-bar -->

    <!-- Athletes Table -->
    <div class="table-card">

        <div class="table-card-header">
            <span class="table-card-title">
                <i class="bi bi-table"></i>
                Athletes Register
            </span>
            <span class="table-count-badge" id="visibleCount">
                Showing <?php echo $total; ?> athletes
            </span>
        </div>

        <div class="athletes-table-wrap">
            <table class="athletes-table" id="athletesTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Age Group</th>
                        <th>Competition</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                <?php while($row = mysqli_fetch_assoc($query)): ?>

                <?php
                    $statusRaw = trim($row['athlete_status'] ?? 'Pending');

                    $statusLower = strtolower($statusRaw);

                    $badgeClass = 'status-badge--pending';

                    /* =====================================================
                    APPROVED
                    ===================================================== */

                    if(
                        $statusLower === 'approved'
                    ){

                        $badgeClass = 'status-badge--approved';

                    }

                    /* =====================================================
                    REJECTED / CANCELLED
                    ===================================================== */

                    if(
                        $statusLower === 'rejected' ||
                        $statusLower === 'cancelled' ||
                        $statusLower === 'cancel'
                    ){

                        $badgeClass = 'status-badge--rejected';

                        /* NORMALIZE STATUS TEXT */

                        $statusRaw = 'Cancelled';

                    }
                ?>

                <tr class="athlete-row" data-status="<?php echo $statusLower; ?>" data-created="<?php echo htmlspecialchars($row['created_at'] ?? ''); ?>">

                    <td class="athlete-id-cell">
                        #<?php echo $row['athlete_id']; ?>
                    </td>

                    <td>
                        <span class="athlete-name-cell">
                            <?php echo htmlspecialchars($row['full_name']); ?>
                        </span>
                    </td>

                    <td class="athlete-mobile-cell">
                        <?php echo htmlspecialchars($row['mobile']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row['age_group'] ?? '—'); ?>
                    </td>

                    <td class="athlete-competition-cell" title="<?php echo htmlspecialchars($row['competition_name'] ?? ''); ?>">
                        <?php echo htmlspecialchars($row['competition_name'] ?? '—'); ?>
                    </td>

                    <td>
                        <span class="status-badge <?php echo $badgeClass; ?>">
                            <?php echo $statusRaw; ?>
                        </span>
                    </td>

                    <td>
                        <a href="athlete-view.php?id=<?php echo $row['athlete_id']; ?>" class="btn-view">
                            <i class="bi bi-eye"></i>
                            View
                        </a>
                    </td>

                </tr>

                <?php endwhile; ?>

                </tbody>
            </table>

            <!-- Empty state (shown via JS when no rows match) -->
            <div class="empty-state" id="emptyState" style="display:none;">
                <i class="bi bi-search"></i>
                <p>No athletes match the current filter or search.</p>
            </div>

        </div><!-- /athletes-table-wrap -->

    </div><!-- /table-card -->

</div><!-- /page-body -->
</div><!-- /main-content -->

<script src="../assets/js/admin-script.js"></script>

</body>
</html>