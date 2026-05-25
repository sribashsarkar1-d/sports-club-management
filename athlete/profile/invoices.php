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

// Fetch Invoices
$invoicesQ = mysqli_query($conn, "SELECT * FROM invoices WHERE athlete_id = $athlete_id ORDER BY invoice_id DESC");

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Invoices — Athlete Portal</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link rel="stylesheet" href="../../assets/css/athlete-style.css">
<style>
    .invoice-card { background: white; border: 1px solid var(--clr-border); border-radius: 12px; padding: 20px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
    .invoice-info h3 { margin: 0 0 5px 0; color: var(--clr-graphite); font-size: 1.1rem; }
    .invoice-info p { margin: 0; color: var(--clr-slate); font-size: 0.9rem; }
    .invoice-amount { font-size: 1.5rem; font-weight: bold; color: var(--clr-graphite); }
    .badge { padding: 4px 10px; border-radius: 6px; font-size: 0.8rem; font-weight: 500; display: inline-block; margin-top: 10px; }
    .badge.paid { background: #dcfce7; color: #166534; }
    .badge.unpaid { background: #fee2e2; color: #991b1b; }
    .badge.pending { background: #fef9c3; color: #854d0e; }
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
      <a href="invoices.php" class="topbar-link active">Invoices</a>
      <a href="documents.php" class="topbar-link">Documents</a>
      <a href="tournaments.php" class="topbar-link">Tournaments</a>
      <a href="../auth/logout.php" class="topbar-link">Log Out</a>
    </nav>
  </header>

  <main class="db-content">

    <div class="page-heading">
      <div>
        <p class="eyebrow">Billing & Payments</p>
        <h1 class="form-title" style="margin:0;">My Invoices</h1>
      </div>
    </div>

    <div style="max-width: 800px;">
        <?php if(mysqli_num_rows($invoicesQ) > 0): ?>
            <?php while($inv = mysqli_fetch_assoc($invoicesQ)): 
                $statusLower = strtolower($inv['status']);
                $badgeClass = 'pending';
                if($statusLower == 'paid') $badgeClass = 'paid';
                if($statusLower == 'unpaid' || $statusLower == 'failed') $badgeClass = 'unpaid';
            ?>
                <div class="invoice-card anim-fade-up">
                    <div class="invoice-info">
                        <h3>Registration & Event Fee</h3>
                        <p>Invoice #INV-<?php echo str_pad($inv['invoice_id'], 5, '0', STR_PAD_LEFT); ?> &middot; <?php echo date('d M Y', strtotime($inv['created_at'])); ?></p>
                        <span class="badge <?php echo $badgeClass; ?>"><?php echo htmlspecialchars($inv['status']); ?></span>
                    </div>
                    <div style="text-align: right;">
                        <div class="invoice-amount">₹<?php echo number_format($inv['amount'], 2); ?></div>
                        <?php if($statusLower != 'paid'): ?>
                            <a href="pay.php?id=<?php echo $inv['invoice_id']; ?>" class="btn-navy" style="margin-top: 10px; padding: 8px 16px; font-size: 0.9rem; display:inline-block; text-decoration:none;">
                                Pay Now
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="invoice-card" style="justify-content: center; padding: 40px; text-align: center;">
                <div style="color: var(--clr-slate);">
                    <i class="bi bi-receipt" style="font-size: 3rem; margin-bottom: 15px; display: block;"></i>
                    <p>No invoices found on your account.</p>
                </div>
            </div>
        <?php endif; ?>
    </div>

  </main>

</div>

</body>
</html>
