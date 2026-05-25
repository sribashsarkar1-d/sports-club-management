<?php
include '../../config/session.php';
include '../../config/database.php';
include '../../config/smtp.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['request_otp'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    header("Location: login.php?error=csrf_failed");
    exit;
}

$email = trim($_POST['email'] ?? '');

if (empty($email)) {
    header("Location: login.php?error=empty_email");
    exit;
}

$email = mysqli_real_escape_string($conn, $email);

// Find athlete
$query = mysqli_query($conn, "SELECT * FROM athletes WHERE email = '$email' LIMIT 1");

if (mysqli_num_rows($query) <= 0) {
    header("Location: login.php?error=not_found");
    exit;
}

$athlete = mysqli_fetch_assoc($query);

// Check athlete status
if ($athlete['athlete_status'] === 'Pending') {
    header("Location: login.php?error=pending");
    exit;
} else if ($athlete['athlete_status'] === 'Rejected') {
    header("Location: login.php?error=rejected");
    exit;
}

// Generate OTP
$otp = rand(100000, 999999);
$_SESSION['athlete_otp'] = $otp;
$_SESSION['otp_email'] = $email;
$_SESSION['otp_athlete_id'] = $athlete['athlete_id'];
$_SESSION['otp_registration_no'] = $athlete['registration_no'];
$_SESSION['otp_time'] = time();

// Send OTP Email
$subject = "Your OTP for Athlete Portal Login";
$message = '
<div style="font-family:Arial;background:#f4f7fb;padding:40px;">
    <div style="max-width:600px;margin:auto;background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 4px 6px rgba(0,0,0,0.05);">
        <div style="background:#000052;padding:30px;text-align:center;color:#fff;">
            <h2>Sports Club Management</h2>
            <p>Athlete Portal Secure Login</p>
        </div>
        <div style="padding:30px;text-align:center;">
            <p style="font-size:16px;color:#333;">Hello ' . htmlspecialchars($athlete['full_name']) . ',</p>
            <p style="font-size:15px;color:#555;">Please use the following One-Time Password to access your dashboard. This OTP is valid for 10 minutes.</p>
            <div style="font-size:36px;font-weight:bold;letter-spacing:4px;color:#0ff0fc;background:#000052;padding:15px;border-radius:8px;margin:20px 0;display:inline-block;">
                ' . $otp . '
            </div>
            <p style="font-size:13px;color:#999;">If you did not request this, please ignore this email.</p>
        </div>
    </div>
</div>';

sendMail($email, $subject, $message);

// Redirect to OTP Verify Page
header("Location: otp-verify.php");
exit;
?>
