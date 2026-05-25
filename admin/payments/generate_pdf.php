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
if(!$id) die("Invalid Invoice ID");

$query = mysqli_query(
    $conn,
    "SELECT i.*, a.full_name, a.mobile, a.email, a.registration_no 
     FROM invoices i 
     LEFT JOIN athletes a ON i.athlete_id = a.athlete_id 
     WHERE i.invoice_id = $id"
);
$inv = mysqli_fetch_assoc($query);

if(!$inv) die("Invoice not found.");

$statusColor = '#475569';
if($inv['status'] === 'Paid') $statusColor = '#16a34a';
if($inv['status'] === 'Failed') $statusColor = '#dc2626';

$html = '
<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: "Helvetica", sans-serif; color: #1e293b; }
        .invoice-box { max-width: 800px; margin: auto; padding: 30px; border: 1px solid #eee; box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); font-size: 16px; line-height: 24px; }
        .header { display: table; width: 100%; border-bottom: 2px solid #000052; padding-bottom: 20px; margin-bottom: 20px; }
        .header-left { display: table-cell; vertical-align: top; }
        .header-right { display: table-cell; text-align: right; vertical-align: top; }
        .title { color: #000052; font-size: 32px; font-weight: bold; margin: 0; }
        .details-table { width: 100%; margin-bottom: 40px; }
        .details-table td { padding: 5px; vertical-align: top; }
        .items-table { width: 100%; line-height: inherit; text-align: left; border-collapse: collapse; }
        .items-table th { background: #000052; color: white; padding: 10px; }
        .items-table td { padding: 10px; border-bottom: 1px solid #eee; }
        .total-row td { font-weight: bold; border-top: 2px solid #000052; }
        .badge { padding: 5px 10px; color: white; border-radius: 5px; font-size: 14px; background: ' . $statusColor . ';}
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="header">
            <div class="header-left">
                <h1 class="title">INVOICE</h1>
                <p>Sports Club Management<br>123 Sports Avenue, City<br>contact@sportsclub.com</p>
            </div>
            <div class="header-right">
                <p><strong>Invoice No:</strong> INV-' . str_pad($inv['invoice_id'], 5, '0', STR_PAD_LEFT) . '<br>
                <strong>Date:</strong> ' . date('d M Y', strtotime($inv['created_at'])) . '<br><br>
                <span class="badge">' . $inv['status'] . '</span></p>
            </div>
        </div>

        <table class="details-table">
            <tr>
                <td>
                    <strong>Bill To:</strong><br>
                    ' . htmlspecialchars($inv['full_name'] ?? 'Unknown') . '<br>
                    Reg No: ' . htmlspecialchars($inv['registration_no'] ?? 'N/A') . '<br>
                    Mobile: ' . htmlspecialchars($inv['mobile'] ?? 'N/A') . '
                </td>
            </tr>
        </table>

        <table class="items-table">
            <tr>
                <th>Description</th>
                <th style="text-align: right;">Amount</th>
            </tr>
            <tr>
                <td>Registration & Event Fee</td>
                <td style="text-align: right;">Rs. ' . number_format($inv['amount'], 2) . '</td>
            </tr>
            <tr class="total-row">
                <td style="text-align: right;">Total Due:</td>
                <td style="text-align: right;">Rs. ' . number_format($inv['amount'], 2) . '</td>
            </tr>
        </table>
        
        <p style="text-align: center; margin-top: 50px; font-size: 12px; color: #64748b;">
            This is a computer-generated document. No signature is required.
        </p>
    </div>
</body>
</html>
';

$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

$dompdf->stream("Invoice_INV-" . str_pad($inv['invoice_id'], 5, '0', STR_PAD_LEFT) . ".pdf", ["Attachment" => true]);
?>
