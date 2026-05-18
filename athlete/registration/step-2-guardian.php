<?php

include '../../config/session.php';

/*
=========================================
SAVE STEP 1 DATA
=========================================
*/

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $_SESSION['step1'] = $_POST;

    /*
    =========================================
    PHOTO VALIDATION
    =========================================
    */

    if(
        !isset($_POST['compressed_photo']) ||
        empty(trim($_POST['compressed_photo']))
    ){

        header(
            'Location: step-1-personal.php?error=photo'
        );

        exit();

    }

    /*
    =========================================
    SAVE PHOTO
    =========================================
    */

    $base64Raw =
    trim($_POST['compressed_photo']);

    $base64Data =
    preg_replace(
        '/^data:image\/\w+;base64,/',
        '',
        $base64Raw
    );

    $imageBytes =
    base64_decode($base64Data, true);

    if(
        $imageBytes === false
    ){

        header(
            'Location: step-1-personal.php?error=photo'
        );

        exit();

    }

    /*
    =========================================
    CREATE FILE
    =========================================
    */

    $photoName =
    time() .
    '_' .
    bin2hex(random_bytes(4)) .
    '.jpg';

    $savePath =
    __DIR__ .
    '/../assets/uploads/photos/' .
    $photoName;

    file_put_contents(
        $savePath,
        $imageBytes
    );

    $_SESSION['step1']['photo'] =
    $photoName;

    /*
    =========================================
    IMPORTANT FIX
    REDIRECT TO REMOVE POST
    =========================================
    */

    header(
        'Location: step-2-guardian.php'
    );

    exit();

}

/*
=========================================
BLOCK DIRECT ACCESS
=========================================
*/

