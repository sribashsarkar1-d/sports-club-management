<?php
include '../../config/session.php';
include '../../config/database.php';

if(!isset($_SESSION['athlete_logged_in'])){
  header("Location: ../auth/login.php");
  exit();
}

$application_no = mysqli_real_escape_string($conn, $_SESSION['athlete_application_no']);
$sql = "
SELECT 
    a.*, 
    g.father_name, g.mother_name, g.guardian_name, g.guardian_mobile, g.relation_with_athlete AS relationship,
    addr.state, addr.district, addr.city, addr.pin_code, addr.village, addr.home_address,
    c.club_name, c.coach_name, c.coach_mobile, c.state_association,
    comp.competition_name, comp.age_group, comp.weight_category, comp.competition_level AS participation_level
FROM athletes a
LEFT JOIN guardians g ON a.athlete_id = g.athlete_id
LEFT JOIN addresses addr ON a.athlete_id = addr.athlete_id
LEFT JOIN clubs c ON a.athlete_id = c.athlete_id
LEFT JOIN competitions comp ON a.athlete_id = comp.athlete_id
WHERE a.registration_no = '$application_no'
";
$query = mysqli_query($conn, $sql);

if(mysqli_num_rows($query) == 0){
  header("Location: ../registration/register.php");
  exit();
}

