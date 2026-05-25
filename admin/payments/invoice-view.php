<?php
$activePage = 'payments';
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

// Handle payment status update
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_status'])) {
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $update = mysqli_query($conn, "UPDATE invoices SET status = '$status' WHERE invoice_id = $id");
    if($update) {
        $message = "<div class='alert alert-success'>Invoice status updated successfully.</div>";
        if($status === 'Paid') {
            // Mock adding a transaction record if not exists
            mysqli_query($conn, "INSERT INTO payments (invoice_id, amount_paid, payment_method, payment_status) VALUES ($id, (SELECT amount FROM invoices WHERE invoice_id=$id), 'Cash/Offline', 'Success')");
        }
    }
}

// Fetch invoice details
$query = mysqli_query(
    $conn,
    "SELECT i.*, a.full_name, a.mobile, a.email, a.registration_no 
     FROM invoices i 
     LEFT JOIN athletes a ON i.athlete_id = a.athlete_id 
     WHERE i.invoice_id = $id"
);
$inv = mysqli_fetch_assoc($query);

if(!$inv) {
    die("Invoice not found.");
}

$statusRaw = $inv['status'] ?? 'Unpaid';
$statusLower = strtolower($statusRaw);
$badgeClass = 'status-badge--pending';
if($statusLower === 'paid') $badgeClass = 'status-badge--approved';
if($statusLower === 'failed') $badgeClass = 'status-badge--rejected';

