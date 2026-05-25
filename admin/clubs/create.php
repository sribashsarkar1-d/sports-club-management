<?php
$activePage = 'clubs';
include '../../config/session.php';
include '../../config/database.php';

if(!isset($_SESSION['admin_id'])){
    header("Location: ../auth/login.php");
    exit;
}

$message = "";

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create_club'])) {
    $athlete_id = intval($_POST['athlete_id']);
    $club_name = mysqli_real_escape_string($conn, $_POST['club_name']);
    $club_registration_no = mysqli_real_escape_string($conn, $_POST['club_registration_no']);
    $state_association = mysqli_real_escape_string($conn, $_POST['state_association']);
    $association_id = mysqli_real_escape_string($conn, $_POST['association_id']);
    $training_address = mysqli_real_escape_string($conn, $_POST['training_address']);
    $coach_name = mysqli_real_escape_string($conn, $_POST['coach_name']);
    $coach_mobile = mysqli_real_escape_string($conn, $_POST['coach_mobile']);
    $coach_email = mysqli_real_escape_string($conn, $_POST['coach_email']);
    $experience_years = intval($_POST['experience_years']);

    if($club_name != '') {
        $insert = mysqli_query($conn, "INSERT INTO clubs 
            (athlete_id, club_name, club_registration_no, state_association, association_id, training_address, coach_name, coach_mobile, coach_email, experience_years) 
            VALUES 
            ('$athlete_id', '$club_name', '$club_registration_no', '$state_association', '$association_id', '$training_address', '$coach_name', '$coach_mobile', '$coach_email', '$experience_years')");
        
        if($insert) {
            $message = "<div class='alert alert-success'>Club created successfully.</div>";
        } else {
            $message = "<div class='alert alert-danger'>Failed to create club. " . mysqli_error($conn) . "</div>";
        }
    } else {
        $message = "<div class='alert alert-danger'>Club Name is required.</div>";
    }
}

// Fetch athletes for dropdown (if needed to link a club to an athlete directly)
$athletesQ = mysqli_query($conn, "SELECT athlete_id, full_name, mobile FROM athletes ORDER BY full_name ASC");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Club — Sports Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin-style.css">
    <style>
        .card { background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); margin: 0 auto; max-width: 800px; }
        .card-title { font-size: 18px; font-weight: 600; color: #1e293b; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid #e2e8f0; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .form-group { margin-bottom: 15px; }
        .form-group.full-width { grid-column: span 2; }
        .form-label { display: block; margin-bottom: 5px; font-weight: 500; color: #475569; }
        .form-control { width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-family: inherit; }
        .btn-primary { background: var(--primary-color, #000052); color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; font-weight: 500; width: 100%; }
        .alert { padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .alert-success { background: #dcfce7; color: #166534; }
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
            <h1>Add New Club</h1>
            <p>Register a new club and its head coach</p>
        </div>
    </div>

    <?php if($message) echo $message; ?>

    <div class="card">
        <h2 class="card-title">Club & Coach Details</h2>
        <form method="POST">
            
            <div class="form-group full-width">
                <label class="form-label">Link to Athlete (Optional)</label>
                <select name="athlete_id" class="form-control">
                    <option value="0">-- No Specific Athlete Linked --</option>
                    <?php while($ath = mysqli_fetch_assoc($athletesQ)): ?>
                        <option value="<?php echo $ath['athlete_id']; ?>">
                            <?php echo htmlspecialchars($ath['full_name']) . ' (' . htmlspecialchars($ath['mobile']) . ')'; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Club Name <span style="color:red">*</span></label>
                    <input type="text" name="club_name" class="form-control" placeholder="e.g. Star Athletics Club" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Club Registration No.</label>
                    <input type="text" name="club_registration_no" class="form-control" placeholder="e.g. CLUB12345">
                </div>

                <div class="form-group">
                    <label class="form-label">State Association</label>
                    <input type="text" name="state_association" class="form-control" placeholder="e.g. Maharashtra Athletics">
                </div>

                <div class="form-group">
                    <label class="form-label">Association ID</label>
                    <input type="text" name="association_id" class="form-control" placeholder="e.g. ASSOC-MH-001">
                </div>

                <div class="form-group">
                    <label class="form-label">Head Coach Name</label>
                    <input type="text" name="coach_name" class="form-control" placeholder="e.g. John Doe">
                </div>

                <div class="form-group">
                    <label class="form-label">Coach Experience (Years)</label>
                    <input type="number" name="experience_years" class="form-control" placeholder="e.g. 5">
                </div>

                <div class="form-group">
                    <label class="form-label">Coach Mobile</label>
                    <input type="text" name="coach_mobile" class="form-control" placeholder="e.g. 9876543210">
                </div>

                <div class="form-group">
                    <label class="form-label">Coach Email</label>
                    <input type="email" name="coach_email" class="form-control" placeholder="e.g. coach@example.com">
                </div>
            </div>
            
            <div class="form-group full-width">
                <label class="form-label">Training Address</label>
                <textarea name="training_address" class="form-control" rows="3" placeholder="Full address of the club's training ground..."></textarea>
            </div>

            <div class="form-group full-width" style="margin-top: 10px;">
                <button type="submit" name="create_club" class="btn-primary">Register Club</button>
            </div>
        </form>
    </div>

</div>
</div>

<script src="../assets/js/admin-script.js"></script>
</body>
</html>
