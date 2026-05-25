<?php

ob_start();

include '../config/database.php';
require '../vendor/autoload.php';

use Dompdf\Dompdf;

/* Check Application Number */
if(!isset($_GET['application_no'])){
    die("Invalid Request");
}

$application_no = mysqli_real_escape_string($conn, $_GET['application_no']);

/* Get Athlete */
$athleteQuery = mysqli_query($conn, "SELECT * FROM athletes WHERE registration_no='$application_no' LIMIT 1");
if(mysqli_num_rows($athleteQuery) == 0){
    die("Application Not Found");
}
$athlete = mysqli_fetch_assoc($athleteQuery);
$athlete_id = $athlete['athlete_id'] ?? $athlete['id'];

/* Verify Payment Status (Only Paid athletes get ID card) */
$invoiceQ = mysqli_query($conn, "SELECT status FROM invoices WHERE athlete_id='$athlete_id' ORDER BY invoice_id DESC LIMIT 1");
$isPaid = false;
if ($invoiceQ && mysqli_num_rows($invoiceQ) > 0) {
    $inv = mysqli_fetch_assoc($invoiceQ);
    if (strtolower($inv['status']) === 'paid') {
        $isPaid = true;
    }
}
if (!$isPaid) {
    die("Payment pending. ID Card cannot be generated.");
}

/* Get Competition */
$compQ = mysqli_query($conn, "SELECT competition_name FROM competitions WHERE athlete_id='$athlete_id' LIMIT 1");
$competition = mysqli_fetch_assoc($compQ);
$sport = $competition['competition_name'] ?? 'General';

/* Profile Photo */
$photoPath = '../assets/uploads/photos/' . ($athlete['profile_photo'] ?? '');
if (!empty($athlete['profile_photo']) && file_exists($photoPath)) {
    // Read image and convert to base64 so dompdf embeds it directly
    $type = pathinfo($photoPath, PATHINFO_EXTENSION);
    $data = file_get_contents($photoPath);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
} else {
    // Fallback blank placeholder
    $base64 = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNTAiIGhlaWdodD0iMTUwIiB2aWV3Qm94PSIwIDAgMTUwIDE1MCI+PHJlY3Qgd2lkdGg9IjE1MCIgaGVpZ2h0PSIxNTAiIGZpbGw9IiNlMGUwZTAiLz48Y2lyY2xlIGN4PSI3NSIgY3k9IjYwIiByPSIyNSIgZmlsbD0iI2IyYjJiMiIvPjxwYXRoIGQ9Ik0zMCAxMjAgQyAzMCA5NSA1MCA4NSA3NSA4NSBDIDEwMCA4NSAxMjAgOTUgMTIwIDEyMCIgZmlsbD0iI2IyYjJiMiIvPjwvc3ZnPg==';
}

$html = '
<html>
<head>
<style>
    body {
        font-family: Helvetica, sans-serif;
        margin: 0;
        padding: 0;
        background: #ffffff;
    }
    .id-card-wrapper {
        width: 100%;
        height: 100%;
        box-sizing: border-box;
        border: 2px solid #000052;
        border-radius: 12px;
        overflow: hidden;
        position: relative;
    }
    .id-header {
        background: #000052;
        color: #ffffff;
        text-align: center;
        padding: 15px 5px;
    }
    .id-header h1 {
        margin: 0;
        font-size: 16px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .id-header p {
        margin: 2px 0 0 0;
        font-size: 10px;
        color: #0ff0fc;
    }
    .id-body {
        padding: 15px;
        text-align: center;
    }
    .photo-container {
        width: 90px;
        height: 110px;
        margin: 0 auto 15px;
        border: 2px solid #000052;
        border-radius: 8px;
        overflow: hidden;
    }
    .photo-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .athlete-name {
        font-size: 18px;
        font-weight: bold;
        color: #000052;
        margin: 0 0 5px 0;
        text-transform: uppercase;
    }
    .athlete-sport {
        font-size: 12px;
        color: #e63946;
        font-weight: bold;
        margin: 0 0 15px 0;
        text-transform: uppercase;
    }
    .info-table {
        width: 100%;
        font-size: 10px;
        text-align: left;
        border-collapse: collapse;
    }
    .info-table td {
        padding: 4px 0;
        border-bottom: 1px solid #f0f0f0;
    }
    .info-label {
        font-weight: bold;
        color: #666;
        width: 40%;
    }
    .info-value {
        color: #000;
        font-weight: bold;
    }
    .id-footer {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background: #e63946;
        color: #ffffff;
        text-align: center;
        padding: 8px 0;
        font-size: 10px;
        font-weight: bold;
        text-transform: uppercase;
    }
</style>
</head>
<body>
    <div class="id-card-wrapper">
        <div class="id-header">
            <h1>Sports Club Mgt</h1>
            <p>Official Athlete ID</p>
        </div>
        <div class="id-body">
            <div class="photo-container">
                <img src="' . $base64 . '" alt="Profile">
            </div>
            <h2 class="athlete-name">' . htmlspecialchars($athlete['full_name']) . '</h2>
            <p class="athlete-sport">' . htmlspecialchars($sport) . '</p>
            
            <table class="info-table">
                <tr>
                    <td class="info-label">Reg No:</td>
                    <td class="info-value">' . htmlspecialchars($athlete['registration_no']) . '</td>
                </tr>
                <tr>
                    <td class="info-label">DOB:</td>
                    <td class="info-value">' . htmlspecialchars($athlete['dob']) . '</td>
                </tr>
                <tr>
                    <td class="info-label">Blood Group:</td>
                    <td class="info-value">' . htmlspecialchars($athlete['blood_group'] ?? 'N/A') . '</td>
                </tr>
                <tr>
                    <td class="info-label">Valid Until:</td>
                    <td class="info-value">Dec 31, ' . date("Y") . '</td>
                </tr>
            </table>
        </div>
        <div class="id-footer">
            ATHLETE
        </div>
    </div>
</body>
</html>
';

ob_end_clean();

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->set_option('isRemoteEnabled', true);

// Typical ID card size is 2.125 x 3.375 inches (CR80)
// 1 inch = 72 pt, so 2.125 * 72 = 153 pt, 3.375 * 72 = 243 pt
$dompdf->setPaper(array(0, 0, 190, 310), 'portrait'); // Slightly larger for readability

$dompdf->render();
$dompdf->stream($application_no . "_ID_Card.pdf", array("Attachment" => true));
exit;
?>
