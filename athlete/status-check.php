<?php

include '../config/database.php';

$status = '';
$data = [];

if(isset($_POST['check_status'])){
  $application_no = mysqli_real_escape_string($conn, $_POST['application_no']);
  $query = mysqli_query($conn, "SELECT * FROM athletes WHERE registration_no='$application_no'");

  if(mysqli_num_rows($query) > 0){
    $data = mysqli_fetch_assoc($query);
    $status = "FOUND";
  } else {
    $status = "NOT_FOUND";
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Athlete Status Check &mdash; Sports Club Management</title>
<link rel="stylesheet" href="../assets/css/athlete-style.css">
<style>
/* ── Page-level overrides for the new full-bleed hero+search design ── */

.sc-page {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  background: var(--clr-offwhite);
}

/* ── Full-bleed hero that swallows the search form ── */
.sc-hero {
  background: var(--clr-navy);
  position: relative;
  overflow: hidden;
  padding: clamp(56px, 10vw, 96px) 20px clamp(60px, 9vw, 90px);
}
.sc-hero::before {
  content: "";
  position: absolute; inset: 0;
  background:
    radial-gradient(ellipse 120% 90% at 50% -10%, rgba(15,240,252,0.18) 0%, transparent 60%),
    radial-gradient(circle 500px at 90% 110%, rgba(15,240,252,0.07), transparent);
  pointer-events: none;
}
.sc-hero::after {
  content: "";
  position: absolute; inset: 0;
  background-image:
    repeating-linear-gradient(0deg, transparent, transparent 47px, rgba(255,255,255,0.025) 47px, rgba(255,255,255,0.025) 48px),
    repeating-linear-gradient(90deg, transparent, transparent 47px, rgba(255,255,255,0.025) 47px, rgba(255,255,255,0.025) 48px);
  pointer-events: none;
}

.sc-hero-inner {
  position: relative; z-index: 1;
  max-width: 680px; margin: 0 auto; text-align: center;
}

.sc-hero-eyebrow {
  display: inline-flex; align-items: center; gap: 10px;
  font-family: "Rajdhani", sans-serif; font-weight: 700;
  font-size: 0.7rem; letter-spacing: 0.18em; text-transform: uppercase;
  color: var(--clr-cyan); margin-bottom: 16px;
}
.sc-hero-eyebrow::before,
.sc-hero-eyebrow::after {
  content: ""; height: 1px; width: 32px;
  background: var(--clr-cyan); opacity: 0.5;
}

.sc-hero-title {
  font-family: "Barlow Condensed", sans-serif; font-weight: 900;
  font-size: clamp(3rem, 8vw, 5.5rem);
  color: var(--clr-white); text-transform: uppercase;
  line-height: 0.88; letter-spacing: -0.01em;
  margin-bottom: 16px;
}
.sc-hero-title span { color: var(--clr-cyan); }

.sc-hero-sub {
  font-family: "Inter", sans-serif; font-size: 1rem;
  color: rgba(255,255,255,0.5); margin-bottom: 36px; line-height: 1.6;
}

/* Search form inside hero */
.sc-search-form {
  display: flex; gap: 10px;
  background: rgba(255,255,255,0.08);
  border: 1px solid rgba(255,255,255,0.15);
  backdrop-filter: blur(12px);
  border-radius: 16px;
  padding: 8px 8px 8px 20px;
  animation: scm-fadeUp 0.5s ease both 0.2s;
}
@media (max-width: 540px) {
  .sc-search-form { flex-direction: column; padding: 12px; }
}

.sc-search-form input[type="text"] {
  flex: 1;
  background: transparent;
  border: none;
  outline: none;
  color: #fff;
  font-family: "Inter", sans-serif;
  font-size: 1rem;
  font-weight: 500;
  letter-spacing: 0.02em;
  padding: 10px 0;
}
.sc-search-form input[type="text"]::placeholder {
  color: rgba(255,255,255,0.35);
  font-weight: 400;
}
.sc-search-form input[type="text"]:focus {
  outline: none;
}

.sc-search-btn {
  background: var(--clr-cyan);
  color: var(--clr-navy);
  border: none;
  border-radius: 10px;
  font-family: "Barlow Condensed", sans-serif;
  font-weight: 800;
  font-size: 0.95rem;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  padding: 14px 28px;
  cursor: pointer;
  transition: transform 0.15s ease, box-shadow 0.15s ease, background 0.15s ease;
  white-space: nowrap;
  display: inline-flex; align-items: center; gap: 8px;
}
.sc-search-btn:hover {
  transform: translateY(-1px);
  box-shadow: 0 4px 20px rgba(15,240,252,0.45);
}
.sc-search-btn svg { width: 14px; height: 14px; }

/* ── Wave divider ── */
.sc-wave {
  display: block; margin-top: -2px;
  background: var(--clr-navy);
  line-height: 0;
}
.sc-wave svg { display: block; width: 100%; }

/* ── Results area ── */
.sc-results {
  flex: 1;
  max-width: 860px; margin: 0 auto;
  padding: 40px 20px 60px;
  width: 100%;
}

/* ── Athlete result card ── */
.sc-athlete-card {
  background: var(--clr-white);
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 4px 32px rgba(0,0,82,0.10);
  animation: scm-fadeUp 0.45s ease both;
}

.sc-card-banner {
  height: 130px;
  background: linear-gradient(135deg, var(--clr-navy) 0%, #00006a 55%, #000090 100%);
  position: relative; overflow: hidden;
}
.sc-card-banner::before {
  content: "";
  position: absolute; inset: 0;
  background:
    radial-gradient(circle 260px at 85% 50%, rgba(15,240,252,0.14), transparent),
    repeating-linear-gradient(45deg, transparent, transparent 28px,
      rgba(255,255,255,0.022) 28px, rgba(255,255,255,0.022) 29px);
}
.sc-card-banner-text {
  position: absolute; bottom: 20px; left: 168px;
  font-family: "Barlow Condensed", sans-serif; font-weight: 900;
  font-size: 3.5rem; color: rgba(255,255,255,0.04); text-transform: uppercase;
  letter-spacing: -0.02em; line-height: 1; user-select: none;
}
@media (max-width: 639px) { .sc-card-banner-text { left: 130px; font-size: 2.5rem; } }

.sc-card-top {
  padding: 0 32px 28px;
  display: flex; align-items: flex-end; gap: 20px;
  margin-top: -56px; position: relative;
}
@media (max-width: 639px) {
  .sc-card-top { flex-direction: column; align-items: center; text-align: center; margin-top: -52px; padding: 0 20px 24px; }
}

.sc-card-avatar {
  width: 112px; height: 112px;
  border-radius: 50%; object-fit: cover;
  border: 4px solid var(--clr-white);
  box-shadow: 0 4px 16px rgba(0,0,82,0.18);
  flex-shrink: 0;
  background: var(--clr-gray-100);
}

.sc-card-identity { flex: 1; padding-bottom: 4px; }
.sc-card-name {
  font-family: "Barlow Condensed", sans-serif; font-weight: 900;
  font-size: clamp(1.6rem, 4vw, 2.2rem); color: var(--clr-navy);
  text-transform: uppercase; line-height: 1; margin-bottom: 6px;
}
.sc-card-reg {
  font-family: "Rajdhani", sans-serif; font-weight: 700;
  font-size: 0.72rem; letter-spacing: 0.14em; text-transform: uppercase;
  color: #555; margin-bottom: 10px;
}
.sc-card-badge-row { display: flex; gap: 8px; flex-wrap: wrap; }
@media (max-width: 639px) { .sc-card-badge-row { justify-content: center; } }

/* ── Info grid ── */
.sc-info-grid {
  display: grid; grid-template-columns: repeat(3, 1fr);
  border-top: 1px solid var(--clr-gray-100);
}
@media (max-width: 767px) { .sc-info-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 479px) { .sc-info-grid { grid-template-columns: 1fr; } }

.sc-info-cell {
  padding: 18px 24px;
  border-right: 1px solid var(--clr-gray-100);
  border-bottom: 1px solid var(--clr-gray-100);
}
.sc-info-cell:nth-child(3n) { border-right: none; }
@media (max-width: 767px) { .sc-info-cell:nth-child(2n) { border-right: none; } .sc-info-cell:nth-child(3n) { border-right: 1px solid var(--clr-gray-100); } }
@media (max-width: 479px) { .sc-info-cell { border-right: none; } }

.sc-info-label {
  font-family: "Rajdhani", sans-serif; font-weight: 700;
  font-size: 0.68rem; letter-spacing: 0.12em; text-transform: uppercase;
  color: var(--clr-gray-400); margin-bottom: 4px;
}
.sc-info-value {
  font-family: "Inter", sans-serif; font-weight: 600;
  font-size: 0.95rem; color: var(--clr-text);
}

/* ── Card footer ── */
.sc-card-footer {
  padding: 20px 32px;
  background: #f8f9fc;
  border-top: 1px solid var(--clr-gray-100);
  display: flex; align-items: center; justify-content: space-between;
  gap: 12px; flex-wrap: wrap;
}
@media (max-width: 639px) { .sc-card-footer { flex-direction: column; align-items: stretch; } }

.sc-card-footer-text { }
.sc-card-footer-title {
  font-family: "Barlow Condensed", sans-serif; font-weight: 800;
  font-size: 1rem; text-transform: uppercase; color: var(--clr-navy);
  letter-spacing: 0.04em;
}
.sc-card-footer-sub {
  font-family: "Inter", sans-serif; font-size: 0.78rem;
  color: var(--clr-gray-400); margin-top: 2px;
}

/* ── Not-found state ── */
.sc-not-found {
  text-align: center; padding: 64px 20px;
  animation: scm-fadeUp 0.4s ease both;
}
.sc-not-found-icon {
  width: 72px; height: 72px; border-radius: 50%;
  background: #fff; box-shadow: 0 4px 20px rgba(0,0,82,0.08);
  display: flex; align-items: center; justify-content: center;
  font-size: 2rem; margin: 0 auto 20px;
}
.sc-not-found-title {
  font-family: "Barlow Condensed", sans-serif; font-weight: 900;
  font-size: 2rem; color: var(--clr-navy); text-transform: uppercase;
  letter-spacing: 0.02em; margin-bottom: 10px;
}
.sc-not-found-sub {
  font-family: "Inter", sans-serif; font-size: 0.95rem;
  color: var(--clr-graphite); line-height: 1.65;
  max-width: 420px; margin: 0 auto 28px;
}
</style>
</head>
<body>

<div class="sc-page">

  <!-- ════════ HERO + SEARCH ════════ -->
  <div class="sc-hero">
    <div class="sc-hero-inner">

      <div class="sc-hero-eyebrow">Sports Club Management System</div>

      <h1 class="sc-hero-title">
        Track Your<br><span>Application</span>
      </h1>

      <p class="sc-hero-sub">
        Enter your application number below to instantly check<br>your registration status.
      </p>

      <!-- Search form lives inside the hero -->
      <form method="POST" class="sc-search-form">
        <input
          type="text"
          name="application_no"
          placeholder="Enter your Application Number&hellip;"
          value="<?php echo isset($_POST['application_no']) ? htmlspecialchars($_POST['application_no']) : ''; ?>"
          autocomplete="off"
          required
        >
        <button type="submit" name="check_status" class="sc-search-btn">
          <svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="7" cy="7" r="5" stroke="currentColor" stroke-width="1.8"/>
            <path d="M11 11l3 3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
          </svg>
          Search
        </button>
      </form>

    </div>
  </div>

  <!-- Wave transition -->
  <div class="sc-wave">
    <svg viewBox="0 0 1440 48" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" height="48">
      <path d="M0,0 C360,48 1080,48 1440,0 L1440,0 L0,0 Z" fill="#000052"/>
    </svg>
  </div>

  <!-- ════════ RESULTS ════════ -->
  <div class="sc-results">

  <?php if($status === "FOUND"): ?>

  <?php
    $currentStatus = $data['athlete_status'];
    $statusClass = "pending";
    if($currentStatus === "Approved") $statusClass = "approved";
    if($currentStatus === "Rejected") $statusClass = "rejected";
  ?>

  <div class="sc-athlete-card">

    <!-- Banner -->
    <div class="sc-card-banner">
      <span class="sc-card-banner-text"><?php echo htmlspecialchars($data['full_name']); ?></span>
    </div>

    <!-- Header: avatar + name + status -->
    <div class="sc-card-top">
      <img
        class="sc-card-avatar"
        src="assets/uploads/photos/<?php echo htmlspecialchars($data['profile_photo']); ?>"
        alt="<?php echo htmlspecialchars($data['full_name']); ?>"
      >
      <div class="sc-card-identity">
        <div class="sc-card-name"><?php echo htmlspecialchars($data['full_name']); ?></div>
        <div class="sc-card-reg"># <?php echo htmlspecialchars($data['registration_no']); ?></div>
        <div class="sc-card-badge-row">
          <span class="status-badge <?php echo $statusClass; ?>">
            <?php echo htmlspecialchars($currentStatus); ?>
          </span>
          <?php if(!empty($data['gender'])): ?>
          <span class="status-badge" style="background:#f0f4ff;border-color:#c8d4f0;color:#34507a;">
            <?php echo htmlspecialchars($data['gender']); ?>
          </span>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <!-- Info grid -->
    <div class="sc-info-grid">
      <div class="sc-info-cell">
        <div class="sc-info-label">Date of Birth</div>
        <div class="sc-info-value"><?php echo htmlspecialchars($data['dob']); ?></div>
      </div>
      <div class="sc-info-cell">
        <div class="sc-info-label">Age</div>
        <div class="sc-info-value"><?php echo htmlspecialchars($data['age']); ?> years</div>
      </div>
      <div class="sc-info-cell">
        <div class="sc-info-label">Blood Group</div>
        <div class="sc-info-value"><?php echo htmlspecialchars($data['blood_group']); ?></div>
      </div>
      <div class="sc-info-cell">
        <div class="sc-info-label">Mobile</div>
        <div class="sc-info-value"><?php echo htmlspecialchars($data['mobile']); ?></div>
      </div>
      <div class="sc-info-cell">
        <div class="sc-info-label">Email</div>
        <div class="sc-info-value" style="word-break:break-all;"><?php echo htmlspecialchars($data['email']); ?></div>
      </div>
      <div class="sc-info-cell">
        <div class="sc-info-label">Application No.</div>
        <div class="sc-info-value" style="font-family:'Rajdhani',sans-serif;font-weight:700;letter-spacing:0.04em;"><?php echo htmlspecialchars($data['registration_no']); ?></div>
      </div>
    </div>

    <!-- Card footer: download action -->
    <div class="sc-card-footer">
      <div class="sc-card-footer-text">
        <div class="sc-card-footer-title">Registration Document</div>
        <div class="sc-card-footer-sub">Download your official athlete registration PDF</div>
      </div>
      <a
        href="download-pdf.php?application_no=<?php echo urlencode($data['registration_no']); ?>"
        class="btn-navy"
        style="display:inline-flex;align-items:center;gap:8px;padding:12px 24px;"
      >
        <svg width="14" height="14" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M8 2v8M8 10l-3-3M8 10l3-3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M2 14h12" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
        </svg>
        Download PDF
      </a>
    </div>

  </div>

  <?php elseif($status === "NOT_FOUND"): ?>

  <div class="sc-not-found">
    <div class="sc-not-found-icon">&#128270;</div>
    <div class="sc-not-found-title">No Record Found</div>
    <p class="sc-not-found-sub">
      We couldn&apos;t find any registration matching
      <strong>&ldquo;<?php echo htmlspecialchars($_POST['application_no']); ?>&rdquo;</strong>.
      Please double-check the number and try again.
    </p>
    <a href="registration/register.php" class="btn-navy" style="display:inline-flex;align-items:center;gap:8px;">
      Start New Registration &rarr;
    </a>
  </div>

  <?php endif; ?>

  </div><!-- /sc-results -->

  <!-- Footer -->
  <footer class="sc-footer">
    &copy; <?php echo date('Y'); ?> Sports Club Management System &nbsp;&middot;&nbsp;
    <a href="registration/register.php">Register</a>
  </footer>

</div>

</body>
</html>
