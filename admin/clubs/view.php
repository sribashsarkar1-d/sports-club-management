<?php
$activePage = 'clubs';
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
if(isset($_POST['delete_club'])) {
    $del = mysqli_query($conn, "DELETE FROM clubs WHERE club_id = $id");
    if($del) {
        header("Location: index.php");
        exit;
    } else {
        $message = "<div class='alert alert-danger'>Failed to delete club.</div>";
    }
}

// Fetch club details
$query = mysqli_query(
    $conn,
    "SELECT c.*, a.full_name as athlete_name, a.mobile as athlete_mobile, a.registration_no 
     FROM clubs c 
     LEFT JOIN athletes a ON c.athlete_id = a.athlete_id 
     WHERE c.club_id = $id"
);
$club = mysqli_fetch_assoc($query);

if(!$club) {
    die("Club record not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Club — Sports Management</title>
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
                <i class="bi bi-arrow-left"></i> Back to Clubs
            </a>
            <h1>Club Detail #<?php echo $club['club_id']; ?></h1>
            <p>Viewing detailed profile for <?php echo htmlspecialchars($club['club_name']); ?></p>
        </div>
        <div class="page-actions">
            <form method="POST" onsubmit="return confirm('Are you sure you want to delete this club record?');">
                <button type="submit" name="delete_club" class="btn-danger">
                    <i class="bi bi-trash"></i> Delete Club
                </button>
            </form>
        </div>
    </div>

    <?php if($message) echo $message; ?>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
        
        <!-- Left Side: Club & Coach Details -->
        <div>
            <div class="card">
                <h2 class="card-title"><i class="bi bi-building"></i> Club Information</h2>
                <div class="info-grid">
                    <div class="info-item">
                        <label>Club Name</label>
                        <div><?php echo htmlspecialchars($club['club_name'] ?? 'N/A'); ?></div>
                    </div>
                    <div class="info-item">
                        <label>Registration Number</label>
                        <div><?php echo htmlspecialchars($club['club_registration_no'] ?? 'N/A'); ?></div>
                    </div>
                    <div class="info-item">
                        <label>State Association</label>
                        <div><?php echo htmlspecialchars($club['state_association'] ?? 'N/A'); ?></div>
                    </div>
                    <div class="info-item">
                        <label>Association ID</label>
                        <div><?php echo htmlspecialchars($club['association_id'] ?? 'N/A'); ?></div>
                    </div>
                </div>

                <div class="info-item" style="margin-bottom: 15px;">
                    <label>Training Address</label>
                    <div style="font-weight: normal; line-height: 1.5;"><?php echo nl2br(htmlspecialchars($club['training_address'] ?: 'None specified')); ?></div>
                </div>
                <div class="info-item">
                    <label>Registration Date</label>
                    <div style="font-weight: normal;"><?php echo date('d M Y, h:i A', strtotime($club['created_at'])); ?></div>
                </div>
            </div>

            <div class="card">
                <h2 class="card-title"><i class="bi bi-person-badge"></i> Head Coach Details</h2>
                <div class="info-grid">
                    <div class="info-item">
                        <label>Coach Name</label>
                        <div><?php echo htmlspecialchars($club['coach_name'] ?? 'N/A'); ?></div>
                    </div>
                    <div class="info-item">
                        <label>Experience</label>
                        <div><?php echo htmlspecialchars($club['experience_years'] ?? '0'); ?> Years</div>
                    </div>
                    <div class="info-item">
                        <label>Mobile Number</label>
                        <div><?php echo htmlspecialchars($club['coach_mobile'] ?? 'N/A'); ?></div>
                    </div>
                    <div class="info-item">
                        <label>Email Address</label>
                        <div><?php echo htmlspecialchars($club['coach_email'] ?? 'N/A'); ?></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Linked Athlete -->
        <div>
            <div class="card">
                <h2 class="card-title">Linked Athlete Profile</h2>
                <?php if($club['athlete_id']): ?>
                    <div style="text-align: center; margin-bottom: 20px;">
                        <div style="width: 80px; height: 80px; border-radius: 50%; background: #e2e8f0; display: inline-flex; align-items: center; justify-content: center; font-size: 32px; color: #94a3b8; margin-bottom: 10px;">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <div style="font-weight: 600; font-size: 18px; color: #0f172a;"><?php echo htmlspecialchars($club['athlete_name']); ?></div>
                        <div style="color: #64748b; font-size: 14px;"><?php echo htmlspecialchars($club['registration_no'] ?? 'N/A'); ?></div>
                    </div>
                    
                    <div style="border-top: 1px solid #e2e8f0; padding-top: 15px;">
                        <div style="margin-bottom: 10px;">
                            <span style="color: #64748b; font-size: 13px;"><i class="bi bi-telephone-fill"></i> Mobile:</span><br>
                            <strong><?php echo htmlspecialchars($club['athlete_mobile']); ?></strong>
                        </div>
                    </div>
                    
                    <div style="margin-top: 20px;">
                        <a href="../dashboard/athlete-view.php?id=<?php echo $club['athlete_id']; ?>" class="btn-primary" style="text-align: center; display: block; background: #f1f5f9; color: #0f172a; border: 1px solid #cbd5e1;">View Full Profile</a>
                    </div>
                <?php else: ?>
                    <div style="text-align: center; color: #64748b; padding: 20px;">
                        <i class="bi bi-dash-circle" style="font-size: 24px; display: block; margin-bottom: 10px;"></i>
                        No specific athlete is linked to this club record.
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>

</div>
</div>

<script src="../assets/js/admin-script.js"></script>
</body>
</html>