$athlete = mysqli_fetch_assoc($query);
$status = $athlete['athlete_status'] ?? $athlete['status'] ?? 'Pending';
$statusClass = "pending";
if($status == "Approved") $statusClass = "approved";
if($status == "Rejected") $statusClass = "rejected";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Profile</title>
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
      <a href="dashboard.php" class="topbar-link">Dashboard</a>
      <a href="view-profile.php" class="topbar-link active">Profile</a>
      <a href="invoices.php" class="topbar-link">Invoices</a>
      <a href="documents.php" class="topbar-link">Documents</a>
      <a href="tournaments.php" class="topbar-link">Tournaments</a>
      <a href="../auth/logout.php" class="topbar-link">Log Out</a>
    </nav>
  </header>

  <main class="db-content">

    <div class="page-heading">
      <div>
        <p class="eyebrow">Athlete Profile</p>
        <h1 class="form-title" style="margin:0;"><?php echo htmlspecialchars($athlete['full_name']); ?></h1>
      </div>
      <span class="status-badge <?php echo $statusClass; ?>" style="align-self:flex-start;">
        <?php echo htmlspecialchars($status); ?>
      </span>
    </div>

    <!-- Personal Info -->
    <div class="info-table-card anim-fade-up delay-100">
      <div class="info-table-head"><span class="info-table-head-title">Personal Information</span></div>
      <div class="info-table-body">
        <div class="info-row"><span class="info-key">Full Name</span><span class="info-val"><?php echo htmlspecialchars($athlete['full_name']); ?></span></div>
        <div class="info-row"><span class="info-key">Email</span><span class="info-val"><?php echo htmlspecialchars($athlete['email']); ?></span></div>
        <div class="info-row"><span class="info-key">Mobile</span><span class="info-val"><?php echo htmlspecialchars($athlete['mobile']); ?></span></div>
        <div class="info-row"><span class="info-key">Gender</span><span class="info-val"><?php echo htmlspecialchars($athlete['gender']); ?></span></div>
        <div class="info-row"><span class="info-key">Date of Birth</span><span class="info-val"><?php echo htmlspecialchars($athlete['dob']); ?></span></div>
        <div class="info-row"><span class="info-key">Age</span><span class="info-val"><?php echo htmlspecialchars($athlete['age']); ?> years</span></div>
        <div class="info-row"><span class="info-key">Blood Group</span><span class="info-val"><?php echo htmlspecialchars($athlete['blood_group']); ?></span></div>
      </div>
    </div>

    <!-- Guardian Info -->
    <div class="info-table-card anim-fade-up delay-150">
      <div class="info-table-head"><span class="info-table-head-title">Guardian Information</span></div>
      <div class="info-table-body">
        <div class="info-row"><span class="info-key">Father's Name</span><span class="info-val"><?php echo htmlspecialchars($athlete['father_name'] ?? '—'); ?></span></div>
        <div class="info-row"><span class="info-key">Mother's Name</span><span class="info-val"><?php echo htmlspecialchars($athlete['mother_name'] ?? '—'); ?></span></div>
        <div class="info-row"><span class="info-key">Guardian Mobile</span><span class="info-val"><?php echo htmlspecialchars($athlete['guardian_mobile'] ?? '—'); ?></span></div>
        <div class="info-row"><span class="info-key">Relationship</span><span class="info-val"><?php echo htmlspecialchars($athlete['relationship'] ?? '—'); ?></span></div>
      </div>
    </div>

    <!-- Address -->
    <div class="info-table-card anim-fade-up delay-200">
      <div class="info-table-head"><span class="info-table-head-title">Address</span></div>
      <div class="info-table-body">
        <div class="info-row"><span class="info-key">State</span><span class="info-val"><?php echo htmlspecialchars($athlete['state'] ?? '—'); ?></span></div>
        <div class="info-row"><span class="info-key">District</span><span class="info-val"><?php echo htmlspecialchars($athlete['district'] ?? '—'); ?></span></div>
        <div class="info-row"><span class="info-key">City</span><span class="info-val"><?php echo htmlspecialchars($athlete['city'] ?? '—'); ?></span></div>
        <div class="info-row"><span class="info-key">PIN Code</span><span class="info-val"><?php echo htmlspecialchars($athlete['pin_code'] ?? '—'); ?></span></div>
        <div class="info-row"><span class="info-key">Village</span><span class="info-val"><?php echo htmlspecialchars($athlete['village'] ?? '—'); ?></span></div>
        <div class="info-row"><span class="info-key">Home Address</span><span class="info-val"><?php echo htmlspecialchars($athlete['home_address'] ?? '—'); ?></span></div>
      </div>
    </div>

    <!-- Club & Competition -->
    <div class="info-table-card anim-fade-up delay-250">
      <div class="info-table-head"><span class="info-table-head-title">Club &amp; Competition</span></div>
      <div class="info-table-body">
        <div class="info-row"><span class="info-key">Club Name</span><span class="info-val"><?php echo htmlspecialchars($athlete['club_name'] ?? '—'); ?></span></div>
        <div class="info-row"><span class="info-key">Coach Name</span><span class="info-val"><?php echo htmlspecialchars($athlete['coach_name'] ?? '—'); ?></span></div>
        <div class="info-row"><span class="info-key">Coach Mobile</span><span class="info-val"><?php echo htmlspecialchars($athlete['coach_mobile'] ?? '—'); ?></span></div>
        <div class="info-row"><span class="info-key">State Association</span><span class="info-val"><?php echo htmlspecialchars($athlete['state_association'] ?? '—'); ?></span></div>
        <div class="info-row"><span class="info-key">Sport</span><span class="info-val"><?php echo htmlspecialchars($athlete['competition_name'] ?? '—'); ?></span></div>
        <div class="info-row"><span class="info-key">Age Group</span><span class="info-val"><?php echo htmlspecialchars($athlete['age_group'] ?? '—'); ?></span></div>
        <div class="info-row"><span class="info-key">Weight Category</span><span class="info-val"><?php echo htmlspecialchars($athlete['weight_category'] ?? '—'); ?></span></div>
        <div class="info-row"><span class="info-key">Participation Level</span><span class="info-val"><?php echo htmlspecialchars($athlete['participation_level'] ?? '—'); ?></span></div>
      </div>
    </div>

    <div style="display:flex; gap:12px; margin-top:8px; flex-wrap:wrap;">
      <a href="../../athlete/download-pdf.php?application_no=<?php echo urlencode($athlete['registration_no']); ?>" class="btn-navy">
        &#11015;&nbsp; Download PDF
      </a>
        <a href="edit-profile.php" class="btn-navy" style="text-decoration:none;">
          <i class="bi bi-pencil-square"></i> Edit Profile
        </a>
      <a href="dashboard.php" class="btn-ghost" style="color:var(--clr-graphite); border-color:var(--clr-border);">
        &larr; Dashboard
      </a>
    </div>

  </main>

</div>

</body>
</html>
