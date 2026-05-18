<?php

include '../../config/session.php';

/*
=========================================
SAVE STEP 3
=========================================
*/

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $_SESSION['step3'] = $_POST;

    /*
    =========================================
    REDIRECT TO REMOVE POST REQUEST
    =========================================
    */

    header(
        'Location: step-4-club.php'
    );

    exit();

}

/*
=========================================
BLOCK DIRECT ACCESS
=========================================
*/

if(!isset($_SESSION['step3'])){

    header(
        'Location: step-3-address.php'
    );

    exit();

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/svg+xml" href="../../assets/images/logo.svg">
<title>Club Details</title>
<link rel="stylesheet" href="../../assets/css/athlete-style.css">
</head>
<body>

<div class="reg-root">

  <aside class="reg-panel">
    <div class="reg-panel-inner">
      <div class="panel-brand"> 
        <a href="register.php" class="panel-logo">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L8 6H4V10C4 14.4 7.4 18.2 12 19C16.6 18.2 20 14.4 20 10V6H16L12 2Z" fill="#000052"/>
                <path d="M8 6H4V10C4 12.5 5.4 14.8 7.5 16.3L8 6Z" fill="rgba(0,0,82,0.35)"/>
                <path d="M10 21H14V23H10V21Z" fill="#000052"/>
                <path d="M8 23H16V24H8V23Z" fill="#000052"/>
            </svg>
        </a> 
        <div class="panel-brand-text">Sports Club <span>Management System</span></div>
      </div>
      <div class="panel-headline">
        <div class="panel-accent-line"></div>
        <h2>Your<br><em>Club.<br>Your<br>Coach.</em></h2>
        <p>Club and coach details verify your official affiliation with the association.</p>
      </div>
      <nav class="step-nav">
        <p class="step-nav-title">Registration Progress</p>
        <ul class="step-nav-list">
          <li class="step-nav-item is-done"><span class="step-dot">&#10003;</span><span class="step-label">Personal Details</span></li>
          <li class="step-nav-item is-done"><span class="step-dot">&#10003;</span><span class="step-label">Guardian Info</span></li>
          <li class="step-nav-item is-done"><span class="step-dot">&#10003;</span><span class="step-label">Address</span></li>
          <li class="step-nav-item is-active"><span class="step-dot">4</span><span class="step-label">Club Details</span></li>
          <li class="step-nav-item"><span class="step-dot">5</span><span class="step-label">Competition</span></li>
          <li class="step-nav-item"><span class="step-dot">6</span><span class="step-label">Documents</span></li>
        </ul>
      </nav>
    </div>
  </aside>

  <header class="reg-mobile-bar">
    <div class="reg-mobile-top">
      <div class="mobile-brand">
        <div class="mobile-logo">SCM</div>
        <span class="mobile-brand-name">Sports Club</span>
      </div>
      <span class="mobile-step-info">Step 4 of 6</span>
    </div>
    <div class="step-pips">
      <div class="step-pip-wrap is-done"><div class="step-pip">&#10003;</div><span class="step-pip-txt">Personal</span></div>
      <div class="step-pip-wrap is-done"><div class="step-pip">&#10003;</div><span class="step-pip-txt">Guardian</span></div>
      <div class="step-pip-wrap is-done"><div class="step-pip">&#10003;</div><span class="step-pip-txt">Address</span></div>
      <div class="step-pip-wrap is-active"><div class="step-pip">4</div><span class="step-pip-txt">Club</span></div>
      <div class="step-pip-wrap"><div class="step-pip">5</div><span class="step-pip-txt">Sport</span></div>
      <div class="step-pip-wrap"><div class="step-pip">6</div><span class="step-pip-txt">Docs</span></div>
    </div>
  </header>

  <main class="reg-form-panel">
    <div class="reg-form-inner">

      <span class="step-badge">Step 04 &nbsp;/&nbsp; 06</span>
      <h1 class="form-title">Club &amp; Coach Details</h1>
      <p class="form-subtitle">Provide your club affiliation and coaching staff information.</p>
      <h3 class="form-title-h3">Important Notes</h3>
      <p class="form-subtitle">
        Club and coach information will be used for official athlete verification and tournament approvals.
      </p>
      <form action="step-5-competition.php" method="POST" autocomplete="off">

        <div class="grid-2">

            <!-- CLUB NAME -->

            <div class="fg anim-fade-up delay-100">

              <label for="club_name">

                Club / Academy Name

              </label>

              <input
                type="text"
                name="club_name"
                id="club_name"
                class="sc-input"
                placeholder="Enter official sports club or academy name"
                required>

            </div>

            <!-- CLUB REGISTRATION -->

            <div class="fg anim-fade-up delay-120">

              <label for="club_registration_no">

                Club Registration Number

                <span class="field-optional">
                  (Optional)
                </span>

              </label>

              <input
                type="text"
                name="club_registration_no"
                id="club_registration_no"
                class="sc-input"
                placeholder="Official club registration number">

            </div>

            <!-- COACH NAME -->

            <div class="fg anim-fade-up delay-150">

              <label for="coach_name">

                Head Coach Name

              </label>

              <input
                type="text"
                name="coach_name"
                id="coach_name"
                class="sc-input"
                placeholder="Enter head coach full name"
                required>

            </div>

            <!-- COACH MOBILE -->

            <div class="fg anim-fade-up delay-180">

              <label for="coach_mobile">

                Coach Mobile Number

              </label>

              <input
                type="text"
                name="coach_mobile"
                id="coach_mobile"
                class="sc-input"
                placeholder="Enter 10-digit mobile number"
                maxlength="10"
                required>

              <span class="invalid-feedback">

                Enter a valid 10-digit mobile number

              </span>

            </div>

            <!-- COACH EMAIL -->

            <div class="fg anim-fade-up delay-200">

              <label for="coach_email">

                Coach Email Address

                <span class="field-optional">
                  (Optional)
                </span>

              </label>

              <input
                type="email"
                name="coach_email"
                id="coach_email"
                class="sc-input"
                placeholder="Enter coach email address">

            </div>

            <!-- EXPERIENCE -->

            <div class="fg anim-fade-up delay-220">

              <label for="experience_years">

                Playing Experience

              </label>

              <div class="sel-wrap">

                <select
                  name="experience_years"
                  id="experience_years"
                  class="sc-select"
                  required>

                  <option value="">
                    Select Experience
                  </option>

                  <option value="Beginner">
                    Beginner
                  </option>

                  <option value="1 Year">
                    1 Year
                  </option>

                  <option value="2 Years">
                    2 Years
                  </option>

                  <option value="3 Years">
                    3 Years
                  </option>

                  <option value="5+ Years">
                    5+ Years
                  </option>

                  <option value="10+ Years">
                    10+ Years
                  </option>

                </select>

              </div>

            </div>

            <!-- STATE ASSOCIATION -->

            <div class="fg anim-fade-up delay-250">

              <label for="state_association">

                State Sports Association

              </label>

              <input
                type="text"
                name="state_association"
                id="state_association"
                class="sc-input"
                placeholder="Enter affiliated state sports association"
                required>

            </div>

            <!-- ASSOCIATION ID -->

            <div class="fg anim-fade-up delay-270">

              <label for="association_id">

                Association ID / Affiliation Number

                <span class="field-optional">
                  (Optional)
                </span>

              </label>

              <input
                type="text"
                name="association_id"
                id="association_id"
                class="sc-input"
                placeholder="Association ID or affiliation number">

            </div>

            <!-- TRAINING ADDRESS -->

            <div class="fg full-width anim-fade-up delay-300">

              <label for="training_address">

                Training Center Address

                <span class="field-optional">
                  (Optional)
                </span>

              </label>

              <textarea
                name="training_address"
                id="training_address"
                class="sc-input"
                rows="3"
                placeholder="Enter training center or academy address"
                style="resize:vertical; min-height:100px;"></textarea>

            </div>

            <!-- NOTE -->

            <div class="fg full-width anim-fade-up delay-350">

              

            </div>

          </div>

        <div class="form-nav">
          <button type="button" onclick="window.history.back()" class="btn-ghost"> Previous </button>
          <button type="submit" class="btn-navy">Next Step &nbsp;&rarr;</button>
        </div>

      </form>

    </div>

    <footer class="sc-footer">
      &copy; <?php echo date('Y'); ?> Sports Club Management &nbsp;&middot;&nbsp;
      <a href="../status-check.php">Check Status</a>
    </footer>

  </main>

</div>

<script src="../../assets/js/athlete-script.js"></script>
<script src="../../assets/js/registration-reset.js"></script>
<script src="../../assets/js/multi-step-storage.js"></script>
<script>

/*
==================================================
PREVENT FORM CACHE ISSUES
==================================================
*/

window.addEventListener(
'pageshow',

function(event){

if(
event.persisted
){

window.location.reload();

}

}
);

</script>
</body>
</html>
