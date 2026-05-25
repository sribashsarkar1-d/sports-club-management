<?php
include '../../config/session.php';
include '../../config/database.php';

if(!isset($_SESSION['athlete_logged_in']) || !isset($_GET['id']) || !isset($_GET['payment_id'])){
  header("Location: ../auth/login.php");
  exit();
}

$application_no = mysqli_real_escape_string($conn, $_SESSION['athlete_application_no']);
$invoice_id = intval($_GET['id']);
$payment_id = mysqli_real_escape_string($conn, $_GET['payment_id']);

$query = mysqli_query($conn, "SELECT * FROM athletes WHERE registration_no='$application_no'");
$athlete = mysqli_fetch_assoc($query);
$athlete_id = $athlete['athlete_id'];

// Check invoice
$invQ = mysqli_query($conn, "SELECT * FROM invoices WHERE invoice_id = $invoice_id AND athlete_id = $athlete_id");
$invoice = mysqli_fetch_assoc($invQ);

if($invoice && $invoice['status'] != 'Paid') {
    // 1. Update Invoice Status
    mysqli_query($conn, "UPDATE invoices SET status = 'Paid' WHERE invoice_id = $invoice_id");
    
    // 2. Insert into Payments Table
    $amount = $invoice['amount'];
    mysqli_query($conn, "INSERT INTO payments (invoice_id, athlete_id, amount_paid, payment_method, transaction_id, payment_status) VALUES ($invoice_id, $athlete_id, $amount, 'Razorpay (Online)', '$payment_id', 'Completed')");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Payment Success</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<style>
    body { font-family: 'Inter', sans-serif; background: #f8fafc; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; }
    .success-box { background: white; border-radius: 16px; padding: 50px; text-align: center; box-shadow: 0 10px 25px rgba(0,0,0,0.05); max-width: 400px; }
    .icon { width: 80px; height: 80px; background: #dcfce7; color: #166534; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 40px; margin: 0 auto 20px; }
    h2 { color: #0f172a; margin-bottom: 10px; }
    p { color: #64748b; margin-bottom: 30px; }
    a { display: inline-block; background: #000052; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: bold; }
</style>
</head>
<body>

<div class="success-box">
    <div class="icon"><i class="bi bi-check-lg"></i></div>
    <h2>Payment Successful</h2>
    <p>Your payment for Invoice #INV-<?php echo str_pad($invoice_id, 5, '0', STR_PAD_LEFT); ?> has been successfully processed.</p>
    <a href="invoices.php">Back to Invoices</a>
</div>

</body>
</html>
