<?php

include '../../config/session.php';

/*
=========================================
SAVE STEP 2 DATA
=========================================
*/

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $_SESSION['step2'] = $_POST;

    /*
    =========================================
    REMOVE POST REQUEST FROM HISTORY
    =========================================
    */

    header(
        'Location: step-3-address.php'
    );

    exit();

}

/*
=========================================
BLOCK DIRECT ACCESS
=========================================
*/

if(!isset($_SESSION['step2'])){

    header(
        'Location: step-2-guardian.php'
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
<title>Address Details</title>
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
        <h2>Where<br><em>Champions<br>Come<br>From</em></h2>
        <p>Your address helps us assign you to the correct regional competition circuit.</p>
      </div>
      <nav class="step-nav">
        <p class="step-nav-title">Registration Progress</p>
        <ul class="step-nav-list">
          <li class="step-nav-item is-done"><span class="step-dot">&#10003;</span><span class="step-label">Personal Details</span></li>
          <li class="step-nav-item is-done"><span class="step-dot">&#10003;</span><span class="step-label">Guardian Info</span></li>
          <li class="step-nav-item is-active"><span class="step-dot">3</span><span class="step-label">Address</span></li>
          <li class="step-nav-item"><span class="step-dot">4</span><span class="step-label">Club Details</span></li>
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
      <span class="mobile-step-info">Step 3 of 6</span>
    </div>
    <div class="step-pips">
      <div class="step-pip-wrap is-done"><div class="step-pip">&#10003;</div><span class="step-pip-txt">Personal</span></div>
      <div class="step-pip-wrap is-done"><div class="step-pip">&#10003;</div><span class="step-pip-txt">Guardian</span></div>
      <div class="step-pip-wrap is-active"><div class="step-pip">3</div><span class="step-pip-txt">Address</span></div>
      <div class="step-pip-wrap"><div class="step-pip">4</div><span class="step-pip-txt">Club</span></div>
      <div class="step-pip-wrap"><div class="step-pip">5</div><span class="step-pip-txt">Sport</span></div>
      <div class="step-pip-wrap"><div class="step-pip">6</div><span class="step-pip-txt">Docs</span></div>
    </div>
  </header>

  <main class="reg-form-panel">
    <div class="reg-form-inner">

      <span class="step-badge">Step 03 &nbsp;/&nbsp; 06</span>
      <h1 class="form-title">Address Details</h1>
      <p class="form-subtitle">Enter your residential address for your athlete profile.</p>

      <form action="step-4-club.php" method="POST" autocomplete="off">

        <div class="grid-2">

          <div class="fg anim-fade-up delay-50">

            <label for="country">

              Country

            </label>

            <div class="sel-wrap">

              <select
                name="country"
                id="country"
                class="sc-select"
                readonly>

                <option value="India">
                  India
                </option>

              </select>

            </div>

          </div>

          <div class="fg anim-fade-up delay-100">
            <label for="state">State</label>
            <div class="sel-wrap">
              <select name="state" id="state" class="sc-select" required>
                <option value="">Select State</option>
              </select>
            </div>
          </div>

          <div class="fg anim-fade-up delay-150">
            <label for="district">District</label>
            <div class="sel-wrap">
              <select name="district" id="district" class="sc-select" required>
                <option value="">Select District</option>
              </select>
            </div>
          </div>

          <div class="fg anim-fade-up delay-200">
            <label for="city">City / Town</label>
            <div class="sel-wrap">
              <select name="city" id="city" class="sc-select" required>
                <option value="">Select City</option>
              </select>
            </div>
          </div>

          <div class="fg anim-fade-up delay-250">
            <label for="pin_code">PIN Code</label>
            <input type="text" name="pin_code" id="pin_code" class="sc-input" placeholder="6-digit PIN code" maxlength="6" required>
          </div>

          <div class="fg anim-fade-up delay-300">
            <label for="village">Village / Locality</label>
            <input type="text" name="village" id="village" class="sc-input" placeholder="Village or locality name">
          </div>

        </div>

        <div class="fg anim-fade-up delay-350" style="margin-top:0;">
          <label for="home_address">Full Home Address</label>
          <textarea name="home_address" id="home_address" class="sc-input" rows="3" placeholder="House no., street, area..." required style="resize:vertical; min-height:90px;"></textarea>
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

<script src="../../assets/js/location.js"></script>
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
