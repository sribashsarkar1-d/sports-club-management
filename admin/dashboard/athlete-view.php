<?php
include '../../config/session.php';
include '../../config/database.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../auth/login.php");
    exit;
}


/* ── Athlete ID ── */
$id = intval($_GET['id'] ?? 0);
if ($id <= 0) { die("Invalid Athlete ID"); }

/* ── Fetch full athlete record ── */
$query = mysqli_query($conn,
    "SELECT *
     FROM athletes a
     LEFT JOIN guardians g    ON a.athlete_id = g.athlete_id
     LEFT JOIN addresses ad   ON a.athlete_id = ad.athlete_id
     LEFT JOIN clubs cl       ON a.athlete_id = cl.athlete_id
     LEFT JOIN competitions cp ON a.athlete_id = cp.athlete_id
     LEFT JOIN documents d    ON a.athlete_id = d.athlete_id
     WHERE a.athlete_id='$id'
     LIMIT 1"
);

if (mysqli_num_rows($query) == 0) { die("Athlete Not Found"); }
$athlete = mysqli_fetch_assoc($query);

/* ── Profile photo ── */
$profilePhoto = '../../athlete/assets/uploads/photos/' . ($athlete['profile_photo'] ?? '');
if (empty($athlete['profile_photo']) || !file_exists($profilePhoto)) {
    $profilePhoto = '../assets/images/default-user.png';
}

/* ── Status meta ── */
$status = $athlete['athlete_status'] ?? 'Pending';
$statusBadgeClass = 'profile-status--pending';
$statusIcon       = 'bi-hourglass-split';
if ($status === 'Approved') { $statusBadgeClass = 'profile-status--approved'; $statusIcon = 'bi-check-circle-fill'; }
if ($status === 'Rejected') { $statusBadgeClass = 'profile-status--rejected'; $statusIcon = 'bi-x-circle-fill'; }

