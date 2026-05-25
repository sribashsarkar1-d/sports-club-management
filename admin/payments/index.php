<?php
$activePage = 'payments';
include '../../config/session.php';
include '../../config/database.php';

if(!isset($_SESSION['admin_id'])){
    header("Location: ../auth/login.php");
    exit;
}

$query = mysqli_query(
    $conn,
    "SELECT i.invoice_id, i.amount, i.status, i.created_at, a.full_name as athlete_name 
     FROM invoices i 
     LEFT JOIN athletes a ON i.athlete_id = a.athlete_id 
     ORDER BY i.invoice_id DESC"
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments — Sports Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin-style.css">
    <style>
        .page-actions { margin-left: auto; display: flex; gap: 10px; }
        .btn-primary { background: var(--primary-color, #000052); color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; font-weight: 500; }
    </style>
</head>

<body>
<?php include '../layouts/sidebar.php'; ?>
<?php include '../layouts/navbar.php'; ?>

<div class="main-content">
<div class="page-body">

    <div class="dash-header">
        <div class="dash-header-left">
            <h1>Payments & Invoices</h1>
            <p>Track registration fees and online payments</p>
        </div>
        <div class="page-actions">
            <a href="create_invoice.php" class="btn-primary" style="background: #008060;">
                <i class="bi bi-plus-circle"></i> Create Invoice
            </a>
        </div>
    </div>

    <div class="table-card">
        <div class="table-card-header">
            <span class="table-card-title">
                <i class="bi bi-receipt"></i> Recent Invoices
            </span>
        </div>

        <div class="athletes-table-wrap">
            <table class="athletes-table" id="dataTable">
                <thead>
                    <tr>
                        <th>Invoice ID</th>
                        <th>Athlete</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(mysqli_num_rows($query) > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($query)): 
                        $statusRaw = $row['status'] ?? 'Unpaid';
                        $statusLower = strtolower($statusRaw);
                        $badgeClass = 'status-badge--pending';
                        if($statusLower === 'paid') $badgeClass = 'status-badge--approved';
                        if($statusLower === 'failed') $badgeClass = 'status-badge--rejected';
                    ?>
                    <tr class="athlete-row">
                        <td>INV-<?php echo str_pad($row['invoice_id'], 5, '0', STR_PAD_LEFT); ?></td>
                        <td><strong><?php echo htmlspecialchars($row['athlete_name'] ?? 'Unknown'); ?></strong></td>
                        <td>$<?php echo number_format($row['amount'], 2); ?></td>
                        <td><?php echo date('d M Y, h:i A', strtotime($row['created_at'])); ?></td>
                        <td><span class="status-badge <?php echo $badgeClass; ?>"><?php echo $statusRaw; ?></span></td>
                        <td>
                            <a href="invoice-view.php?id=<?php echo $row['invoice_id']; ?>" class="btn-view">
                                <i class="bi bi-file-pdf"></i> View
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 30px;">No invoices found.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
</div>

<script src="../assets/js/admin-script.js"></script>
</body>
</html>