if(!isset($_SESSION['step1'])){

    header(
        'Location: step-1-personal.php'
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
<title>Guardian Info</title>
<link rel="stylesheet" href="../../assets/css/athlete-style.css">
</head>
<body>

<div class="reg-root">

  <!-- ── Left Panel ── -->
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
        <h2>Family<br><em>Backing<br>Your<br>Dreams</em></h2>
        <p>Guardian information is required for athlete registration and emergency contact.</p>
      </div>
      <nav class="step-nav">
        <p class="step-nav-title">Registration Progress</p>
        <ul class="step-nav-list">
          <li class="step-nav-item is-done"><span class="step-dot">✓</span><span class="step-label">Personal Details</span></li>
          <li class="step-nav-item is-active"><span class="step-dot">2</span><span class="step-label">Guardian Info</span></li>
          <li class="step-nav-item"><span class="step-dot">3</span><span class="step-label">Address</span></li>
          <li class="step-nav-item"><span class="step-dot">4</span><span class="step-label">Club Details</span></li>
          <li class="step-nav-item"><span class="step-dot">5</span><span class="step-label">Competition</span></li>
          <li class="step-nav-item"><span class="step-dot">6</span><span class="step-label">Documents</span></li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- ── Mobile Bar ── -->
  <header class="reg-mobile-bar">
    <div class="reg-mobile-top">
      <div class="mobile-brand">
        <div class="mobile-logo">SCM</div>
        <span class="mobile-brand-name">Sports Club</span>
      </div>
      <span class="mobile-step-info">Step 2 of 6</span>
    </div>
    <div class="step-pips">
      <div class="step-pip-wrap is-done"><div class="step-pip">✓</div><span class="step-pip-txt">Personal</span></div>
      <div class="step-pip-wrap is-active"><div class="step-pip">2</div><span class="step-pip-txt">Guardian</span></div>
      <div class="step-pip-wrap"><div class="step-pip">3</div><span class="step-pip-txt">Address</span></div>
      <div class="step-pip-wrap"><div class="step-pip">4</div><span class="step-pip-txt">Club</span></div>
      <div class="step-pip-wrap"><div class="step-pip">5</div><span class="step-pip-txt">Sport</span></div>
      <div class="step-pip-wrap"><div class="step-pip">6</div><span class="step-pip-txt">Docs</span></div>
    </div>
  </header>

  <!-- ── Form Panel ── -->
  <main class="reg-form-panel">
    <div class="reg-form-inner">

      <span class="step-badge">Step 02 &nbsp;/&nbsp; 06</span>
      <h1 class="form-title">Guardian Information</h1>
      <p class="form-subtitle">Provide your parents or guardian's details for official records.</p>
      <h3 class="form-title-h3">Important Notes</h3>
      <p class="form-subtitle">
        If biological parent information is unavailable, athlete may provide caretaker or guardian information instead.
      </p>


      <form action="step-3-address.php" method="POST" autocomplete="off">

        <div class="grid-2">

          <!-- FATHER NAME -->

          <div class="fg anim-fade-up delay-100">
            <label for="father_name">

              Father's Name

              <span class="field-optional">
                (Optional)
              </span>

            </label>

            <input
              type="text"
              name="father_name"
              id="father_name"
              class="sc-input"
              placeholder="Enter father's full name or Not Available">
          </div>

          <!-- MOTHER NAME -->

          <div class="fg anim-fade-up delay-150">
            <label for="mother_name">

              Mother's Name

              <span class="field-optional">
                (Optional)
              </span>

            </label>

            <input
              type="text"
              name="mother_name"
              id="mother_name"
              class="sc-input"
              placeholder="Enter mother's full name or Not Available">
          </div>

          <!-- GUARDIAN NAME -->

          <div class="fg anim-fade-up delay-200">
            <label for="guardian_name">

              Guardian / Caretaker Name

            </label>

            <input
              type="text"
              name="guardian_name"
              id="guardian_name"
              class="sc-input"
              placeholder="Enter guardian full name"
              required>
          </div>

          <!-- RELATIONSHIP -->

          <div class="fg anim-fade-up delay-250">
            <label for="relationship">

              Relationship With Athlete

            </label>

            <div class="sel-wrap">

              <select
                name="relationship"
                id="relationship"
                class="sc-select"
                required>

                <option value="">
                  Select Relationship
                </option>

                <option value="Father">
                  Father
                </option>

                <option value="Mother">
                  Mother
                </option>

                <option value="Brother">
                  Brother
                </option>

                <option value="Sister">
                  Sister
                </option>

                <option value="Uncle">
                  Uncle
                </option>

                <option value="Aunt">
                  Aunt
                </option>

                <option value="Coach">
                  Coach
                </option>

                <option value="Caretaker">
                  Caretaker
                </option>

                <option value="Other">
                  Other
                </option>

              </select>

            </div>
          </div>

          <!-- GUARDIAN MOBILE -->

          <div class="fg anim-fade-up delay-300">
            <label for="guardian_mobile">

              Guardian Mobile Number

            </label>

            <input
              type="text"
              name="guardian_mobile"
              id="guardian_mobile"
              class="sc-input"
              placeholder="Enter 10-digit mobile number"
              maxlength="10"
              required>

            <span class="invalid-feedback">
              Enter valid 10-digit number
            </span>
          </div>

          <!-- EMERGENCY CONTACT -->

          <div class="fg anim-fade-up delay-350">
            <label for="emergency_contact">

              Emergency Contact Number

            </label>

            <input
              type="text"
              name="emergency_contact"
              id="emergency_contact"
              class="sc-input"
              placeholder="Enter emergency contact number"
              maxlength="10"
              required>

            <span class="invalid-feedback">
              Enter valid emergency number
            </span>
          </div>

          <!-- GUARDIAN EMAIL -->

          <div class="fg anim-fade-up delay-400">
            <label for="guardian_email">

              Guardian Email Address

              <span class="field-optional">
                (Optional)
              </span>

            </label>

            <input
              type="email"
              name="guardian_email"
              id="guardian_email"
              class="sc-input"
              placeholder="Enter guardian email address">
          </div>

          <!-- NOTE -->

          

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
<!-- hrllo -->

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
