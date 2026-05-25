<?php
$activePage = 'clubs'; // Keep the clubs menu active
include '../../config/session.php';
include '../../config/database.php';

if(!isset($_SESSION['admin_id'])){
    header("Location: ../auth/login.php");
    exit;
}

// Query to get all coach data from the clubs table
$query = mysqli_query(
    $conn,
    "SELECT club_id, coach_name, coach_mobile, coach_email, experience_years, club_name, created_at 
     FROM clubs 
     WHERE coach_name IS NOT NULL AND coach_name != ''
     ORDER BY coach_name ASC"
);

// Get total stats for coaches
$totalCoaches = mysqli_num_rows($query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Coaches — Sports Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin-style.css">
    <style>
        .page-actions { margin-left: auto; display: flex; gap: 10px; }
        .btn-primary { background: var(--primary-color, #000052); color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; font-weight: 500; }
        .btn-outline { background: transparent; color: #475569; border: 1px solid #cbd5e1; padding: 10px 20px; border-radius: 8px; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; font-weight: 500; }
        .coach-avatar { width: 40px; height: 40px; border-radius: 50%; background: #e0e7ff; color: #4f46e5; display: inline-flex; align-items: center; justify-content: center; font-weight: bold; font-size: 14px; margin-right: 12px; }
        .coach-name-wrapper { display: flex; align-items: center; font-weight: 600; color: #0f172a; }
    </style>
</head>

<body>
<?php include '../layouts/sidebar.php'; ?>
<?php include '../layouts/navbar.php'; ?>

<div class="main-content">
<div class="page-body">

    <div class="dash-header">
        <div class="dash-header-left">
            <a href="index.php" style="color: #64748b; text-decoration: none; display: inline-flex; align-items: center; gap: 5px; margin-bottom: 10px;">
                <i class="bi bi-arrow-left"></i> Back to Clubs
            </a>
            <h1>Coaches Directory</h1>
            <p>View and manage all head coaches affiliated with registered clubs</p>
        </div>
        <div class="page-actions">
            <a href="create.php" class="btn-primary">
                <i class="bi bi-plus-lg"></i> Add New Coach (via Club)
            </a>
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="stats-grid" style="grid-template-columns: repeat(1, 1fr); max-width: 400px; margin-bottom: 25px;">
        <div class="stat-card stat-card--approved">
            <div class="stat-card-top">
                <span class="stat-card-label">Total Registered Coaches</span>
                <div class="stat-card-icon"><i class="bi bi-person-video3"></i></div>
            </div>
            <div class="stat-card-number"><?php echo $totalCoaches; ?></div>
        </div>
    </div>

    <div class="table-card">
        <div class="table-card-header">
            <span class="table-card-title">
                <i class="bi bi-list-ul"></i> All Coaches
            </span>
        </div>

        <div class="athletes-table-wrap">
            <table class="athletes-table" id="dataTable">
                <thead>
                    <tr>
                        <th>Coach Name</th>
                        <th>Affiliated Club</th>
                        <th>Experience</th>
                        <th>Mobile Number</th>
                        <th>Email Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php if($totalCoaches > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($query)): 
                        // Generate initials for avatar
                        $words = explode(" ", $row['coach_name']);
                        $initials = strtoupper(substr($words[0], 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ''));
                    ?>
                    <tr class="athlete-row">
                        <td>
                            <div class="coach-name-wrapper">
                                <div class="coach-avatar"><?php echo $initials; ?></div>
                                <?php echo htmlspecialchars($row['coach_name']); ?>
                            </div>
                        </td>
                        <td><?php echo htmlspecialchars($row['club_name'] ?? '—'); ?></td>
                        <td><?php echo htmlspecialchars($row['experience_years'] ?? '0'); ?> Years</td>
                        <td><?php echo htmlspecialchars($row['coach_mobile'] ?? '—'); ?></td>
                        <td><?php echo htmlspecialchars($row['coach_email'] ?? '—'); ?></td>
                        <td>
                            <a href="view.php?id=<?php echo $row['club_id']; ?>" class="btn-outline">
                                <i class="bi bi-eye"></i> View Details
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 40px; color: #64748b;">No coaches found in the system. Coaches must be added when registering a Club.</td>
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
