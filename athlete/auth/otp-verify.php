<?php
include '../../config/session.php';
if (!isset($_SESSION['otp_email'])) {
    header("Location: login.php");
    exit;
}

$error = isset($_GET['error']) ? $_GET['error'] : '';
$errorMsg = '';
if($error == 'invalid_otp') {
    $errorMsg = 'The OTP you entered is incorrect.';
} else if($error == 'expired') {
    $errorMsg = 'Your OTP has expired. Please log in again.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP — Sports Management</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #f8fafc; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; }
        .otp-box { background: white; padding: 40px; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); text-align: center; max-width: 400px; width: 100%; }
        h2 { color: #000052; margin-bottom: 10px; font-weight: 800; }
        p { color: #64748b; font-size: 14px; margin-bottom: 25px; line-height: 1.6; }
        .otp-input { width: 100%; text-align: center; font-size: 24px; letter-spacing: 8px; font-weight: bold; padding: 15px; border: 2px solid #cbd5e1; border-radius: 8px; margin-bottom: 20px; color: #0f172a; outline: none; transition: border-color 0.3s; }
        .otp-input:focus { border-color: #0ff0fc; }
        .btn-submit { background: #000052; color: white; border: none; padding: 14px; width: 100%; border-radius: 8px; font-weight: bold; font-size: 16px; cursor: pointer; transition: background 0.3s; }
        .btn-submit:hover { background: #000030; }
        .alert { background: #fee2e2; color: #991b1b; padding: 12px; border-radius: 8px; font-size: 14px; margin-bottom: 20px; font-weight: 500; }
    </style>
</head>
<body>

<div class="otp-box">
    <i class="bi bi-shield-lock-fill" style="font-size: 48px; color: #0ff0fc; margin-bottom: 15px; display: inline-block;"></i>
    <h2>Secure Verification</h2>
    <p>We've sent a 6-digit OTP to your registered email.<br><strong><?php echo htmlspecialchars($_SESSION['otp_email']); ?></strong></p>

    <?php if($errorMsg): ?>
        <div class="alert"><?php echo $errorMsg; ?></div>
    <?php endif; ?>

    <form action="otp-action.php" method="POST">
        <input type="text" name="otp" class="otp-input" maxlength="6" placeholder="000000" autocomplete="off" required>
        <button type="submit" name="verify_otp" class="btn-submit">Verify & Sign In</button>
    </form>
    
    <div style="margin-top: 20px; font-size: 13px;">
        <a href="login.php" style="color: #64748b; text-decoration: none;">&larr; Use a different email</a>
    </div>
</div>

</body>
</html>
