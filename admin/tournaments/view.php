<?php
$activePage = 'tournaments';
include '../../config/session.php';
include '../../config/database.php';

if(!isset($_SESSION['admin_id'])){
    header("Location: ../auth/login.php");
    exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if(!$id) {
    header("Location: index.php");
    exit;
}

$message = "";

// Handle Delete
if(isset($_POST['delete_entry'])) {
    $del = mysqli_query($conn, "DELETE FROM competitions WHERE competition_id = $id");
    if($del) {
        header("Location: index.php");
        exit;
    } else {
        $message = "<div class='alert alert-danger'>Failed to delete entry.</div>";
    }
}

// Fetch competition entry details
$query = mysqli_query(
    $conn,
    "SELECT c.*, a.full_name, a.mobile, a.registration_no, a.email 
     FROM competitions c 
     LEFT JOIN athletes a ON c.athlete_id = a.athlete_id 
     WHERE c.competition_id = $id"
);
$comp = mysqli_fetch_assoc($query);

if(!$comp) {
    die("Competition entry not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Competition Entry — Sports Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin-style.css">
    <style>
        .page-actions { margin-left: auto; display: flex; gap: 10px; }
        .btn-primary { background: var(--primary-color, #000052); color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; font-weight: 500; }
        .btn-danger { background: #dc2626; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; font-weight: 500; }
        .card { background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); margin-bottom: 20px; }
        .card-title { font-size: 18px; font-weight: 600; color: #1e293b; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid #e2e8f0; }
        .info-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; margin-bottom: 20px; }
        .info-item { background: #f8fafc; padding: 15px; border-radius: 8px; border: 1px solid #e2e8f0; }
        .info-item label { display: block; color: #64748b; font-size: 13px; margin-bottom: 5px; text-transform: uppercase; letter-spacing: 0.5px; }
        .info-item div { font-weight: 600; color: #0f172a; font-size: 15px; }
        .alert { padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .alert-danger { background: #fee2e2; color: #991b1b; }
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
                <i class="bi bi-arrow-left"></i> Back to Tournaments
            </a>
            <h1>Competition Entry #<?php echo $comp['competition_id']; ?></h1>
            <p>Viewing registration details for <?php echo htmlspecialchars($comp['competition_name']); ?></p>
        </div>
        <div class="page-actions">
            <form method="POST" onsubmit="return confirm('Are you sure you want to delete this entry?');">
                <button type="submit" name="delete_entry" class="btn-danger">
                    <i class="bi bi-trash"></i> Delete Entry
                </button>
            </form>
        </div>
    </div>

    <?php if($message) echo $message; ?>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
        
        <div class="card">
            <h2 class="card-title">Competition Details</h2>
            <div class="info-grid">
                <div class="info-item">
                    <label>Competition Name</label>
                    <div><?php echo htmlspecialchars($comp['competition_name'] ?? 'N/A'); ?></div>
                </div>
                <div class="info-item">
                    <label>Event Name</label>
                    <div><?php echo htmlspecialchars($comp['event_name'] ?? 'N/A'); ?></div>
                </div>
                <div class="info-item">
                    <label>Level</label>
                    <div><span class="status-badge status-badge--pending" style="background: #eef2ff; color: #4338ca;"><?php echo htmlspecialchars($comp['competition_level'] ?? 'N/A'); ?></span></div>
                </div>
                <div class="info-item">
                    <label>Age Group</label>
                    <div><?php echo htmlspecialchars($comp['age_group'] ?? 'N/A'); ?></div>
                </div>
                <div class="info-item">
                    <label>Gender Category</label>
                    <div><?php echo htmlspecialchars($comp['gender_category'] ?? 'N/A'); ?></div>
                </div>
                <div class="info-item">
                    <label>Weight Category</label>
                    <div><?php echo htmlspecialchars($comp['weight_category'] ?? 'N/A'); ?></div>
                </div>
                <div class="info-item">
                    <label>Participation Year</label>
                    <div><?php echo htmlspecialchars($comp['participation_year'] ?? 'N/A'); ?></div>
                </div>
                <div class="info-item">
                    <label>Experience</label>
                    <div><?php echo htmlspecialchars($comp['competition_experience'] ?? 'N/A'); ?></div>
                </div>
            </div>

            <div class="info-item" style="margin-bottom: 15px;">
                <label>Previous Achievements</label>
                <div style="font-weight: normal;"><?php echo nl2br(htmlspecialchars($comp['previous_achievement'] ?: 'None specified')); ?></div>
            </div>

            <div class="info-item">
                <label>Medical Condition</label>
                <div style="font-weight: normal;"><?php echo nl2br(htmlspecialchars($comp['medical_condition'] ?: 'None specified')); ?></div>
            </div>
        </div>

        <div>
            <div class="card">
                <h2 class="card-title">Athlete Profile</h2>
                <div style="text-align: center; margin-bottom: 20px;">
                    <div style="width: 80px; height: 80px; border-radius: 50%; background: #e2e8f0; display: inline-flex; align-items: center; justify-content: center; font-size: 32px; color: #94a3b8; margin-bottom: 10px;">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <div style="font-weight: 600; font-size: 18px; color: #0f172a;"><?php echo htmlspecialchars($comp['full_name']); ?></div>
                    <div style="color: #64748b; font-size: 14px;"><?php echo htmlspecialchars($comp['registration_no'] ?? 'N/A'); ?></div>
                </div>
                
                <div style="border-top: 1px solid #e2e8f0; padding-top: 15px;">
                    <div style="margin-bottom: 10px;">
                        <span style="color: #64748b; font-size: 13px;"><i class="bi bi-telephone-fill"></i> Mobile:</span><br>
                        <strong><?php echo htmlspecialchars($comp['mobile']); ?></strong>
                    </div>
                    <div>
                        <span style="color: #64748b; font-size: 13px;"><i class="bi bi-envelope-fill"></i> Email:</span><br>
                        <strong><?php echo htmlspecialchars($comp['email']); ?></strong>
                    </div>
                </div>
                
                <div style="margin-top: 20px;">
                    <a href="../dashboard/athlete-view.php?id=<?php echo $comp['athlete_id']; ?>" class="btn-primary" style="text-align: center; display: block; background: #f1f5f9; color: #0f172a; border: 1px solid #cbd5e1;">View Full Profile</a>
                </div>
            </div>

            <div class="card">
                <h2 class="card-title">Registration Info</h2>
                <div style="margin-bottom: 10px;">
                    <span style="color: #64748b; font-size: 13px;">Registered On:</span><br>
                    <strong><?php echo date('d M Y, h:i A', strtotime($comp['created_at'])); ?></strong>
                </div>
            </div>
        </div>

    </div>

</div>
</div>

<script src="../assets/js/admin-script.js"></script>
</body>
</html>
