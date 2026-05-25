<?php
$activePage = 'tournaments';
include '../../config/session.php';
include '../../config/database.php';

if(!isset($_SESSION['admin_id'])){
    header("Location: ../auth/login.php");
    exit;
}

$query = mysqli_query(
    $conn,
    "SELECT c.competition_id, c.competition_name, c.event_name, c.age_group, c.competition_level, c.created_at, a.full_name as athlete_name
     FROM competitions c
     LEFT JOIN athletes a ON c.athlete_id = a.athlete_id
     ORDER BY c.competition_id DESC"
);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tournaments — Sports Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin-style.css">
    <style>
        .page-actions { margin-left: auto; display: flex; gap: 10px; }
        .btn-primary { background: var(--primary-color, #000052); color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; font-weight: 500; }
    </style>
</head>

<body>
<?php include '../layouts/sidebar.php'; ?>
<?php include '../layouts/navbar.php'; ?>

<div class="main-content">
<div class="page-body">

    <div class="dash-header">
        <div class="dash-header-left">
            <h1>Tournaments & Events</h1>
            <p>Manage competitions, venues, and schedules</p>
        </div>
        <div class="page-actions">
            <a href="create.php" class="btn-primary">
                <i class="bi bi-plus-lg"></i> Create Competition
            </a>
        </div>
    </div>

    <div class="table-card">
        <div class="table-card-header">
            <span class="table-card-title">
                <i class="bi bi-trophy"></i> Competitions List
            </span>
        </div>

        <div class="athletes-table-wrap">
            <table class="athletes-table" id="dataTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Competition Name</th>
                        <th>Event Name</th>
                        <th>Age Group</th>
                        <th>Level</th>
                        <th>Athlete Linked</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(mysqli_num_rows($query) > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($query)): ?>
                    <tr class="athlete-row">
                        <td>#<?php echo $row['competition_id']; ?></td>
                        <td><strong><?php echo htmlspecialchars($row['competition_name'] ?? ''); ?></strong></td>
                        <td><?php echo htmlspecialchars($row['event_name'] ?? '—'); ?></td>
                        <td><?php echo htmlspecialchars($row['age_group'] ?? '—'); ?></td>
                        <td><span class="status-badge status-badge--pending" style="background: #eef2ff; color: #4338ca;"><?php echo htmlspecialchars($row['competition_level'] ?? '—'); ?></span></td>
                        <td><?php echo htmlspecialchars($row['athlete_name'] ?? '—'); ?></td>
                        <td>
                            <a href="view.php?id=<?php echo $row['competition_id']; ?>" class="btn-view">
                                <i class="bi bi-eye"></i> Manage
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 30px;">No competitions found.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
</div>

<script src="../assets/js/admin-script.js"></script>
</body>
</html>
