<?php
include '../../config/session.php';
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$error = isset($_GET['error']) ? $_GET['error'] : '';
$errorMsg = '';
$errorTitle = 'Login Failed';

if($error == 'empty_email') {
    $errorMsg = 'Please enter your registered email address.';
} else if($error == 'not_found') {
    $errorMsg = 'No athlete found with this email address.';
} else if($error == 'pending') {
    $errorTitle = 'Approval Required';
    $errorMsg = 'Your registration is pending admin verification. You will be notified via email once approved.';
} else if($error == 'rejected') {
    $errorTitle = 'Application Rejected';
    $errorMsg = 'Your application has been rejected. Please contact support.';
} else if($error == 'server_error') {
    $errorMsg = 'An unexpected server error occurred.';
} else if($error == 'csrf_failed') {
    $errorMsg = 'Security token invalid. Please try again.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="../../assets/images/logo.svg">
    <title>Athlete Login — Sports Management System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="../../assets/css/auth-style.css">
    <link rel="stylesheet" href="../../assets/css/log-sign.css">
    <link rel="stylesheet" href="../../assets/css/error-animation.css">
</head>
<body class="auth-page">

<div class="auth-wrapper">

    <!-- ── LEFT: BRAND PANEL ── -->
    <div class="auth-panel auth-panel--brand" style="background: linear-gradient(135deg, #0f172a 0%, #000052 100%);">

        <!-- Background layers -->
        <div class="brand-backdrop">
            <div class="brand-glow" style="background: rgba(15,240,252,0.15);"></div>
            <div class="brand-glow-2"></div>
            <div class="brand-grid"></div>
            <div class="floating-orb orb-1"></div>
            <div class="floating-orb orb-2"></div>
        </div>

        <!-- Top: Logo -->
        <div class="brand-top">
            <div class="brand-logo">
                <div class="brand-logo-icon">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L8 6H4V10C4 14.4 7.4 18.2 12 19C16.6 18.2 20 14.4 20 10V6H16L12 2Z" fill="#0ff0fc"/>
                    </svg>
                </div>
                <div class="brand-logo-text" style="color: white;">
                    Sports Management
                    <span style="color: #0ff0fc;">Athlete Portal</span>
                </div>
            </div>
        </div>

        <!-- Middle: Headline & Stats -->
        <div class="brand-middle">
            <div class="brand-badge">
                <span class="brand-badge-dot"></span>
                <span class="brand-badge-text">Secure Access</span>
            </div>

            <div class="brand-headline">
                <h1 style="color: white;">
                    WELCOME
                    <span class="accent" style="color: #0ff0fc;">BACK</span>
                </h1>
                <div class="brand-divider"></div>
                <p style="color: rgba(255,255,255,0.8);">
                    Access your digital athlete profile, track your tournaments, and manage your billing securely.
                </p>
            </div>
        </div>

        <div class="brand-bottom">
            <p class="brand-footer-text">© <?php echo date('Y'); ?> Sports Club Management System</p>
        </div>

    </div>

    <!-- ── RIGHT: FORM PANEL ── -->
    <div class="auth-panel auth-panel--form">
        <div class="form-container">

            <!-- Header -->
            <div class="form-header">
                
                <div id="auth-error-box" class="auth-error-box">
                    <div class="auth-error-icon">
                        <svg viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                            <path d="M12 7V13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <circle cx="12" cy="17" r="1.2" fill="currentColor"/>
                        </svg>
                    </div>
                    <div class="auth-error-content">
                        <span class="auth-error-title">Login Failed</span>
                        <p id="auth-error-text"></p>
                    </div>
                </div>

                <span class="form-badge">Athlete Login</span>
                <h2>Sign In</h2>
                <p>Enter your registered email address to receive a secure One-Time Password (OTP).</p>
            </div>

            <!-- Login Form -->
            <form action="login-action.php" method="POST" novalidate>
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                <div class="auth-form-group">
                    <label class="auth-label" for="login-email">Registered Email Address</label>
                    <input
                        type="email"
                        id="login-email"
                        name="email"
                        class="auth-input"
                        placeholder="athlete@example.com"
                        autocomplete="email"
                        required>
                </div>

                <button type="submit" name="request_otp" class="btn-auth-submit" style="background: #000052;">
                    Send OTP to Email
                </button>
            </form>

            <div class="form-sep">
                <div class="form-sep-line"></div>
                <span class="form-sep-text">or</span>
                <div class="form-sep-line"></div>
            </div>

            <div class="form-footer-link">
                <p>Don't have an account? <a href="../registration/register.php">Register Now</a></p>
            </div>

        </div>
    </div>

</div>

<!-- Only load error animation script if there was an actual auth error shown to trigger the shake -->
<script src="../../assets/js/error.js"></script>

</body>
</html>
