<?php
include '../../config/session.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['verify_otp'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['otp_email']) || !isset($_SESSION['athlete_otp'])) {
    header("Location: login.php");
    exit;
}

$entered_otp = trim($_POST['otp']);

// Check expiry (10 mins)
if(time() - $_SESSION['otp_time'] > 600) {
    session_unset();
    header("Location: otp-verify.php?error=expired");
    exit;
}

if ($entered_otp == $_SESSION['athlete_otp']) {
    // Success! Log them in
    $_SESSION['athlete_logged_in'] = true;
    $_SESSION['athlete_id'] = $_SESSION['otp_athlete_id'];
    $_SESSION['athlete_application_no'] = $_SESSION['otp_registration_no'];
    
    // Clear OTP data
    unset($_SESSION['athlete_otp']);
    unset($_SESSION['otp_email']);
    unset($_SESSION['otp_athlete_id']);
    unset($_SESSION['otp_registration_no']);
    unset($_SESSION['otp_time']);
    
    header("Location: ../profile/dashboard.php");
    exit;
} else {
    // Failed
    header("Location: otp-verify.php?error=invalid_otp");
    exit;
}
?>
