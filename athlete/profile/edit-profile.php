<?php
include '../../config/session.php';
include '../../config/database.php';

if(!isset($_GET['application_no'])){
  header("Location: ../registration/register.php");
  exit();
}

$application_no = mysqli_real_escape_string($conn, $_GET['application_no']);
$query = mysqli_query($conn, "SELECT * FROM athletes WHERE registration_no='$application_no'");

if(mysqli_num_rows($query) == 0){
  header("Location: ../registration/register.php");
  exit();
}

$athlete = mysqli_fetch_assoc($query);
$updateSuccess = false;
$updateError = '';

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])){
  $mobile    = mysqli_real_escape_string($conn, $_POST['mobile']);
  $email     = mysqli_real_escape_string($conn, $_POST['email']);
  $home_addr = mysqli_real_escape_string($conn, $_POST['home_address']);
  $club_name = mysqli_real_escape_string($conn, $_POST['club_name']);
  $coach_name = mysqli_real_escape_string($conn, $_POST['coach_name']);
  $coach_mobile = mysqli_real_escape_string($conn, $_POST['coach_mobile']);

  $update = mysqli_query($conn,
    "UPDATE athletes SET
      mobile='$mobile', email='$email', home_address='$home_addr',
      club_name='$club_name', coach_name='$coach_name', coach_mobile='$coach_mobile'
    WHERE registration_no='$application_no'"
  );

  if($update){
    $updateSuccess = true;
    // Refresh athlete data
    $q2 = mysqli_query($conn, "SELECT * FROM athletes WHERE registration_no='$application_no'");
    $athlete = mysqli_fetch_assoc($q2);
  } else {
    $updateError = "Update failed. Please try again.";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Profile</title>
<link rel="stylesheet" href="../../assets/css/athlete-style.css">
</head>
<body>

<div class="db-root">

  <header class="db-topbar">
    <div class="topbar-brand">
      <div class="topbar-logo">SCM</div>
      <div class="topbar-name">Sports Club <span>Management</span></div>
    </div>
    <nav class="topbar-nav">
      <a href="dashboard.php?application_no=<?php echo urlencode($athlete['registration_no']); ?>" class="topbar-link">Dashboard</a>
      <a href="view-profile.php?application_no=<?php echo urlencode($athlete['registration_no']); ?>" class="topbar-link">View Profile</a>
      <a href="../status-check.php" class="topbar-link">Status Check</a>
    </nav>
  </header>

  <main class="db-content">

    <div class="page-heading">
      <div>
        <p class="eyebrow">Profile Settings</p>
        <h1 class="form-title" style="margin:0;">Edit Profile</h1>
      </div>
    </div>

    <?php if($updateSuccess): ?>
    <div class="sc-alert sc-alert-success anim-fade-in" style="margin-bottom:24px;">
      Profile updated successfully!
    </div>
    <?php endif; ?>

    <?php if($updateError): ?>
    <div class="sc-alert anim-fade-in" style="margin-bottom:24px; border-color:var(--clr-error); background:rgba(255,51,102,0.08);">
      <?php echo htmlspecialchars($updateError); ?>
    </div>
    <?php endif; ?>

    <div class="info-table-card anim-fade-up delay-100">
      <div class="info-table-head"><span class="info-table-head-title">Update Contact &amp; Club Details</span></div>
      <div style="padding:28px 32px;">
        <form method="POST">

          <div class="grid-2">
            <div class="fg">
              <label>Email Address</label>
              <input type="email" name="email" class="sc-input" value="<?php echo htmlspecialchars($athlete['email']); ?>" required>
            </div>
            <div class="fg">
              <label>Mobile Number</label>
              <input type="text" name="mobile" id="mobile" class="sc-input" value="<?php echo htmlspecialchars($athlete['mobile']); ?>" maxlength="10" required>
              <span class="invalid-feedback">Enter a valid 10-digit number</span>
            </div>
            <div class="fg">
              <label>Club Name</label>
              <input type="text" name="club_name" class="sc-input" value="<?php echo htmlspecialchars($athlete['club_name']); ?>" required>
            </div>
            <div class="fg">
              <label>Coach Name</label>
              <input type="text" name="coach_name" class="sc-input" value="<?php echo htmlspecialchars($athlete['coach_name']); ?>" required>
            </div>
            <div class="fg">
              <label>Coach Mobile</label>
              <input type="text" name="coach_mobile" id="coach_mobile" class="sc-input" value="<?php echo htmlspecialchars($athlete['coach_mobile']); ?>" maxlength="10" required>
              <span class="invalid-feedback">Enter a valid 10-digit number</span>
            </div>
          </div>

          <div class="fg">
            <label>Home Address</label>
            <textarea name="home_address" class="sc-input" rows="3" style="resize:vertical; min-height:80px;"><?php echo htmlspecialchars($athlete['home_address']); ?></textarea>
          </div>

          <div style="display:flex; gap:12px; margin-top:8px; flex-wrap:wrap;">
            <button type="submit" name="update_profile" class="btn-navy">
              Save Changes
            </button>
            <a href="view-profile.php?application_no=<?php echo urlencode($athlete['registration_no']); ?>" class="btn-ghost" style="color:var(--clr-graphite); border-color:var(--clr-border);">
              Cancel
            </a>
          </div>

        </form>
      </div>
    </div>

  </main>

</div>

<script src="../../assets/js/athlete-script.js"></script>
</body>
</html>
