<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Club Management System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #000052;
            --accent: #0ff0fc;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --bg-light: #f8fafc;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: var(--bg-light); color: var(--text-dark); line-height: 1.6; overflow-x: hidden; }

        /* Navbar */
        nav { display: flex; justify-content: space-between; align-items: center; padding: 20px 5%; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); position: fixed; width: 100%; top: 0; z-index: 1000; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .logo { font-size: 24px; font-weight: 900; color: var(--primary); text-decoration: none; display: flex; align-items: center; gap: 10px; }
        .logo span { color: #0ea5e9; }
        .nav-links { display: flex; gap: 30px; align-items: center; }
        .nav-links a { text-decoration: none; color: var(--text-dark); font-weight: 500; transition: color 0.3s; }
        .nav-links a:hover { color: var(--primary); }
        
        .btn-primary { background: var(--primary); color: white !important; padding: 12px 24px; border-radius: 8px; font-weight: 600; text-decoration: none; transition: all 0.3s; border: 2px solid var(--primary); }
        .btn-primary:hover { background: transparent; color: var(--primary) !important; }
        .btn-accent { background: var(--accent); color: var(--primary) !important; padding: 14px 32px; border-radius: 8px; font-weight: 700; text-decoration: none; transition: all 0.3s; box-shadow: 0 4px 15px rgba(15, 240, 252, 0.3); border: 2px solid var(--accent); display: inline-block; }
        .btn-accent:hover { background: transparent; color: var(--accent) !important; }
        .btn-outline-light { background: transparent; color: white !important; padding: 14px 32px; border-radius: 8px; font-weight: 600; text-decoration: none; transition: all 0.3s; border: 2px solid rgba(255,255,255,0.2); display: inline-block; }
        .btn-outline-light:hover { border-color: white; background: rgba(255,255,255,0.1); }

        /* Hero */
        .hero { background: linear-gradient(135deg, var(--primary) 0%, #000030 100%); min-height: 100vh; display: flex; align-items: center; padding: 0 5%; position: relative; overflow: hidden; }
        .hero::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: radial-gradient(circle at 80% 20%, rgba(15, 240, 252, 0.15) 0%, transparent 40%); }
        .hero-content { max-width: 800px; color: white; position: relative; z-index: 10; margin-top: 60px; }
        .badge { background: rgba(15, 240, 252, 0.1); color: var(--accent); padding: 6px 16px; border-radius: 20px; font-weight: 600; font-size: 14px; display: inline-block; margin-bottom: 20px; border: 1px solid rgba(15, 240, 252, 0.2); }
        .hero h1 { font-size: 4.5rem; font-weight: 900; line-height: 1.1; margin-bottom: 20px; }
        .hero h1 span { color: var(--accent); }
        .hero p { font-size: 1.25rem; color: rgba(255,255,255,0.8); margin-bottom: 40px; max-width: 600px; }
        .hero-btns { display: flex; gap: 20px; }

        /* Section Global */
        .feature-section { padding: 100px 5%; background: white; display: flex; align-items: center; gap: 50px; justify-content: space-between; }
        .feature-section:nth-child(even) { background: var(--bg-light); flex-direction: row-reverse; }
        .feature-content { flex: 1; max-width: 500px; }
        .feature-content h2 { font-size: 2.5rem; color: var(--primary); font-weight: 800; margin-bottom: 20px; }
        .feature-content p { color: var(--text-light); font-size: 1.1rem; margin-bottom: 30px; }
        .feature-visual { flex: 1; position: relative; display: flex; justify-content: center; }
        
        /* Visual Mocks */
        .mock-card { background: white; border-radius: 20px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.15); border: 1px solid #e2e8f0; overflow: hidden; width: 100%; max-width: 450px; position: relative; }
        
        /* Profile Mock */
        .profile-header { background: linear-gradient(135deg, var(--primary), #0ea5e9); height: 100px; }
        .profile-avatar { width: 80px; height: 80px; border-radius: 50%; background: white; margin: -40px auto 10px; display: flex; align-items: center; justify-content: center; font-size: 40px; color: var(--primary); border: 4px solid white; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .profile-info { text-align: center; padding: 0 20px 30px; }
        .profile-info h3 { color: var(--text-dark); margin-bottom: 5px; }
        .profile-info p { color: var(--text-light); font-size: 14px; margin-bottom: 15px; }
        .qr-placeholder { width: 100px; height: 100px; border: 2px dashed #cbd5e1; margin: 0 auto; display: flex; align-items: center; justify-content: center; color: #cbd5e1; }

        /* Tournament Mock */
        .tourney-list { padding: 20px; }
        .tourney-item { display: flex; align-items: center; justify-content: space-between; padding: 15px; border: 1px solid #e2e8f0; border-radius: 12px; margin-bottom: 15px; }
        .tourney-item div { font-weight: 600; color: var(--text-dark); }
        .tourney-item span { font-size: 12px; color: var(--text-light); display: block; }
        .tourney-badge { background: #e0f2fe; color: #0284c7; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: bold; }

        /* Billing Mock */
        .bill-amount { text-align: center; padding: 40px 20px; border-bottom: 1px solid #e2e8f0; }
        .bill-amount h4 { color: var(--text-light); text-transform: uppercase; letter-spacing: 1px; font-size: 12px; margin-bottom: 10px; }
        .bill-amount h2 { font-size: 3rem; color: var(--primary); }
        .bill-status { background: #dcfce7; color: #166534; display: inline-block; padding: 5px 15px; border-radius: 20px; font-weight: bold; font-size: 14px; margin-top: 10px; }
        .bill-items { padding: 20px; }
        .bill-item { display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 14px; color: var(--text-light); }

        /* Lists */
        .feature-list { list-style: none; margin-bottom: 30px; }
        .feature-list li { margin-bottom: 12px; display: flex; align-items: center; gap: 10px; color: var(--text-dark); font-weight: 500; }
        .feature-list li i { color: #10b981; font-size: 1.2rem; }

        /* CTA Section */
        .cta { background: var(--bg-light); padding: 100px 5%; text-align: center; }
        .cta-box { background: var(--primary); padding: 60px 40px; border-radius: 24px; color: white; max-width: 1000px; margin: 0 auto; position: relative; overflow: hidden; }
        .cta-box h2 { font-size: 2.5rem; margin-bottom: 20px; position: relative; z-index: 10; }

        /* Footer */
        footer { background: #000030; color: rgba(255,255,255,0.6); padding: 40px 5%; text-align: center; }
        .footer-links { margin-top: 20px; display: flex; justify-content: center; gap: 20px; }
        .footer-links a { color: rgba(255,255,255,0.6); text-decoration: none; transition: color 0.3s; }
        .footer-links a:hover { color: var(--accent); }

        @media (max-width: 900px) {
            .feature-section, .feature-section:nth-child(even) { flex-direction: column; text-align: center; }
            .feature-list li { justify-content: center; }
        }
        @media (max-width: 768px) {
            .hero h1 { font-size: 3rem; }
            .nav-links { display: none; }
            .hero-btns { flex-direction: column; }
        }
    </style>
</head>
<body>

    <!-- Navigation -->
    <nav>
        <a href="index.php" class="logo">
            <i class="bi bi-trophy-fill" style="color: var(--accent);"></i> SCM<span>.</span>
        </a>
        <div class="nav-links">
            <a href="#digital-profile">Digital Profile</a>
            <a href="#tournaments">Tournaments</a>
            <a href="#billing">Billing</a>
            <a href="athlete/auth/login.php">Athlete Portal</a>
        </div>
        <div class="nav-links" style="gap: 15px;">
            <a href="admin/auth/login.php" class="btn-primary" style="background: transparent; color: var(--primary) !important;">Staff Login</a>
            <a href="athlete/registration/register.php" class="btn-primary">Register</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <div class="badge">Official Registration Portal 2026</div>
            <h1>Elevate Your<br>Athletic <span>Journey.</span></h1>
            <p>Join the premier sports club. Register for competitions, track your progress, and manage your profile through our state-of-the-art digital platform.</p>
            <div class="hero-btns">
                <a href="athlete/registration/register.php" class="btn-accent">
                    Start Application <i class="bi bi-arrow-right" style="margin-left: 8px;"></i>
                </a>
                <a href="athlete/auth/login.php" class="btn-outline-light">
                    Athlete Login
                </a>
            </div>
        </div>
    </section>

    <!-- Feature 1: Digital Athlete Profile -->
    <section id="digital-profile" class="feature-section">
        <div class="feature-content">
            <h2>Digital Athlete Profile</h2>
            <p>Every registered athlete receives a secure, personalized portal. No more carrying paper files—your entire sports identity is accessible instantly from anywhere.</p>
            <ul class="feature-list">
                <li><i class="bi bi-check-circle-fill"></i> Auto-generated ID Cards</li>
                <li><i class="bi bi-check-circle-fill"></i> Integrated QR Code Verification</li>
                <li><i class="bi bi-check-circle-fill"></i> Centralized Document Vault</li>
            </ul>
            <a href="athlete/registration/register.php" class="btn-primary">Create Your Profile</a>
        </div>
        <div class="feature-visual">
            <div class="mock-card">
                <div class="profile-header"></div>
                <div class="profile-avatar"><i class="bi bi-person-fill"></i></div>
                <div class="profile-info">
                    <h3>John Doe</h3>
                    <p>Registration: APP_98213</p>
                    <div class="qr-placeholder"><i class="bi bi-qr-code-scan" style="font-size: 40px;"></i></div>
                    <p style="margin-top: 15px; color: #10b981; font-weight: bold;"><i class="bi bi-shield-check"></i> Verified Athlete</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Feature 2: Tournament Tracking -->
    <section id="tournaments" class="feature-section">
        <div class="feature-visual">
            <div class="mock-card">
                <div class="tourney-list">
                    <h3 style="margin-bottom: 20px; color: var(--primary);">My Tournaments</h3>
                    <div class="tourney-item">
                        <div>National Athletics Meet<span>U-18 Boys 100m Sprint</span></div>
                        <span class="tourney-badge">Registered</span>
                    </div>
                    <div class="tourney-item">
                        <div>State Championship 2026<span>Long Jump Category</span></div>
                        <span class="tourney-badge" style="background: #fef3c7; color: #d97706;">Pending</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="feature-content">
            <h2>Tournament Tracking</h2>
            <p>Never miss a competition deadline. Keep complete track of all your event entries, age-group assignments, and participation levels.</p>
            <ul class="feature-list">
                <li><i class="bi bi-check-circle-fill"></i> Live Event Status</li>
                <li><i class="bi bi-check-circle-fill"></i> Automatic Age Grouping</li>
                <li><i class="bi bi-check-circle-fill"></i> Club & Coach Affiliation</li>
            </ul>
            <a href="athlete/auth/login.php" class="btn-primary">View Your Events</a>
        </div>
    </section>

    <!-- Feature 3: Transparent Billing -->
    <section id="billing" class="feature-section">
        <div class="feature-content">
            <h2>Transparent Billing</h2>
            <p>Complete financial transparency. View your itemized invoices for registration and tournament fees, and download your official receipts instantly.</p>
            <ul class="feature-list">
                <li><i class="bi bi-check-circle-fill"></i> Digital Invoicing</li>
                <li><i class="bi bi-check-circle-fill"></i> Downloadable PDF Receipts</li>
                <li><i class="bi bi-check-circle-fill"></i> Live Payment Status</li>
            </ul>
        </div>
        <div class="feature-visual">
            <div class="mock-card">
                <div class="bill-amount">
                    <h4>Invoice #INV-0042</h4>
                    <h2>₹1,500</h2>
                    <div class="bill-status"><i class="bi bi-check-lg"></i> Paid Successfully</div>
                </div>
                <div class="bill-items">
                    <div class="bill-item"><span>Registration Fee</span><span>₹1000</span></div>
                    <div class="bill-item"><span>State Tournament Entry</span><span>₹500</span></div>
                    <div class="bill-item" style="border-top: 1px solid #e2e8f0; padding-top: 10px; margin-top: 10px; font-weight: bold; color: var(--text-dark);">
                        <span>Total Paid</span><span>₹1,500</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="cta-box">
            <h2>Ready to start your journey?</h2>
            <p style="font-size: 1.2rem; margin-bottom: 30px; opacity: 0.9;">Registrations for the upcoming season are currently open.</p>
            <a href="athlete/registration/register.php" class="btn-accent" style="background: white; color: var(--primary) !important; border: none;">
                Join The Club Now
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div style="font-size: 24px; font-weight: 900; margin-bottom: 20px;">
            <i class="bi bi-trophy-fill" style="color: var(--accent);"></i> SCM<span>.</span>
        </div>
        <div>&copy; <?php echo date('Y'); ?> Sports Club Management. All rights reserved.</div>
        <div class="footer-links">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
            <a href="admin/auth/login.php">Staff Login</a>
        </div>
    </footer>

</body>
</html>