// Fetch associated payments
$paymentsQ = mysqli_query($conn, "SELECT * FROM payments WHERE invoice_id = $id ORDER BY payment_id DESC");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Invoice — Sports Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin-style.css">
    <style>
        .page-actions { margin-left: auto; display: flex; gap: 10px; }
        .btn-primary { background: var(--primary-color, #000052); color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; font-weight: 500; }
        .btn-success { background: #16a34a; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; font-weight: 500; }
        .card { background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); margin-bottom: 20px; }
        .card-title { font-size: 18px; font-weight: 600; color: #1e293b; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid #e2e8f0; }
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 20px; }
        .info-item label { display: block; color: #64748b; font-size: 13px; margin-bottom: 5px; }
        .info-item div { font-weight: 500; color: #0f172a; }
        .alert { padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .alert-success { background: #dcfce7; color: #166534; }
        .invoice-box { padding: 30px; border: 1px solid #e2e8f0; border-radius: 8px; background: #fff; margin-bottom: 20px; }
        .invoice-header { display: flex; justify-content: space-between; border-bottom: 2px solid #e2e8f0; padding-bottom: 20px; margin-bottom: 20px; }
        .invoice-title { font-size: 24px; color: #000052; font-weight: bold; }
        .invoice-details { text-align: right; }
        .amount-display { font-size: 32px; font-weight: bold; color: #0f172a; margin: 20px 0; }
        .table-simple { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table-simple th, .table-simple td { padding: 12px; text-align: left; border-bottom: 1px solid #e2e8f0; }
        .table-simple th { background: #f8fafc; color: #475569; font-weight: 600; }
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
            <h1>Invoice #INV-<?php echo str_pad($inv['invoice_id'], 5, '0', STR_PAD_LEFT); ?></h1>
            <p>Manage payment status and view transaction history</p>
        </div>
        <div class="page-actions">
            <button onclick="window.print()" class="btn-primary" style="background: #475569;">
                <i class="bi bi-printer"></i> Print Invoice
            </button>
            <a href="generate_pdf.php?id=<?php echo $inv['invoice_id']; ?>" class="btn-primary">
                <i class="bi bi-file-pdf"></i> Download PDF
            </a>
        </div>
    </div>

    <?php if($message) echo $message; ?>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
        
        <!-- Left Column: Invoice Document -->
        <div class="invoice-box" id="printableInvoice">
            <div class="invoice-header">
                <div>
                    <div class="invoice-title">SPORTS CLUB INVOICE</div>
                    <div style="margin-top: 10px; color: #475569;">
                        123 Sports Avenue, City<br>
                        contact@sportsclub.com<br>
                        +91 9000000000
                    </div>
                </div>
                <div class="invoice-details">
                    <div style="font-weight: bold; margin-bottom: 5px;">Invoice No: INV-<?php echo str_pad($inv['invoice_id'], 5, '0', STR_PAD_LEFT); ?></div>
                    <div>Date: <?php echo date('d M Y', strtotime($inv['created_at'])); ?></div>
                    <div style="margin-top: 10px;">
                        <span class="status-badge <?php echo $badgeClass; ?>"><?php echo $statusRaw; ?></span>
                    </div>
                </div>
            </div>

            <div class="info-grid">
                <div>
                    <div style="color: #64748b; font-weight: bold; margin-bottom: 10px;">BILL TO:</div>
                    <div style="font-weight: bold; font-size: 16px;"><?php echo htmlspecialchars($inv['full_name'] ?? 'Unknown'); ?></div>
                    <div>Reg No: <?php echo htmlspecialchars($inv['registration_no'] ?? 'N/A'); ?></div>
                    <div>Mobile: <?php echo htmlspecialchars($inv['mobile'] ?? 'N/A'); ?></div>
                    <div>Email: <?php echo htmlspecialchars($inv['email'] ?? 'N/A'); ?></div>
                </div>
            </div>

            <table class="table-simple" style="margin-top: 30px;">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th style="text-align: right;">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Registration & Event Fee</td>
                        <td style="text-align: right; font-weight: bold;">₹<?php echo number_format($inv['amount'], 2); ?></td>
                    </tr>
                </tbody>
            </table>

            <div style="text-align: right; border-top: 2px solid #e2e8f0; margin-top: 20px; padding-top: 20px;">
                <div style="color: #64748b; font-weight: bold;">TOTAL DUE</div>
                <div class="amount-display">₹<?php echo number_format($inv['amount'], 2); ?></div>
            </div>
        </div>

        <!-- Right Column: Actions & Transactions -->
        <div>
            <div class="card">
                <h2 class="card-title">Update Status</h2>
                <form method="POST">
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px; color: #475569; font-weight: 500;">Payment Status</label>
                        <select name="status" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                            <option value="Paid" <?php if($statusRaw=='Paid') echo 'selected'; ?>>Paid</option>
                            <option value="Unpaid" <?php if($statusRaw=='Unpaid') echo 'selected'; ?>>Unpaid</option>
                            <option value="Pending" <?php if($statusRaw=='Pending') echo 'selected'; ?>>Pending</option>
                            <option value="Failed" <?php if($statusRaw=='Failed') echo 'selected'; ?>>Failed</option>
                        </select>
                    </div>
                    <button type="submit" name="update_status" class="btn-success" style="width: 100%;">
                        <i class="bi bi-arrow-repeat"></i> Update Status
                    </button>
                </form>
            </div>

            <div class="card">
                <h2 class="card-title">Transaction History</h2>
                <?php if(mysqli_num_rows($paymentsQ) > 0): ?>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <?php while($txn = mysqli_fetch_assoc($paymentsQ)): ?>
                        <li style="border-bottom: 1px solid #e2e8f0; padding-bottom: 10px; margin-bottom: 10px;">
                            <div style="display: flex; justify-content: space-between; font-weight: 500;">
                                <span>₹<?php echo number_format($txn['amount_paid'], 2); ?></span>
                                <span style="color: #16a34a;"><?php echo htmlspecialchars($txn['payment_status']); ?></span>
                            </div>
                            <div style="color: #64748b; font-size: 12px; margin-top: 5px;">
                                <?php echo htmlspecialchars($txn['payment_method']); ?> • <?php echo date('d M Y, h:i A', strtotime($txn['payment_date'])); ?>
                            </div>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else: ?>
                    <div style="color: #64748b; font-size: 14px;">No transactions recorded yet.</div>
                <?php endif; ?>
            </div>
        </div>
        
    </div>

</div>
</div>

<script src="../assets/js/admin-script.js"></script>
</body>
</html>
