<?php
$activePage = 'documents';
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

// Handle status update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    $new_status = ($action === 'verify') ? 'Verified' : 'Rejected';
    
    $updateQ = mysqli_query($conn, "UPDATE documents SET upload_status = '$new_status' WHERE document_id = $id");
    if($updateQ) {
        $message = "<div class='alert alert-success'>Document status updated to $new_status successfully.</div>";
    } else {
        $message = "<div class='alert alert-danger'>Failed to update document status.</div>";
    }
}

// Fetch document details
$query = mysqli_query(
    $conn,
    "SELECT d.*, a.full_name, a.registration_no, a.mobile, a.email 
     FROM documents d 
     LEFT JOIN athletes a ON d.athlete_id = a.athlete_id 
     WHERE d.document_id = $id"
);

$doc = mysqli_fetch_assoc($query);

if(!$doc) {
    die("Document record not found.");
}

$statusLower = strtolower($doc['upload_status'] ?? 'pending');
$badgeClass = 'status-badge--pending';
if($statusLower === 'verified') $badgeClass = 'status-badge--approved';
if($statusLower === 'rejected') $badgeClass = 'status-badge--rejected';

// Helper function to render document link
function renderDocLink($label, $filename) {
    if(empty($filename)) return "<p><strong>$label:</strong> <span style='color: #64748b;'>Not Uploaded</span></p>";
    
    // Attempt multiple probable paths
    $path = "../../uploads/" . $filename;
    
    return "<p><strong>$label:</strong> <a href='$path' target='_blank' style='color: #2563eb; text-decoration: underline;'><i class='bi bi-box-arrow-up-right'></i> View Document</a></p>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Documents — Sports Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin-style.css">
    <style>
        .page-actions { margin-left: auto; display: flex; gap: 10px; }
        .btn-primary { background: var(--primary-color, #000052); color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; font-weight: 500; }
        .btn-success { background: #16a34a; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; font-weight: 500; }
        .btn-danger { background: #dc2626; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; font-weight: 500; }
        .card { background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); margin-bottom: 20px; }
        .card-title { font-size: 18px; font-weight: 600; color: #1e293b; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid #e2e8f0; }
        .doc-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; }
        .doc-item { background: #f8fafc; padding: 15px; border-radius: 8px; border: 1px solid #e2e8f0; }
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 20px; }
        .info-item label { display: block; color: #64748b; font-size: 13px; margin-bottom: 5px; }
        .info-item div { font-weight: 500; color: #0f172a; }
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
                <i class="bi bi-arrow-left"></i> Back to Documents
            </a>
            <h1>Verify Documents</h1>
            <p>Review athlete documents and update verification status</p>
        </div>
    </div>

    <?php if($message) echo $message; ?>

    <div class="info-grid">
        <div class="card">
            <h2 class="card-title">Athlete Information</h2>
            <div class="info-grid">
                <div class="info-item">
                    <label>Full Name</label>
                    <div><?php echo htmlspecialchars($doc['full_name']); ?></div>
                </div>
                <div class="info-item">
                    <label>Registration No</label>
                    <div><?php echo htmlspecialchars($doc['registration_no'] ?? 'N/A'); ?></div>
                </div>
                <div class="info-item">
                    <label>Mobile</label>
                    <div><?php echo htmlspecialchars($doc['mobile']); ?></div>
                </div>
                <div class="info-item">
                    <label>Email</label>
                    <div><?php echo htmlspecialchars($doc['email']); ?></div>
                </div>
            </div>
        </div>

        <div class="card">
            <h2 class="card-title">Verification Status</h2>
            <div style="margin-bottom: 20px;">
                <span style="font-size: 15px; color: #64748b;">Current Status: </span>
                <span class="status-badge <?php echo $badgeClass; ?>" style="font-size: 15px;"><?php echo htmlspecialchars($doc['upload_status'] ?? 'Pending'); ?></span>
            </div>
            <div style="margin-bottom: 20px;">
                <span style="font-size: 15px; color: #64748b;">Uploaded On: </span>
                <span style="font-weight: 500; color: #0f172a;"><?php echo date('d M Y, h:i A', strtotime($doc['created_at'])); ?></span>
            </div>

            <form method="POST" style="display: flex; gap: 10px; margin-top: 30px;">
                <button type="submit" name="action" value="verify" class="btn-success" <?php echo ($doc['upload_status'] == 'Verified') ? 'disabled style="opacity:0.5"' : ''; ?>>
                    <i class="bi bi-check-circle"></i> Approve Documents
                </button>
                <button type="submit" name="action" value="reject" class="btn-danger" <?php echo ($doc['upload_status'] == 'Rejected') ? 'disabled style="opacity:0.5"' : ''; ?>>
                    <i class="bi bi-x-circle"></i> Reject Documents
                </button>
            </form>
        </div>
    </div>

    <div class="card">
        <h2 class="card-title">Uploaded Documents</h2>
        <div class="doc-grid">
            <div class="doc-item">
                <?php echo renderDocLink("Aadhaar Card", $doc['aadhaar_file']); ?>
            </div>
            <div class="doc-item">
                <?php echo renderDocLink("Birth Certificate", $doc['birth_certificate']); ?>
            </div>
            <div class="doc-item">
                <?php echo renderDocLink("Passport Photo", $doc['passport_photo']); ?>
            </div>
            <div class="doc-item">
                <?php echo renderDocLink("Medical Certificate", $doc['medical_certificate']); ?>
            </div>
            <div class="doc-item">
                <?php echo renderDocLink("Parent Consent", $doc['parent_consent_file']); ?>
            </div>
            <div class="doc-item">
                <?php echo renderDocLink("Club Certificate", $doc['club_certificate_file']); ?>
            </div>
            <div class="doc-item">
                <?php echo renderDocLink("Achievement Cert.", $doc['achievement_certificate_file']); ?>
            </div>
            <div class="doc-item">
                <?php echo renderDocLink("Photo ID Proof", $doc['photo_id_proof']); ?>
            </div>
            <div class="doc-item">
                <?php echo renderDocLink("Additional Doc", $doc['additional_document']); ?>
            </div>
        </div>
    </div>

</div>
</div>

<script src="../assets/js/admin-script.js"></script>
</body>
</html>