/* ── Document list ── */
$documents = [
    ['file' => $athlete['aadhaar_file']               ?? '', 'label' => 'Aadhaar File',              'icon' => 'bi-credit-card-2-front-fill',  'folder' => 'aadhaar/'],
    ['file' => $athlete['birth_certificate']           ?? '', 'label' => 'Birth Certificate',          'icon' => 'bi-file-earmark-person-fill',  'folder' => 'birth/'],
    ['file' => $athlete['medical_certificate']         ?? '', 'label' => 'Medical Certificate',        'icon' => 'bi-heart-pulse-fill',          'folder' => 'medical/'],
    ['file' => $athlete['parent_consent_file']         ?? '', 'label' => 'Parent Consent',             'icon' => 'bi-file-earmark-check-fill',   'folder' => 'parent/'],
    ['file' => $athlete['club_certificate_file']       ?? '', 'label' => 'Club Certificate',           'icon' => 'bi-award-fill',                'folder' => 'club/'],
    ['file' => $athlete['achievement_certificate_file'] ?? '', 'label' => 'Achievement Certificate',  'icon' => 'bi-trophy-fill',               'folder' => 'achievement/'],
    ['file' => $athlete['photo_id_proof']              ?? '', 'label' => 'Photo ID Proof',             'icon' => 'bi-person-vcard-fill',         'folder' => 'proof/'],
    ['file' => $athlete['additional_document']         ?? '', 'label' => 'Additional Document',        'icon' => 'bi-paperclip',                 'folder' => 'additional/'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" type="image/svg+xml" href="../assets/images/logo.svg">
  <title>Athlete Profile — Sports Management</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../assets/css/admin-style.css">
  <style>
    /* ================================================================
       ATHLETE VIEW PAGE — Design tokens from admin-style.css
    ================================================================ */

    /* ── Page header ── */
    .view-header {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      margin-bottom: var(--sp-6);
      flex-wrap: wrap;
      gap: var(--sp-4);
      animation: pageEnter 0.4s cubic-bezier(0.0, 0.0, 0.2, 1) both;
    }
    .view-header h1 {
      font-family: var(--font-heading);
      font-size: 1.65rem;
      font-weight: 800;
      color: var(--text);
      letter-spacing: -0.02em;
      line-height: 1.15;
      margin-bottom: 4px;
    }
    .view-header p {
      font-size: 0.875rem;
      color: var(--text-muted);
    }
    .view-header-actions {
      display: flex;
      gap: var(--sp-3);
      flex-wrap: wrap;
    }
    .btn-back {
      display: inline-flex;
      align-items: center;
      gap: var(--sp-2);
      padding: 9px var(--sp-5);
      border-radius: var(--r-md);
      background: var(--white);
      border: 1.5px solid var(--gray-200);
      color: var(--graphite);
      font-family: var(--font-body);
      font-size: 0.85rem;
      font-weight: 600;
      text-decoration: none;
      transition: border-color var(--ease-fast), color var(--ease-fast), transform var(--ease-fast);
    }
    .btn-back:hover {
      border-color: var(--navy);
      color: var(--navy);
      text-decoration: none;
      transform: translateY(-1px);
    }
    .btn-pdf {
      display: inline-flex;
      align-items: center;
      gap: var(--sp-2);
      padding: 9px var(--sp-5);
      border-radius: var(--r-md);
      background: var(--error);
      border: 1.5px solid var(--error);
      color: var(--white);
      font-family: var(--font-body);
      font-size: 0.85rem;
      font-weight: 600;
      text-decoration: none;
      transition: background var(--ease-fast), transform var(--ease-fast), box-shadow var(--ease-fast);
    }
    .btn-pdf:hover {
      background: #cc0044;
      border-color: #cc0044;
      color: var(--white);
      text-decoration: none;
      transform: translateY(-1px);
      box-shadow: var(--shadow-md);
    }

    /* ── Profile hero ── */
    .profile-hero {
      background: linear-gradient(135deg, var(--navy-deep) 0%, var(--navy) 55%, var(--navy-mid) 100%);
      border-radius: var(--r-xl);
      padding: var(--sp-10) var(--sp-8);
      position: relative;
      overflow: hidden;
      margin-bottom: var(--sp-6);
      animation: cardEnter 0.45s cubic-bezier(0.0, 0.0, 0.2, 1) 0.05s both;
    }
    /* Grid overlay */
    .profile-hero::before {
      content: '';
      position: absolute;
      inset: 0;
      background-image:
        linear-gradient(rgba(15, 240, 252, 0.05) 1px, transparent 1px),
        linear-gradient(90deg, rgba(15, 240, 252, 0.05) 1px, transparent 1px);
      background-size: 44px 44px;
      pointer-events: none;
    }
    /* Glow orb top-right */
    .profile-hero::after {
      content: '';
      position: absolute;
      width: 420px;
      height: 420px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(15, 240, 252, 0.13) 0%, transparent 65%);
      top: -120px;
      right: -80px;
      pointer-events: none;
    }
    /* Second glow orb bottom-left */
    .hero-glow-bl {
      position: absolute;
      width: 280px;
      height: 280px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(15, 240, 252, 0.06) 0%, transparent 65%);
      bottom: -80px;
      left: -60px;
      pointer-events: none;
    }
    .profile-hero-inner {
      position: relative;
      z-index: 1;
      display: flex;
      align-items: center;
      gap: var(--sp-8);
      flex-wrap: wrap;
    }
    .profile-photo {
      width: 130px;
      height: 130px;
      border-radius: 50%;
      object-fit: cover;
      border: 4px solid var(--cyan);
      box-shadow: 0 0 0 8px rgba(15, 240, 252, 0.1), var(--shadow-cyan);
      flex-shrink: 0;
      background: var(--navy-mid);
      transition: box-shadow var(--ease-smooth);
    }
    .profile-photo:hover { box-shadow: 0 0 0 10px rgba(15, 240, 252, 0.15), var(--shadow-cyan); }
    .profile-hero-info { flex: 1; min-width: 200px; }
    .profile-hero-name {
      font-family: var(--font-display);
      font-size: 3rem;
      color: var(--white);
      line-height: 1;
      letter-spacing: 0.06em;
      margin-bottom: var(--sp-2);
    }
    .profile-hero-reg {
      font-size: 0.78rem;
      color: rgba(255, 255, 255, 0.55);
      letter-spacing: 0.12em;
      text-transform: uppercase;
      margin-bottom: var(--sp-4);
    }
    .profile-hero-reg strong { color: var(--cyan); font-weight: 600; }
    .profile-hero-badges {
      display: flex;
      align-items: center;
      gap: var(--sp-3);
      flex-wrap: wrap;
      margin-bottom: var(--sp-4);
    }
    /* Status badge */
    .profile-status-badge {
      display: inline-flex;
      align-items: center;
      gap: var(--sp-2);
      padding: 7px var(--sp-4);
      border-radius: var(--r-pill);
      font-family: var(--font-heading);
      font-size: 0.78rem;
      font-weight: 700;
      letter-spacing: 0.1em;
      text-transform: uppercase;
    }
    .profile-status--approved { background: var(--success-bg); border: 1.5px solid var(--success-bdr); color: var(--success); }
    .profile-status--pending  { background: var(--warning-bg); border: 1.5px solid var(--warning-bdr); color: var(--warning); }
    .profile-status--rejected { background: var(--error-bg);   border: 1.5px solid var(--error-bdr);   color: var(--error);   }
    /* Meta chips */
    .profile-hero-meta {
      display: flex;
      flex-wrap: wrap;
      gap: var(--sp-3);
    }
    .profile-meta-chip {
      display: inline-flex;
      align-items: center;
      gap: var(--sp-2);
      background: rgba(255, 255, 255, 0.07);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: var(--r-pill);
      padding: 6px var(--sp-4);
      font-size: 0.8rem;
      color: rgba(255, 255, 255, 0.72);
      transition: background var(--ease-fast);
    }
    .profile-meta-chip:hover { background: rgba(255, 255, 255, 0.12); }
    .profile-meta-chip i { color: var(--cyan); font-size: 0.85rem; }

    /* ── 2-column info grid ── */
    .profile-main-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: var(--sp-6);
      margin-bottom: var(--sp-6);
    }
    .profile-col { display: flex; flex-direction: column; gap: var(--sp-6); }

    /* ── Info card ── */
    .profile-card {
      background: var(--white);
      border-radius: var(--r-xl);
      border: 1px solid var(--gray-200);
      overflow: hidden;
      box-shadow: var(--shadow-sm);
      animation: cardEnter 0.5s cubic-bezier(0.0, 0.0, 0.2, 1) both;
    }
    .profile-card:nth-child(1) { animation-delay: 0.10s; }
    .profile-card:nth-child(2) { animation-delay: 0.15s; }
    .profile-card:nth-child(3) { animation-delay: 0.20s; }

    .profile-card-header {
      display: flex;
      align-items: center;
      gap: var(--sp-3);
      padding: var(--sp-4) var(--sp-5);
      background: linear-gradient(90deg, var(--navy-deep) 0%, var(--navy) 100%);
    }
    .profile-card-icon {
      width: 32px;
      height: 32px;
      background: rgba(15, 240, 252, 0.15);
      border-radius: var(--r-sm);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.88rem;
      color: var(--cyan);
      flex-shrink: 0;
    }
    .profile-card-title {
      font-family: var(--font-heading);
      font-size: 0.8rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.12em;
      color: var(--white);
    }

    /* Info rows */
    .profile-info-list { padding: var(--sp-1) 0; }
    .profile-info-row {
      display: grid;
      grid-template-columns: 38% 1fr;
      align-items: baseline;
      padding: 11px var(--sp-5);
      border-bottom: 1px solid var(--gray-100);
      gap: var(--sp-3);
      transition: background var(--ease-fast);
    }
    .profile-info-row:last-child { border-bottom: none; }
    .profile-info-row:hover { background: rgba(0, 0, 82, 0.02); }
    .info-label {
      font-size: 0.72rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.07em;
      color: var(--text-muted);
    }
    .info-value {
      font-size: 0.875rem;
      font-weight: 500;
      color: var(--text);
      word-break: break-word;
    }

    /* ── Documents grid ── */
    .doc-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
      gap: var(--sp-4);
      padding: var(--sp-6);
    }
    .doc-card {
      border-radius: var(--r-lg);
      border: 1.5px solid var(--gray-200);
      padding: var(--sp-5);
      display: flex;
      flex-direction: column;
      gap: var(--sp-3);
      background: var(--surface);
      transition: transform var(--ease-smooth), box-shadow var(--ease-smooth), border-color var(--ease-smooth);
    }
    .doc-card--uploaded {
      background: var(--white);
      cursor: default;
    }
    .doc-card--uploaded:hover {
      transform: translateY(-2px);
      box-shadow: var(--shadow-md);
      border-color: rgba(0, 0, 82, 0.2);
    }
    .doc-card--missing { opacity: 0.5; }
    .doc-card-icon {
      width: 40px;
      height: 40px;
      border-radius: var(--r-md);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.1rem;
    }
    .doc-card--uploaded .doc-card-icon { background: rgba(0, 0, 82, 0.07); color: var(--navy); }
    .doc-card--missing  .doc-card-icon { background: var(--gray-100);       color: var(--gray-400); }
    .doc-card-meta { flex: 1; }
    .doc-card-label {
      font-size: 0.82rem;
      font-weight: 600;
      color: var(--text);
      margin-bottom: 3px;
    }
    .doc-card-status {
      font-size: 0.68rem;
      font-weight: 700;
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }
    .doc-card--uploaded .doc-card-status { color: var(--success); }
    .doc-card--missing  .doc-card-status { color: var(--gray-400); }
    .doc-card-btn {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: var(--sp-2);
      padding: 9px var(--sp-4);
      border-radius: var(--r-sm);
      font-family: var(--font-body);
      font-size: 0.78rem;
      font-weight: 600;
      letter-spacing: 0.03em;
      text-decoration: none;
      border: none;
      cursor: pointer;
      transition: background var(--ease-fast), transform var(--ease-fast);
      width: 100%;
    }
    .doc-card-btn--view {
      background: var(--navy);
      color: var(--white);
    }
    .doc-card-btn--view:hover {
      background: var(--navy-mid);
      color: var(--white);
      text-decoration: none;
      transform: translateY(-1px);
    }
    .doc-card-btn--disabled {
      background: var(--gray-100);
      color: var(--gray-400);
      cursor: not-allowed;
    }
    .no-docs-state {
      padding: var(--sp-10) var(--sp-6);
      text-align: center;
      color: var(--text-muted);
      font-size: 0.9rem;
    }
    .no-docs-state i {
      display: block;
      font-size: 2.2rem;
      color: var(--warning);
      margin-bottom: var(--sp-3);
    }

    /* ── Status update ── */
    .status-update-body { padding: var(--sp-6); }
    .status-update-grid {
      display: grid;
      grid-template-columns: 1fr 240px;
      gap: var(--sp-4);
      align-items: center;
    }
    .status-select {
      width: 100%;
      height: 48px;
      padding: 0 var(--sp-10) 0 var(--sp-4);
      border: 1.5px solid var(--gray-200);
      border-radius: var(--r-md);
      font-family: var(--font-body);
      font-size: 0.9rem;
      font-weight: 500;
      color: var(--text);
      background-color: var(--white);
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' fill='%239a9baa' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right var(--sp-4) center;
      outline: none;
      appearance: none;
      -webkit-appearance: none;
      cursor: pointer;
      transition: border-color var(--ease-smooth), box-shadow var(--ease-smooth);
    }
    .status-select:focus {
      border-color: var(--navy);
      box-shadow: 0 0 0 3px rgba(0, 0, 82, 0.07);
    }
    .btn-update-status {
      height: 48px;
      padding: 0 var(--sp-6);
      width: 100%;
      border-radius: var(--r-md);
      background: var(--navy);
      color: var(--white);
      border: none;
      font-family: var(--font-heading);
      font-size: 0.88rem;
      font-weight: 700;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: var(--sp-2);
      transition: background var(--ease-smooth), transform var(--ease-smooth), box-shadow var(--ease-smooth);
      box-shadow: var(--shadow-navy);
    }
    .btn-update-status:hover {
      background: var(--navy-mid);
      transform: translateY(-1px);
      box-shadow: 0 8px 28px rgba(0, 0, 82, 0.35);
    }

    /* ── Full-width card ── */
    .profile-full-card { margin-bottom: var(--sp-6); }

    /* ── Responsive ── */
    @media (max-width: 1060px) {
      .profile-main-grid { grid-template-columns: 1fr; }
    }
    @media (max-width: 900px) {
      .status-update-grid { grid-template-columns: 1fr; }
    }
    @media (max-width: 600px) {
      .profile-hero { padding: var(--sp-6) var(--sp-5); }
      .profile-hero-name { font-size: 2.1rem; }
      .profile-photo { width: 90px; height: 90px; }
      .doc-grid { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 420px) {
      .doc-grid { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>

<?php $activePage = 'athlete-view'; ?>
<?php include '../layouts/sidebar.php'; ?>
<?php include '../layouts/navbar.php'; ?>

<div class="main-content">
  <div class="page-body">

    <!-- ── Page Header ── -->
    <div class="view-header">
      <div>
        <h1>Athlete Profile</h1>
        <p>Registration No &middot; <strong><?php echo htmlspecialchars($athlete['registration_no'] ?? '—'); ?></strong></p>
      </div>
      <div class="view-header-actions">
        <a href="../../athlete/download-pdf.php?application_no=<?php echo htmlspecialchars($athlete['registration_no']); ?>"
           target="_blank" class="btn-pdf">
          <i class="bi bi-file-earmark-pdf-fill"></i> Generate PDF
        </a>
        <a href="index.php" class="btn-back">
          <i class="bi bi-arrow-left"></i> Back
        </a>
      </div>
    </div>

    <!-- ── Profile Hero ── -->
    <div class="profile-hero">
      <div class="hero-glow-bl"></div>
      <div class="profile-hero-inner">
        <img src="<?php echo htmlspecialchars($profilePhoto); ?>" class="profile-photo" alt="Athlete Photo">
        <div class="profile-hero-info">
          <div class="profile-hero-name"><?php echo htmlspecialchars($athlete['full_name'] ?? ''); ?></div>
          <div class="profile-hero-reg">Application No : <strong><?php echo htmlspecialchars($athlete['registration_no'] ?? ''); ?></strong></div>
          <div class="profile-hero-badges">
            <span class="profile-status-badge <?php echo $statusBadgeClass; ?>">
              <i class="bi <?php echo $statusIcon; ?>"></i>
              <?php echo htmlspecialchars($status); ?>
            </span>
          </div>
          <div class="profile-hero-meta">
            <?php if (!empty($athlete['mobile'])): ?>
              <span class="profile-meta-chip"><i class="bi bi-phone-fill"></i><?php echo htmlspecialchars($athlete['mobile']); ?></span>
            <?php endif; ?>
            <?php if (!empty($athlete['gender'])): ?>
              <span class="profile-meta-chip"><i class="bi bi-person-fill"></i><?php echo htmlspecialchars($athlete['gender']); ?></span>
            <?php endif; ?>
            <?php if (!empty($athlete['blood_group'])): ?>
              <span class="profile-meta-chip"><i class="bi bi-droplet-fill"></i><?php echo htmlspecialchars($athlete['blood_group']); ?></span>
            <?php endif; ?>
            <?php if (!empty($athlete['age_group'])): ?>
              <span class="profile-meta-chip"><i class="bi bi-trophy-fill"></i><?php echo htmlspecialchars($athlete['age_group']); ?></span>
            <?php endif; ?>
            <?php if (!empty($athlete['club_name'])): ?>
              <span class="profile-meta-chip"><i class="bi bi-building-fill"></i><?php echo htmlspecialchars($athlete['club_name']); ?></span>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

    <!-- ── 2-Column Info Grid ── -->
    <div class="profile-main-grid">

      <!-- Left column -->
      <div class="profile-col">

        <!-- Personal Details -->
        <div class="profile-card">
          <div class="profile-card-header">
            <div class="profile-card-icon"><i class="bi bi-person-badge-fill"></i></div>
            <span class="profile-card-title">Personal Details</span>
          </div>
          <div class="profile-info-list">
            <div class="profile-info-row"><span class="info-label">Full Name</span><span class="info-value"><?php echo htmlspecialchars($athlete['full_name'] ?? '-'); ?></span></div>
            <div class="profile-info-row"><span class="info-label">Email</span><span class="info-value"><?php echo htmlspecialchars($athlete['email'] ?? '-'); ?></span></div>
            <div class="profile-info-row"><span class="info-label">Mobile</span><span class="info-value"><?php echo htmlspecialchars($athlete['mobile'] ?? '-'); ?></span></div>
            <div class="profile-info-row"><span class="info-label">Gender</span><span class="info-value"><?php echo htmlspecialchars($athlete['gender'] ?? '-'); ?></span></div>
            <div class="profile-info-row"><span class="info-label">Date of Birth</span><span class="info-value"><?php echo htmlspecialchars($athlete['dob'] ?? '-'); ?></span></div>
            <div class="profile-info-row"><span class="info-label">Age</span><span class="info-value"><?php echo htmlspecialchars($athlete['age'] ?? '-'); ?></span></div>
            <div class="profile-info-row"><span class="info-label">Blood Group</span><span class="info-value"><?php echo htmlspecialchars($athlete['blood_group'] ?? '-'); ?></span></div>
            <div class="profile-info-row"><span class="info-label">Aadhaar Number</span><span class="info-value"><?php echo htmlspecialchars($athlete['aadhaar_number'] ?? '-'); ?></span></div>
            <div class="profile-info-row"><span class="info-label">Registration No</span><span class="info-value"><?php echo htmlspecialchars($athlete['registration_no'] ?? '-'); ?></span></div>
          </div>
        </div>

        <!-- Guardian Details -->
        <div class="profile-card">
          <div class="profile-card-header">
            <div class="profile-card-icon"><i class="bi bi-people-fill"></i></div>
            <span class="profile-card-title">Guardian Details</span>
          </div>
          <div class="profile-info-list">
            <div class="profile-info-row"><span class="info-label">Father Name</span><span class="info-value"><?php echo htmlspecialchars($athlete['father_name'] ?? '-'); ?></span></div>
            <div class="profile-info-row"><span class="info-label">Mother Name</span><span class="info-value"><?php echo htmlspecialchars($athlete['mother_name'] ?? '-'); ?></span></div>
            <div class="profile-info-row"><span class="info-label">Guardian Name</span><span class="info-value"><?php echo htmlspecialchars($athlete['guardian_name'] ?? '-'); ?></span></div>
            <div class="profile-info-row"><span class="info-label">Guardian Mobile</span><span class="info-value"><?php echo htmlspecialchars($athlete['guardian_mobile'] ?? '-'); ?></span></div>
            <div class="profile-info-row"><span class="info-label">Emergency Contact</span><span class="info-value"><?php echo htmlspecialchars($athlete['emergency_contact'] ?? '-'); ?></span></div>
            <div class="profile-info-row"><span class="info-label">Relationship</span><span class="info-value"><?php echo htmlspecialchars($athlete['relation_with_athlete'] ?? '-'); ?></span></div>
            <div class="profile-info-row"><span class="info-label">Occupation</span><span class="info-value"><?php echo htmlspecialchars($athlete['guardian_occupation'] ?? '-'); ?></span></div>
          </div>
        </div>

      </div><!-- /left col -->

      <!-- Right column -->
      <div class="profile-col">

        <!-- Address Details -->
        <div class="profile-card">
          <div class="profile-card-header">
            <div class="profile-card-icon"><i class="bi bi-geo-alt-fill"></i></div>
            <span class="profile-card-title">Address Details</span>
          </div>
          <div class="profile-info-list">
            <div class="profile-info-row"><span class="info-label">Country</span><span class="info-value"><?php echo htmlspecialchars($athlete['country'] ?? '-'); ?></span></div>
            <div class="profile-info-row"><span class="info-label">State</span><span class="info-value"><?php echo htmlspecialchars($athlete['state'] ?? '-'); ?></span></div>
            <div class="profile-info-row"><span class="info-label">District</span><span class="info-value"><?php echo htmlspecialchars($athlete['district'] ?? '-'); ?></span></div>
            <div class="profile-info-row"><span class="info-label">City</span><span class="info-value"><?php echo htmlspecialchars($athlete['city'] ?? '-'); ?></span></div>
            <div class="profile-info-row"><span class="info-label">Pin Code</span><span class="info-value"><?php echo htmlspecialchars($athlete['pin_code'] ?? '-'); ?></span></div>
            <div class="profile-info-row"><span class="info-label">Address</span><span class="info-value"><?php echo htmlspecialchars($athlete['home_address'] ?? '-'); ?></span></div>
          </div>
        </div>

        <!-- Club Details -->
        <div class="profile-card">
          <div class="profile-card-header">
            <div class="profile-card-icon"><i class="bi bi-building-fill"></i></div>
            <span class="profile-card-title">Club Details</span>
          </div>
          <div class="profile-info-list">
            <div class="profile-info-row"><span class="info-label">Club Name</span><span class="info-value"><?php echo htmlspecialchars($athlete['club_name'] ?? '-'); ?></span></div>
            <div class="profile-info-row"><span class="info-label">Coach Name</span><span class="info-value"><?php echo htmlspecialchars($athlete['coach_name'] ?? '-'); ?></span></div>
            <div class="profile-info-row"><span class="info-label">Coach Mobile</span><span class="info-value"><?php echo htmlspecialchars($athlete['coach_mobile'] ?? '-'); ?></span></div>
            <div class="profile-info-row"><span class="info-label">State Association</span><span class="info-value"><?php echo htmlspecialchars($athlete['state_association'] ?? '-'); ?></span></div>
            <div class="profile-info-row"><span class="info-label">Experience</span><span class="info-value"><?php echo htmlspecialchars($athlete['experience'] ?? '-'); ?></span></div>
          </div>
        </div>

        <!-- Competition Details -->
        <div class="profile-card">
          <div class="profile-card-header">
            <div class="profile-card-icon"><i class="bi bi-trophy-fill"></i></div>
            <span class="profile-card-title">Competition Details</span>
          </div>
          <div class="profile-info-list">
            <div class="profile-info-row"><span class="info-label">Competition Name</span><span class="info-value"><?php echo htmlspecialchars($athlete['competition_name'] ?? '-'); ?></span></div>
            <div class="profile-info-row"><span class="info-label">Event Name</span><span class="info-value"><?php echo htmlspecialchars($athlete['event_name'] ?? '-'); ?></span></div>
            <div class="profile-info-row"><span class="info-label">Age Group</span><span class="info-value"><?php echo htmlspecialchars($athlete['age_group'] ?? '-'); ?></span></div>
            <div class="profile-info-row"><span class="info-label">Weight Category</span><span class="info-value"><?php echo htmlspecialchars($athlete['weight_category'] ?? '-'); ?></span></div>
            <div class="profile-info-row"><span class="info-label">Competition Level</span><span class="info-value"><?php echo htmlspecialchars($athlete['competition_level'] ?? '-'); ?></span></div>
            <div class="profile-info-row"><span class="info-label">Participation Year</span><span class="info-value"><?php echo htmlspecialchars($athlete['participation_year'] ?? '-'); ?></span></div>
          </div>
        </div>

      </div><!-- /right col -->

    </div><!-- /profile-main-grid -->

    <!-- ── Documents & Certificates ── -->
    <div class="profile-card profile-full-card">
      <div class="profile-card-header">
        <div class="profile-card-icon"><i class="bi bi-folder2-open"></i></div>
        <span class="profile-card-title">Documents &amp; Certificates</span>
      </div>

      <?php
        $hasDoc = false;
        foreach ($documents as $doc) { if (!empty($doc['file'])) { $hasDoc = true; break; } }
      ?>

      <?php if ($hasDoc): ?>
      <div class="doc-grid">
        <?php foreach ($documents as $doc): ?>
          <?php $uploaded = !empty($doc['file']); ?>
          <div class="doc-card <?php echo $uploaded ? 'doc-card--uploaded' : 'doc-card--missing'; ?>">
            <div class="doc-card-icon"><i class="bi <?php echo $doc['icon']; ?>"></i></div>
            <div class="doc-card-meta">
              <div class="doc-card-label"><?php echo htmlspecialchars($doc['label']); ?></div>
              <div class="doc-card-status"><?php echo $uploaded ? '✓ Uploaded' : 'Not uploaded'; ?></div>
            </div>
            <?php if ($uploaded): ?>
              <a href="../../athlete/assets/uploads/<?php echo htmlspecialchars($doc['folder'] . $doc['file']); ?>"
                 target="_blank" download
                 class="doc-card-btn doc-card-btn--view">
                <i class="bi bi-download"></i> Download
              </a>
            <?php else: ?>
              <button class="doc-card-btn doc-card-btn--disabled" disabled>
                <i class="bi bi-slash-circle"></i> Not Available
              </button>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
      <?php else: ?>
      <div class="no-docs-state">
        <i class="bi bi-exclamation-triangle-fill"></i>
        No documents have been uploaded for this athlete.
      </div>
      <?php endif; ?>
    </div>

    <!-- ── Update Status ── -->
    <div class="profile-card profile-full-card">
      <div class="profile-card-header">
        <div class="profile-card-icon"><i class="bi bi-pencil-square"></i></div>
        <span class="profile-card-title">Update Athlete Status</span>
      </div>
      <div class="status-update-body">
        <form action="update-status.php" method="POST">
          <input type="hidden" name="athlete_id" value="<?php echo $athlete['athlete_id']; ?>">
          <div class="status-update-grid">
            <select name="athlete_status" class="status-select">
              <option value="Pending"  <?php if ($status === 'Pending')  echo 'selected'; ?>>Pending</option>
              <option value="Approved" <?php if ($status === 'Approved') echo 'selected'; ?>>Approved</option>
              <option value="Rejected" <?php if ($status === 'Rejected') echo 'selected'; ?>>Rejected</option>
            </select>
            <button type="submit" name="update_status" class="btn-update-status">
              <i class="bi bi-check-circle-fill"></i> Update Status
            </button>
          </div>
        </form>
      </div>
    </div>

  </div><!-- /page-body -->
</div><!-- /main-content -->

<script src="../assets/js/admin-script.js"></script>
</body>
</html>