<?php
$activePage = 'payments';
include '../../config/session.php';
include '../../config/database.php';

if(!isset($_SESSION['admin_id'])){
    header("Location: ../auth/login.php");
    exit;
}

$message = "";

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create_invoice'])) {
    $athlete_id = intval($_POST['athlete_id']);
    $amount = floatval($_POST['amount']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    
    if($athlete_id > 0 && $amount > 0) {
        $insert = mysqli_query($conn, "INSERT INTO invoices (athlete_id, amount, status) VALUES ('$athlete_id', '$amount', '$status')");
        if($insert) {
            $message = "<div class='alert alert-success'>Invoice created successfully.</div>";
        } else {
            $message = "<div class='alert alert-danger'>Failed to create invoice. Make sure the invoices table exists.</div>";
        }
    } else {
        $message = "<div class='alert alert-danger'>Invalid input.</div>";
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
    <title>Create Invoice — Sports Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin-style.css">
    <style>
        .card { background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); max-width: 600px; margin: 0 auto; }
        .card-title { font-size: 18px; font-weight: 600; color: #1e293b; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid #e2e8f0; }
        .form-group { margin-bottom: 15px; }
        .form-label { display: block; margin-bottom: 5px; font-weight: 500; color: #475569; }
        .form-control { width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; }
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
                <i class="bi bi-arrow-left"></i> Back to Payments
            </a>
            <h1>Create Invoice</h1>
            <p>Generate a new invoice for an athlete</p>
        </div>
    </div>

    <?php if($message) echo $message; ?>

    <div class="card">
        <h2 class="card-title">Invoice Details</h2>
        <form method="POST">
            <div class="form-group">
                <label class="form-label">Select Athlete</label>
                <select name="athlete_id" class="form-control" required>
                    <option value="">-- Select Athlete --</option>
                    <?php while($ath = mysqli_fetch_assoc($athletesQ)): ?>
                        <option value="<?php echo $ath['athlete_id']; ?>">
                            <?php echo htmlspecialchars($ath['full_name']) . ' (' . htmlspecialchars($ath['mobile']) . ')'; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label">Amount (₹)</label>
                <input type="number" step="0.01" name="amount" class="form-control" placeholder="e.g. 500.00" required>
            </div>

            <div class="form-group">
                <label class="form-label">Description / Fee Type</label>
                <input type="text" name="description" class="form-control" placeholder="e.g. Registration Fee" required>
            </div>

            <div class="form-group">
                <label class="form-label">Initial Status</label>
                <select name="status" class="form-control" required>
                    <option value="Unpaid">Unpaid</option>
                    <option value="Paid">Paid</option>
                    <option value="Pending">Pending</option>
                </select>
            </div>

            <button type="submit" name="create_invoice" class="btn-primary">Generate Invoice</button>
        </form>
    </div>

</div>
</div>

<script src="../assets/js/admin-script.js"></script>
</body>
</html>
