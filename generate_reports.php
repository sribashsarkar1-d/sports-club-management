<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isRemoteEnabled', true);

// 1. Completed Tasks PDF
$htmlComplete = '
<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: "Helvetica", sans-serif; color: #1e293b; line-height: 1.6; }
        .header { background: #16a34a; color: white; padding: 20px; text-align: center; border-radius: 8px; margin-bottom: 30px; }
        h1 { margin: 0; font-size: 24px; text-transform: uppercase; }
        .task-list { margin: 0; padding: 0; list-style: none; }
        .task-item { background: #f8fafc; border-left: 4px solid #16a34a; padding: 15px; margin-bottom: 15px; border-radius: 4px; }
        .task-title { font-weight: bold; font-size: 16px; color: #0f172a; margin-bottom: 5px; }
        .task-desc { font-size: 14px; color: #475569; margin: 0; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Completed Tasks Report</h1>
        <p style="margin: 5px 0 0 0;">Sports Club Management System</p>
    </div>

    <ul class="task-list">
        <li class="task-item">
            <div class="task-title">Database Schema Integration</div>
            <p class="task-desc">Successfully aligned system with existing SQL schema (Athletes, Clubs, Competitions, Documents).</p>
        </li>
        <li class="task-item">
            <div class="task-title">Admin Dashboard & UI Base</div>
            <p class="task-desc">Established responsive sidebar, top navbar, and statistics cards for the admin area.</p>
        </li>
        <li class="task-item">
            <div class="task-title">Athlete Management Module</div>
            <p class="task-desc">List, view, and manage athlete profiles. Automated PDF ID Card and QR code generation.</p>
        </li>
        <li class="task-item">
            <div class="task-title">Document Verification Module</div>
            <p class="task-desc">Dedicated UI to review uploaded certificates and Aadhaar cards, with Approve/Reject workflows.</p>
        </li>
        <li class="task-item">
            <div class="task-title">Payments & Invoices Module</div>
            <p class="task-desc">Manual invoice generation, payment status tracking, and downloadable PDF receipts.</p>
        </li>
        <li class="task-item">
            <div class="task-title">Tournaments & Competitions Module</div>
            <p class="task-desc">Register athletes for specific events, specifying age group, weight category, and level.</p>
        </li>
        <li class="task-item">
            <div class="task-title">Clubs & Coaches Module</div>
            <p class="task-desc">Register affiliated clubs, assign athletes, and auto-generate a centralized Coaches Directory.</p>
        </li>
        <li class="task-item">
            <div class="task-title">Athlete Frontend Registration Flow</div>
            <p class="task-desc">Complete 6-step multi-page application form with document uploads.</p>
        </li>
        <li class="task-item">
            <div class="task-title">Athlete Portal Dashboard</div>
            <p class="task-desc">Secure portal for athletes to track pending invoices, verification status, and registered tournaments.</p>
        </li>
    </ul>
</body>
</html>
';

$dompdfComplete = new Dompdf($options);
$dompdfComplete->loadHtml($htmlComplete);
$dompdfComplete->setPaper('A4', 'portrait');
$dompdfComplete->render();
file_put_contents('Completed_Tasks.pdf', $dompdfComplete->output());


// 2. Incomplete Tasks PDF
$htmlIncomplete = '
<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: "Helvetica", sans-serif; color: #1e293b; line-height: 1.6; }
        .header { background: #dc2626; color: white; padding: 20px; text-align: center; border-radius: 8px; margin-bottom: 30px; }
        h1 { margin: 0; font-size: 24px; text-transform: uppercase; }
        .task-list { margin: 0; padding: 0; list-style: none; }
        .task-item { background: #fef2f2; border-left: 4px solid #dc2626; padding: 15px; margin-bottom: 15px; border-radius: 4px; }
        .task-title { font-weight: bold; font-size: 16px; color: #991b1b; margin-bottom: 5px; }
        .task-desc { font-size: 14px; color: #7f1d1d; margin: 0; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Incomplete / Pending Tasks Report</h1>
        <p style="margin: 5px 0 0 0;">Sports Club Management System</p>
    </div>

    <ul class="task-list">
        <li class="task-item">
            <div class="task-title">1. Public Landing Page (Homepage)</div>
            <p class="task-desc">Build the root index.php with a modern, premium UI (Hero section, features list) linking to the registration and login portals.</p>
        </li>
        <li class="task-item">
            <div class="task-title">2. Roles & Permissions (RBAC) Enforcement</div>
            <p class="task-desc">Implement strict access control to differentiate between Super Admins and regular Admins in the settings module.</p>
        </li>
        <li class="task-item">
            <div class="task-title">3. Live Payment Gateway Integration</div>
            <p class="task-desc">Replace the offline/manual payment marking with a real gateway (e.g., Razorpay/Stripe) API integration for the athlete portal.</p>
        </li>
        <li class="task-item">
            <div class="task-title">4. Real Email/SMS Integration</div>
            <p class="task-desc">Configure SMTP (PHPMailer) and a real SMS API provider (like Twilio/Msg91) to send actual notifications instead of local mock functions.</p>
        </li>
        <li class="task-item">
            <div class="task-title">5. Production Security Audit</div>
            <p class="task-desc">Final polish before deployment: implement CSRF tokens on forms, ensure strict password hashing, and configure error logging.</p>
        </li>
    </ul>
</body>
</html>
';

$dompdfIncomplete = new Dompdf($options);
$dompdfIncomplete->loadHtml($htmlIncomplete);
$dompdfIncomplete->setPaper('A4', 'portrait');
$dompdfIncomplete->render();
file_put_contents('Incomplete_Tasks.pdf', $dompdfIncomplete->output());

echo "PDFs Generated Successfully!";
?>
