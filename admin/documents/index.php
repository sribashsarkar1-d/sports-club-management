<?php
$activePage = 'documents';
include '../../config/session.php';
include '../../config/database.php';

if(!isset($_SESSION['admin_id'])){
    header("Location: ../auth/login.php");
    exit;
}

$query = mysqli_query(
    $conn,
    "SELECT d.document_id, d.upload_status as status, d.created_at as uploaded_at, a.full_name as athlete_name 
     FROM documents d 
     LEFT JOIN athletes a ON d.athlete_id = a.athlete_id 
     ORDER BY d.document_id DESC"
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Verification — Sports Management</title>
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
            <h1>Document Verification</h1>
            <p>Review and verify Aadhaar and other athlete documents</p>
        </div>
    </div>

    <div class="table-card">
        <div class="table-card-header">
            <span class="table-card-title">
                <i class="bi bi-file-earmark-check"></i> Uploaded Documents
            </span>
        </div>

        <div class="athletes-table-wrap">
            <table class="athletes-table" id="dataTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Athlete</th>
                        <th>Uploaded On</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php if($query && mysqli_num_rows($query) > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($query)): 
                        $statusRaw = $row['status'] ?? 'Pending';
                        $statusLower = strtolower($statusRaw);
                        $badgeClass = 'status-badge--pending';
                        if($statusLower === 'verified') $badgeClass = 'status-badge--approved';
                        if($statusLower === 'rejected') $badgeClass = 'status-badge--rejected';
                    ?>
                    <tr class="athlete-row">
                        <td>#<?php echo $row['document_id']; ?></td>
                        <td><strong><?php echo htmlspecialchars($row['athlete_name'] ?? 'Unknown'); ?></strong></td>
                        <td><?php echo date('d M Y, h:i A', strtotime($row['uploaded_at'])); ?></td>
                        <td><span class="status-badge <?php echo $badgeClass; ?>"><?php echo $statusRaw; ?></span></td>
                        <td>
                            <a href="verify.php?id=<?php echo $row['document_id']; ?>" class="btn-view">
                                <i class="bi bi-eye"></i> Review
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 30px;">No documents pending verification.</td>
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
