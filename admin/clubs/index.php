<?php
$activePage = 'clubs';
include '../../config/session.php';
include '../../config/database.php';

if(!isset($_SESSION['admin_id'])){
    header("Location: ../auth/login.php");
    exit;
}

/* ── Queries ── */
$query = mysqli_query(
    $conn,
    "SELECT c.club_id, c.club_name, c.club_registration_no, c.coach_name, c.state_association, c.created_at, a.full_name as athlete_name
     FROM clubs c
     LEFT JOIN athletes a ON c.athlete_id = a.athlete_id
     ORDER BY c.club_id DESC"
);

$statsQ = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM clubs"
);
$stats = mysqli_fetch_assoc($statsQ);
$total = (int)($stats['total'] ?? 0);
$approved = $total; // Status field doesn't exist, assume all approved
$pending  = 0;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="../assets/images/logo.svg">
    <title>Clubs & Coaches — Sports Management</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin-style.css">
    <style>
        .page-actions { margin-left: auto; display: flex; gap: 10px; }
        .btn-primary { background: var(--primary-color, #000052); color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; font-weight: 500; }
        .btn-primary:hover { background: #000075; color: white; }
    </style>
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
            <h1>Clubs Management</h1>
            <p>Manage registered clubs, their coaches, and athletes</p>
        </div>
        <div class="page-actions">
            <a href="create.php" class="btn-primary">
                <i class="bi bi-plus-lg"></i> Add New Club
            </a>
            <a href="coaches.php" class="btn-primary" style="background: #008060;">
                <i class="bi bi-person-badge"></i> Manage Coaches
            </a>
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="stats-grid" style="grid-template-columns: repeat(3, 1fr);">
        <div class="stat-card stat-card--total">
            <div class="stat-card-top">
                <span class="stat-card-label">Total Clubs</span>
                <div class="stat-card-icon"><i class="bi bi-building"></i></div>
            </div>
            <div class="stat-card-number"><?php echo $total; ?></div>
        </div>
        <div class="stat-card stat-card--approved">
            <div class="stat-card-top">
                <span class="stat-card-label">Approved Clubs</span>
                <div class="stat-card-icon"><i class="bi bi-check-circle-fill"></i></div>
            </div>
            <div class="stat-card-number"><?php echo $approved; ?></div>
        </div>
        <div class="stat-card stat-card--pending">
            <div class="stat-card-top">
                <span class="stat-card-label">Pending Approval</span>
                <div class="stat-card-icon"><i class="bi bi-hourglass-split"></i></div>
            </div>
            <div class="stat-card-number"><?php echo $pending; ?></div>
        </div>
    </div>

    <!-- Control Bar: Search -->
    <div class="control-bar">
        <div class="search-wrapper">
            <i class="bi bi-search search-icon"></i>
            <input type="text" id="searchInput" class="search-input" placeholder="Search by club name…" autocomplete="off">
        </div>
    </div>

    <!-- Table -->
    <div class="table-card">
        <div class="table-card-header">
            <span class="table-card-title">
                <i class="bi bi-table"></i> Registered Clubs
            </span>
        </div>

        <div class="athletes-table-wrap">
            <table class="athletes-table" id="dataTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Club Name</th>
                        <th>Reg. Number</th>
                        <th>Coach Name</th>
                        <th>Athlete Linked</th>
                        <th>State Association</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(mysqli_num_rows($query) > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($query)): ?>
                    <tr class="athlete-row">
                        <td class="athlete-id-cell">#<?php echo $row['club_id']; ?></td>
                        <td><span class="athlete-name-cell"><?php echo htmlspecialchars($row['club_name'] ?? ''); ?></span></td>
                        <td><?php echo htmlspecialchars($row['club_registration_no'] ?? '—'); ?></td>
                        <td><?php echo htmlspecialchars($row['coach_name'] ?? '—'); ?></td>
                        <td><?php echo htmlspecialchars($row['athlete_name'] ?? '—'); ?></td>
                        <td><?php echo htmlspecialchars($row['state_association'] ?? '—'); ?></td>
                        <td>
                            <a href="view.php?id=<?php echo $row['club_id']; ?>" class="btn-view">
                                <i class="bi bi-eye"></i> View
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 30px;">No clubs found.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
</div>

<script src="../assets/js/admin-script.js"></script>
<script>
    // Simple frontend search matching existing script
    document.getElementById('searchInput')?.addEventListener('input', function(e) {
        let term = e.target.value.toLowerCase();
        let rows = document.querySelectorAll('#dataTable tbody tr.athlete-row');
        rows.forEach(row => {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(term) ? '' : 'none';
        });
    });
</script>
</body>
</html>
