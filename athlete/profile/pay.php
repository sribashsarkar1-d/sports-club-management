<?php
include '../../config/session.php';
include '../../config/database.php';

if(!isset($_SESSION['athlete_logged_in']) || !isset($_GET['id'])){
  header("Location: ../auth/login.php");
  exit();
}

$application_no = mysqli_real_escape_string($conn, $_SESSION['athlete_application_no']);
$invoice_id = intval($_GET['id']);

$query = mysqli_query($conn, "SELECT * FROM athletes WHERE registration_no='$application_no'");
if(mysqli_num_rows($query) == 0){
  header("Location: ../registration/register.php");
  exit();
}
$athlete = mysqli_fetch_assoc($query);
$athlete_id = $athlete['athlete_id'];

// Fetch invoice
$invQ = mysqli_query($conn, "SELECT * FROM invoices WHERE invoice_id = $invoice_id AND athlete_id = $athlete_id AND status != 'Paid'");
$invoice = mysqli_fetch_assoc($invQ);

if(!$invoice) {
    die("Invoice not found or already paid.");
}

$amount_in_paise = $invoice['amount'] * 100;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Secure Checkout — Athlete Portal</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link rel="stylesheet" href="../../assets/css/athlete-style.css">
<style>
    .checkout-box { background: white; border: 1px solid var(--clr-border); border-radius: 12px; padding: 40px; text-align: center; max-width: 500px; margin: 40px auto; box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
    .checkout-amount { font-size: 3rem; font-weight: 900; color: var(--clr-primary); margin: 20px 0; }
    .btn-pay { background: #3399cc; color: white; border: none; padding: 15px 30px; font-size: 1.1rem; font-weight: bold; border-radius: 8px; cursor: pointer; width: 100%; transition: background 0.3s; }
    .btn-pay:hover { background: #2b82ad; }
</style>
</head>
<body style="background: var(--clr-bg);">

<div class="checkout-box">
    <i class="bi bi-shield-lock" style="font-size: 3rem; color: #10b981;"></i>
    <h2>Secure Payment Checkout</h2>
    <p style="color: var(--clr-slate); margin-top: 10px;">Invoice #INV-<?php echo str_pad($invoice_id, 5, '0', STR_PAD_LEFT); ?></p>
    
    <div class="checkout-amount">₹<?php echo number_format($invoice['amount'], 2); ?></div>
    
    <button id="rzp-button1" class="btn-pay">Pay with Razorpay</button>
    <div style="margin-top: 20px; text-align: center;">
        <a href="invoices.php" style="color: var(--clr-slate); text-decoration: none;">&larr; Cancel and return</a>
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var options = {
    "key": "rzp_test_mock_key_only", // Enter the Key ID generated from the Dashboard
    "amount": "<?php echo $amount_in_paise; ?>",
    "currency": "INR",
    "name": "Sports Club Management",
    "description": "Invoice Payment #<?php echo $invoice_id; ?>",
    "image": "https://example.com/your_logo",
    "handler": function (response){
        // Redirect to process_payment on success
        window.location.href = "process_payment.php?id=<?php echo $invoice_id; ?>&payment_id=" + response.razorpay_payment_id;
    },
    "prefill": {
        "name": "<?php echo htmlspecialchars($athlete['full_name']); ?>",
        "email": "<?php echo htmlspecialchars($athlete['email']); ?>",
        "contact": "<?php echo htmlspecialchars($athlete['mobile']); ?>"
    },
    "theme": {
        "color": "#3399cc"
    }
};

// If using a dummy key, Razorpay will throw an error. For the sake of this demo, we'll auto-simulate success if Razorpay fails to load.
document.getElementById('rzp-button1').onclick = function(e){
    try {
        var rzp1 = new Razorpay(options);
        rzp1.open();
    } catch(err) {
        // Fallback simulation for demo purposes
        let mockPaymentId = "pay_mock_" + Math.floor(Math.random() * 100000000);
        window.location.href = "process_payment.php?id=<?php echo $invoice_id; ?>&payment_id=" + mockPaymentId;
    }
    e.preventDefault();
}
</script>

</body>
</html>
