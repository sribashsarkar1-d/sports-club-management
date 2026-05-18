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
$status = $athlete['athlete_status'];
$statusClass = "pending";
if($status == "Approved") $statusClass = "approved";
if($status == "Rejected") $statusClass = "rejected";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Athlete Dashboard</title>
<link rel="stylesheet" href="../../assets/css/athlete-style.css">
</head>
<body>

<div class="db-root">

  <!-- ── Top Bar ── -->
  <header class="db-topbar">
    <div class="topbar-brand">
      <div class="topbar-logo">SCM</div>
      <div class="topbar-name">Sports Club <span>Management</span></div>
    </div>
    <nav class="topbar-nav">
      <a href="dashboard.php?application_no=<?php echo urlencode($athlete['registration_no']); ?>" class="topbar-link active">Dashboard</a>
      <a href="view-profile.php?application_no=<?php echo urlencode($athlete['registration_no']); ?>" class="topbar-link">View Profile</a>
      <a href="../status-check.php" class="topbar-link">Status Check</a>
    </nav>
  </header>

  <!-- ── Content ── -->
  <main class="db-content">

    <div class="page-heading">
      <div>
        <p class="eyebrow">Welcome Back</p>
        <h1 class="form-title" style="margin:0;"><?php echo htmlspecialchars($athlete['full_name']); ?></h1>
      </div>
      <span class="status-badge <?php echo $statusClass; ?>" style="align-self:flex-start;">
        <?php echo htmlspecialchars($status); ?>
      </span>
    </div>

    <!-- Stats Row -->
    <div class="stats-row">
      <div class="stat-card anim-fade-up delay-100">
        <div class="stat-card-label">Application No.</div>
        <div class="stat-card-value" style="font-size:1.1rem;"><?php echo htmlspecialchars($athlete['registration_no']); ?></div>
      </div>
      <div class="stat-card anim-fade-up delay-150">
        <div class="stat-card-label">Sport</div>
        <div class="stat-card-value"><?php echo htmlspecialchars($athlete['competition_name'] ?? '—'); ?></div>
      </div>
      <div class="stat-card anim-fade-up delay-200">
        <div class="stat-card-label">Age Group</div>
        <div class="stat-card-value"><?php echo htmlspecialchars($athlete['age_group'] ?? '—'); ?></div>
      </div>
      <div class="stat-card anim-fade-up delay-250">
        <div class="stat-card-label">Level</div>
        <div class="stat-card-value"><?php echo htmlspecialchars($athlete['participation_level'] ?? '—'); ?></div>
      </div>
    </div>

    <!-- Profile Hero Card -->
    <div class="profile-hero-card anim-fade-up delay-200">
      <div class="profile-hero-avatar">
        <img src="../assets/uploads/photos/<?php echo htmlspecialchars($athlete['profile_photo']); ?>" alt="Profile Photo">
      </div>
      <div class="profile-hero-info">
        <h2 class="profile-hero-name"><?php echo htmlspecialchars($athlete['full_name']); ?></h2>
        <p class="profile-hero-sub"><?php echo htmlspecialchars($athlete['email']); ?> &nbsp;&middot;&nbsp; <?php echo htmlspecialchars($athlete['mobile']); ?></p>
        <div style="display:flex; gap:12px; flex-wrap:wrap; margin-top:16px;">
          <a href="view-profile.php?application_no=<?php echo urlencode($athlete['registration_no']); ?>" class="btn-navy" style="padding:10px 24px; font-size:0.9rem;">
            View Full Profile
          </a>
          <a href="../../athlete/download-pdf.php?application_no=<?php echo urlencode($athlete['registration_no']); ?>" class="btn-ghost" style="padding:10px 24px; font-size:0.9rem; color:var(--clr-graphite); border-color:var(--clr-border);">
            Download PDF
          </a>
        </div>
      </div>
    </div>

  </main>

</div>

</body>
</html>
