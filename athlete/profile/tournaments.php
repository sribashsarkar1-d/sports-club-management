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

// Fetch Tournaments/Competitions
$compsQ = mysqli_query($conn, "SELECT * FROM competitions WHERE athlete_id = $athlete_id ORDER BY competition_id DESC");

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Tournaments — Athlete Portal</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link rel="stylesheet" href="../../assets/css/athlete-style.css">
<style>
    .comp-card { background: white; border: 1px solid var(--clr-border); border-radius: 12px; padding: 25px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); }
    .comp-header { display: flex; justify-content: space-between; border-bottom: 1px solid var(--clr-border); padding-bottom: 15px; margin-bottom: 15px; }
    .comp-title { font-size: 1.2rem; font-weight: bold; color: var(--clr-graphite); margin: 0; }
    .comp-event { color: var(--clr-primary); font-weight: 600; font-size: 0.95rem; }
    .info-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px; }
    .info-item label { display: block; font-size: 0.8rem; color: var(--clr-slate); text-transform: uppercase; margin-bottom: 5px; }
    .info-item div { font-weight: 500; color: var(--clr-graphite); }
    .badge { padding: 4px 10px; border-radius: 6px; font-size: 0.8rem; font-weight: 500; display: inline-block; background: #e0e7ff; color: #4338ca; }
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
      <a href="documents.php" class="topbar-link">Documents</a>
      <a href="tournaments.php" class="topbar-link active">Tournaments</a>
      <a href="../auth/logout.php" class="topbar-link">Log Out</a>
    </nav>
  </header>

  <main class="db-content">

    <div class="page-heading">
      <div>
        <p class="eyebrow">Competitions</p>
        <h1 class="form-title" style="margin:0;">My Tournaments</h1>
      </div>
    </div>

    <div style="max-width: 900px;">
        <?php if(mysqli_num_rows($compsQ) > 0): ?>
            <?php while($comp = mysqli_fetch_assoc($compsQ)): ?>
                <div class="comp-card anim-fade-up">
                    <div class="comp-header">
                        <div>
                            <h3 class="comp-title"><?php echo htmlspecialchars($comp['competition_name']); ?></h3>
                            <div class="comp-event"><?php echo htmlspecialchars($comp['event_name']); ?></div>
                        </div>
                        <div>
                            <span class="badge"><?php echo htmlspecialchars($comp['competition_level']); ?> Level</span>
                        </div>
                    </div>
                    <div class="info-grid">
                        <div class="info-item">
                            <label>Age Group</label>
                            <div><?php echo htmlspecialchars($comp['age_group'] ?? 'N/A'); ?></div>
                        </div>
                        <div class="info-item">
                            <label>Category</label>
                            <div><?php echo htmlspecialchars($comp['gender_category'] ?? 'N/A'); ?> - <?php echo htmlspecialchars($comp['weight_category'] ?? 'N/A'); ?></div>
                        </div>
                        <div class="info-item">
                            <label>Participation Year</label>
                            <div><?php echo htmlspecialchars($comp['participation_year'] ?? 'N/A'); ?></div>
                        </div>
                        <div class="info-item">
                            <label>Registered On</label>
                            <div><?php echo date('d M Y', strtotime($comp['created_at'])); ?></div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="comp-card" style="text-align: center; padding: 40px;">
                <div style="color: var(--clr-slate);">
                    <i class="bi bi-trophy" style="font-size: 3rem; margin-bottom: 15px; display: block;"></i>
                    <p>You have not registered for any tournaments yet.</p>
                </div>
            </div>
        <?php endif; ?>
    </div>

  </main>

</div>

</body>
</html>
