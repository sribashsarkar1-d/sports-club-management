<?php
include '../../config/session.php';
include '../../config/database.php';

if(!isset($_SESSION['athlete_logged_in'])){
  header("Location: ../auth/login.php");
  exit();
}

$application_no = mysqli_real_escape_string($conn, $_SESSION['athlete_application_no']);
$query = mysqli_query($conn, "SELECT * FROM athletes WHERE registration_no='$application_no'");

if(mysqli_num_rows($query) == 0){
  header("Location: ../registration/register.php");
  exit();
}

$athlete = mysqli_fetch_assoc($query);
$athlete_id = $athlete['athlete_id'];

// Fetch Documents
$docsQ = mysqli_query($conn, "SELECT * FROM documents WHERE athlete_id = $athlete_id ORDER BY document_id DESC LIMIT 1");
$doc = mysqli_fetch_assoc($docsQ);

$statusRaw = $doc ? $doc['upload_status'] : 'Not Found';
$statusLower = strtolower($statusRaw);
$badgeClass = 'pending';
if($statusLower == 'verified') $badgeClass = 'paid';
if($statusLower == 'rejected') $badgeClass = 'unpaid';

function renderDocCard($label, $filename) {
    if(empty($filename)) {
        return '
        <div class="doc-card empty">
            <i class="bi bi-file-earmark-x"></i>
            <h4>'.$label.'</h4>
            <p>Not uploaded</p>
            <button class="btn-ghost" style="margin-top:10px; font-size:12px; padding:5px 10px;" onclick="alert(\'Upload feature temporarily disabled.\')">Upload Now</button>
        </div>';
    }
    
    return '
    <div class="doc-card">
        <i class="bi bi-file-earmark-check" style="color: #16a34a;"></i>
        <h4>'.$label.'</h4>
        <p>Uploaded Successfully</p>
        <a href="../../uploads/'.$filename.'" target="_blank" class="btn-navy" style="margin-top:10px; font-size:12px; padding:5px 10px; display:inline-block; text-decoration:none;">View File</a>
    </div>';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Documents — Athlete Portal</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link rel="stylesheet" href="../../assets/css/athlete-style.css">
<style>
    .docs-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px; margin-top: 20px; }
    .doc-card { background: white; border: 1px solid var(--clr-border); border-radius: 12px; padding: 20px; text-align: center; }
    .doc-card i { font-size: 2rem; color: var(--clr-slate); margin-bottom: 10px; display: block; }
    .doc-card h4 { margin: 0 0 5px 0; color: var(--clr-graphite); font-size: 1rem; }
    .doc-card p { margin: 0; color: var(--clr-slate); font-size: 0.8rem; }
    .doc-card.empty { background: #f8fafc; border-style: dashed; }
    .badge { padding: 4px 10px; border-radius: 6px; font-size: 0.8rem; font-weight: 500; display: inline-block; margin-left: 15px; }
    .badge.paid { background: #dcfce7; color: #166534; }
    .badge.unpaid { background: #fee2e2; color: #991b1b; }
    .badge.pending { background: #fef9c3; color: #854d0e; }
    .status-panel { background: white; border-radius: 12px; padding: 20px; display: flex; align-items: center; border: 1px solid var(--clr-border); margin-bottom: 30px; }
</style>
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
      <a href="view-profile.php" class="topbar-link">Profile</a>
      <a href="invoices.php" class="topbar-link">Invoices</a>
      <a href="documents.php" class="topbar-link active">Documents</a>
      <a href="tournaments.php" class="topbar-link">Tournaments</a>
      <a href="../auth/logout.php" class="topbar-link">Log Out</a>
    </nav>
  </header>

  <main class="db-content">

    <div class="page-heading">
      <div>
        <p class="eyebrow">Verification Center</p>
        <h1 class="form-title" style="margin:0;">My Documents</h1>
      </div>
    </div>

    <div class="status-panel anim-fade-up">
        <div>
            <h3 style="margin:0 0 5px 0; color:var(--clr-graphite);">Document Verification Status</h3>
            <p style="margin:0; color:var(--clr-slate); font-size:0.9rem;">Your uploaded documents are reviewed by the administration for approval.</p>
        </div>
        <span class="badge <?php echo $badgeClass; ?>"><?php echo htmlspecialchars($statusRaw); ?></span>
    </div>

    <?php if($doc): ?>
    <div class="docs-grid">
        <?php echo renderDocCard('Aadhaar Card', $doc['aadhaar_file']); ?>
        <?php echo renderDocCard('Birth Certificate', $doc['birth_certificate']); ?>
        <?php echo renderDocCard('Passport Photo', $doc['passport_photo']); ?>
        <?php echo renderDocCard('Medical Cert.', $doc['medical_certificate']); ?>
        <?php echo renderDocCard('Parent Consent', $doc['parent_consent_file']); ?>
        <?php echo renderDocCard('Club Cert.', $doc['club_certificate_file']); ?>
        <?php echo renderDocCard('Achievements', $doc['achievement_certificate_file']); ?>
        <?php echo renderDocCard('Photo ID', $doc['photo_id_proof']); ?>
    </div>
    <?php else: ?>
        <div class="doc-card empty" style="padding: 40px;">
            <i class="bi bi-folder-x"></i>
            <p>No document records found for your account.</p>
        </div>
    <?php endif; ?>

  </main>

</div>

</body>
</html>
