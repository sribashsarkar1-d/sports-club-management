<?php
$activePage = 'tournaments';
include '../../config/session.php';
include '../../config/database.php';

if(!isset($_SESSION['admin_id'])){
    header("Location: ../auth/login.php");
    exit;
}

$message = "";

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create_competition'])) {
    $athlete_id = intval($_POST['athlete_id']);
    $competition_name = mysqli_real_escape_string($conn, $_POST['competition_name']);
    $event_name = mysqli_real_escape_string($conn, $_POST['event_name']);
    $age_group = mysqli_real_escape_string($conn, $_POST['age_group']);
    $gender_category = mysqli_real_escape_string($conn, $_POST['gender_category']);
    $weight_category = mysqli_real_escape_string($conn, $_POST['weight_category']);
    $competition_level = mysqli_real_escape_string($conn, $_POST['competition_level']);
    $competition_experience = mysqli_real_escape_string($conn, $_POST['competition_experience']);
    $previous_achievement = mysqli_real_escape_string($conn, $_POST['previous_achievement']);
    $medical_condition = mysqli_real_escape_string($conn, $_POST['medical_condition']);
    $participation_year = intval($_POST['participation_year']);
    
    if($athlete_id > 0 && !empty($competition_name)) {
        $insert = mysqli_query($conn, "INSERT INTO competitions 
            (athlete_id, competition_name, event_name, age_group, gender_category, weight_category, competition_level, competition_experience, previous_achievement, medical_condition, participation_year) 
            VALUES 
            ('$athlete_id', '$competition_name', '$event_name', '$age_group', '$gender_category', '$weight_category', '$competition_level', '$competition_experience', '$previous_achievement', '$medical_condition', '$participation_year')");
        
        if($insert) {
            $message = "<div class='alert alert-success'>Competition entry created successfully.</div>";
        } else {
            $message = "<div class='alert alert-danger'>Failed to create competition entry. " . mysqli_error($conn) . "</div>";
        }
    } else {
        $message = "<div class='alert alert-danger'>Invalid input. Please fill all required fields.</div>";
    }
}

// Fetch athletes for dropdown
$athletesQ = mysqli_query($conn, "SELECT athlete_id, full_name, mobile FROM athletes ORDER BY full_name ASC");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Competition Entry — Sports Management</title>
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
                <i class="bi bi-arrow-left"></i> Back to Tournaments
            </a>
            <h1>Create Competition Entry</h1>
            <p>Register an athlete for a specific competition</p>
        </div>
    </div>

    <?php if($message) echo $message; ?>

    <div class="card">
        <h2 class="card-title">Entry Details</h2>
        <form method="POST">
            
            <div class="form-group full-width">
                <label class="form-label">Select Athlete <span style="color:red">*</span></label>
                <select name="athlete_id" class="form-control" required>
                    <option value="">-- Select Athlete --</option>
                    <?php while($ath = mysqli_fetch_assoc($athletesQ)): ?>
                        <option value="<?php echo $ath['athlete_id']; ?>">
                            <?php echo htmlspecialchars($ath['full_name']) . ' (' . htmlspecialchars($ath['mobile']) . ')'; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Competition Name <span style="color:red">*</span></label>
                    <input type="text" name="competition_name" class="form-control" placeholder="e.g. National Championship" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Event Name <span style="color:red">*</span></label>
                    <input type="text" name="event_name" class="form-control" placeholder="e.g. 100m Sprint" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Age Group</label>
                    <input type="text" name="age_group" class="form-control" placeholder="e.g. Under 18">
                </div>

                <div class="form-group">
                    <label class="form-label">Gender Category</label>
                    <select name="gender_category" class="form-control">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Mixed">Mixed</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Weight Category</label>
                    <input type="text" name="weight_category" class="form-control" placeholder="e.g. 60kg">
                </div>

                <div class="form-group">
                    <label class="form-label">Competition Level</label>
                    <select name="competition_level" class="form-control">
                        <option value="District">District</option>
                        <option value="State">State</option>
                        <option value="National">National</option>
                        <option value="International">International</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Participation Year</label>
                    <input type="number" name="participation_year" class="form-control" value="<?php echo date('Y'); ?>">
                </div>

                <div class="form-group">
                    <label class="form-label">Experience (Years)</label>
                    <input type="text" name="competition_experience" class="form-control" placeholder="e.g. 2 Years">
                </div>
            </div>
            
            <div class="form-group full-width">
                <label class="form-label">Previous Achievements</label>
                <textarea name="previous_achievement" class="form-control" rows="3" placeholder="Enter past achievements..."></textarea>
            </div>

            <div class="form-group full-width">
                <label class="form-label">Medical Condition (if any)</label>
                <textarea name="medical_condition" class="form-control" rows="2" placeholder="State any current medical conditions..."></textarea>
            </div>

            <div class="form-group full-width" style="margin-top: 10px;">
                <button type="submit" name="create_competition" class="btn-primary">Register for Competition</button>
            </div>
        </form>
    </div>

</div>
</div>

<script src="../assets/js/admin-script.js"></script>
</body>
</html>
