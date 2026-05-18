<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="../assets/images/logo.svg">
    <title>Admin Login — Sports Management System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="../assets/css/auth-style.css">
    <link rel="stylesheet" href="../assets/css/log-sign.css">
    <link rel="stylesheet" href="../assets/css/error-animation.css">
</head>
<body class="auth-page">

<!-- ============================================================
     AUTH WRAPPER
     ============================================================ -->
<div class="auth-wrapper">

    <!-- ── LEFT: BRAND PANEL ── -->
    <div class="auth-panel auth-panel--brand">

        <!-- Background layers -->
        <div class="brand-backdrop">
            <div class="brand-glow"></div>
            <div class="brand-glow-2"></div>
            <div class="brand-grid"></div>
            <div class="brand-lines">
                <div class="speed-line"></div>
                <div class="speed-line"></div>
                <div class="speed-line"></div>
                <div class="speed-line"></div>
                <div class="speed-line"></div>
            </div>
            <div class="floating-orb orb-1"></div>
            <div class="floating-orb orb-2"></div>
            <div class="floating-orb orb-3"></div>
        </div>

        <!-- Top: Logo -->
        <div class="brand-top">
            <div class="brand-logo">
                <div class="brand-logo-icon">
                    <!-- Trophy / Sport icon -->
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L8 6H4V10C4 14.4 7.4 18.2 12 19C16.6 18.2 20 14.4 20 10V6H16L12 2Z" fill="#000052"/>
                        <path d="M8 6H4V10C4 12.5 5.4 14.8 7.5 16.3L8 6Z" fill="rgba(0,0,82,0.3)"/>
                        <path d="M10 21H14V23H10V21Z" fill="#000052"/>
                        <path d="M8 23H16V24H8V23Z" fill="#000052"/>
                    </svg>
                </div>
                <div class="brand-logo-text">
                    Sports Management
                    <span>Admin System</span>
                </div>
            </div>
        </div>

        <!-- Middle: Headline & Stats -->
        <div class="brand-middle">
            <div class="brand-badge">
                <span class="brand-badge-dot"></span>
                <span class="brand-badge-text">Live Platform</span>
            </div>

            <div class="brand-headline">
                <h1>
                    ELEVATE
                    <span class="accent">YOUR</span>
                    GAME
                </h1>
                <div class="brand-divider"></div>
                <p>
                    Professional athlete management platform for clubs and sports
                    organizations — built for performance.
                </p>
            </div>

            <div class="brand-stats">
                <div class="brand-stat">
                    <span class="brand-stat-number">2,400+</span>
                    <span class="brand-stat-label">Athletes</span>
                </div>
                <div class="brand-stat">
                    <span class="brand-stat-number">180+</span>
                    <span class="brand-stat-label">Clubs</span>
                </div>
                <div class="brand-stat">
                    <span class="brand-stat-number">99.9%</span>
                    <span class="brand-stat-label">Uptime</span>
                </div>
            </div>
        </div>

        <!-- Bottom: Copyright -->
        <div class="brand-bottom">
            <p class="brand-footer-text">© 2026 Sports Club Management System</p>
        </div>

    </div><!-- /brand panel -->

    <!-- ── RIGHT: FORM PANEL ── -->
    <div class="auth-panel auth-panel--form">

        <div class="form-container">

            <!-- Header -->
            <div class="form-header">
                    <!-- ============================================================
                        PREMIUM ANIMATED LOGIN ERROR SYSTEM
                        ADD THIS INSIDE YOUR LOGIN FORM
                        PLACE BELOW <div class="form-header">
                        ============================================================ -->

                    <!-- ERROR MESSAGE CONTAINER -->
                    <div id="auth-error-box" class="auth-error-box">

                        <div class="auth-error-icon">

                            <svg viewBox="0 0 24 24" fill="none">

                                <circle
                                    cx="12"
                                    cy="12"
                                    r="10"
                                    stroke="currentColor"
                                    stroke-width="2"
                                />

                                <path
                                    d="M12 7V13"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                />

                                <circle
                                    cx="12"
                                    cy="17"
                                    r="1.2"
                                    fill="currentColor"
                                />

                            </svg>

                        </div>

                        <div class="auth-error-content">

                            <span class="auth-error-title">
                                Login Failed
                            </span>

                            <p id="auth-error-text">
                                Invalid credentials.
                            </p>

                        </div>

                    </div>


                <span class="form-badge">Admin Access</span>
                <h2>Welcome Back</h2>
                <p>Sign in to your dashboard to manage athletes, clubs, and performance data.</p>
            </div>

            <!-- Login Form — logic unchanged -->
            <form action="login-action.php" method="POST" novalidate>

                <div class="auth-form-group">
                    <label class="auth-label" for="login-email">Email Address</label>
                    <input
                        type="email"
                        id="login-email"
                        name="email"
                        class="auth-input"
                        placeholder="admin@sportsclub.com"
                        autocomplete="email"
                        required>
                </div>

                <div class="auth-form-group">
                    <label class="auth-label" for="login-password">Password</label>
                    <div class="input-wrapper">
                        <input
                            type="password"
                            id="login-password"
                            name="password"
                            class="auth-input"
                            placeholder="Enter your password"
                            autocomplete="current-password"
                            required>
                        <button type="button" class="input-eye-btn" onclick="togglePassword('login-password', this)" aria-label="Toggle password visibility">
                            <!-- Eye icon (visible) -->
                            <svg id="eye-icon-login" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12S5 4 12 4s11 8 11 8-4 8-11 8S1 12 1 12z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit" name="admin_login" class="btn-auth-submit">
                    Sign In to Dashboard
                </button>

            </form>

            <div class="form-sep">
                <div class="form-sep-line"></div>
                <span class="form-sep-text">or</span>
                <div class="form-sep-line"></div>
            </div>

            <div class="form-footer-link">
                <p>New admin? <a href="signup.php">Create an account</a></p>
            </div>

        </div><!-- /form-container -->

    </div><!-- /form panel -->

</div><!-- /auth-wrapper -->

<script src="../assets/js/error.js"></script>
<script>
    function togglePassword(inputId, btn) {
        var input = document.getElementById(inputId);
        var icon  = btn.querySelector('svg');
        if (input.type === 'password') {
            input.type = 'text';
            // Switch to eye-off icon
            icon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>';
        } else {
            input.type = 'password';
            // Switch back to eye icon
            icon.innerHTML = '<path d="M1 12S5 4 12 4s11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/>';
        }
    }
</script>

</body>
</html>