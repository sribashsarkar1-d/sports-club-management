<?php
require '../../config/session.php';
require '../../config/database.php';
require '../../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

if(!isset($_SESSION['admin_id'])){
    header("Location: ../auth/login.php");
    exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if(!$id) die("Invalid Athlete ID");

$query = mysqli_query($conn, "SELECT * FROM athletes WHERE athlete_id = '$id'");
$athlete = mysqli_fetch_assoc($query);

if(!$athlete) die("Athlete not found.");

// Create a unique ID if not exists (in a real app, we'd query athlete_cards table)
$unique_id = "SCM-" . date('Y') . "-" . str_pad($id, 5, '0', STR_PAD_LEFT);
$qr_data = urlencode(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http" . "://" . $_SERVER['HTTP_HOST'] . "/athlete-verify.php?uid=" . $unique_id);
$qr_url = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . $qr_data;

// Prepare HTML for PDF
$html = '
<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: "Helvetica", sans-serif; }
        .id-card { 
            width: 300px; 
            height: 450px; 
            border: 2px solid #000052; 
            border-radius: 10px; 
            margin: 0 auto;
            text-align: center;
            background: #f8fafc;
        }
        .header {
            background: #000052;
            color: white;
            padding: 15px;
            border-radius: 8px 8px 0 0;
            font-size: 18px;
            font-weight: bold;
        }
        .photo-placeholder {
            width: 100px;
            height: 100px;
            background: #e2e8f0;
            border-radius: 50%;
            margin: 20px auto;
            border: 3px solid #000052;
        }
        .details { padding: 0 20px; text-align: left; margin-bottom: 20px; }
        .details p { margin: 5px 0; font-size: 14px; }
        .qr-code { text-align: center; margin-top: 10px; }
        .qr-code img { width: 80px; height: 80px; }
    </style>
</head>
<body>
    <div class="id-card">
        <div class="header">SPORTS CLUB MANAGER</div>
        <div class="photo-placeholder"></div>
        <h3 style="margin: 10px 0; color: #000052;">' . htmlspecialchars($athlete['full_name']) . '</h3>
        <div class="details">
            <p><strong>ID Number:</strong> ' . $unique_id . '</p>
            <p><strong>DOB:</strong> ' . ($athlete['dob'] ? date('d M Y', strtotime($athlete['dob'])) : 'N/A') . '</p>
            <p><strong>Blood Group:</strong> O+</p>
        </div>
        <div class="qr-code">
            <img src="' . $qr_url . '" alt="QR Code">
        </div>
    </div>
</body>
</html>
';

// Setup Dompdf
$options = new Options();
$options->set('isRemoteEnabled', true); // To allow external QR image
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("Athlete_ID_" . $unique_id . ".pdf", ["Attachment" => false]);
?>
