<?php

include '../../config/session.php';

/*
=========================================
SAVE STEP 4
=========================================
*/

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $_SESSION['step4'] = $_POST;

    header(
        'Location: step-5-competition.php'
    );

    exit();

}

/*
=========================================
BLOCK DIRECT ACCESS
=========================================
*/

if(!isset($_SESSION['step4'])){

    header(
        'Location: step-4-club.php'
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
<title>Competition Details</title>
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
        <h2>Define<br><em>Your<br>Arena</em></h2>
        <p>Competition details determine your category and level of participation.</p>
      </div>
      <nav class="step-nav">
        <p class="step-nav-title">Registration Progress</p>
        <ul class="step-nav-list">
          <li class="step-nav-item is-done"><span class="step-dot">&#10003;</span><span class="step-label">Personal Details</span></li>
          <li class="step-nav-item is-done"><span class="step-dot">&#10003;</span><span class="step-label">Guardian Info</span></li>
          <li class="step-nav-item is-done"><span class="step-dot">&#10003;</span><span class="step-label">Address</span></li>
          <li class="step-nav-item is-done"><span class="step-dot">&#10003;</span><span class="step-label">Club Details</span></li>
          <li class="step-nav-item is-active"><span class="step-dot">5</span><span class="step-label">Competition</span></li>
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
      <span class="mobile-step-info">Step 5 of 6</span>
    </div>
    <div class="step-pips">
      <div class="step-pip-wrap is-done"><div class="step-pip">&#10003;</div><span class="step-pip-txt">Personal</span></div>
      <div class="step-pip-wrap is-done"><div class="step-pip">&#10003;</div><span class="step-pip-txt">Guardian</span></div>
      <div class="step-pip-wrap is-done"><div class="step-pip">&#10003;</div><span class="step-pip-txt">Address</span></div>
      <div class="step-pip-wrap is-done"><div class="step-pip">&#10003;</div><span class="step-pip-txt">Club</span></div>
      <div class="step-pip-wrap is-active"><div class="step-pip">5</div><span class="step-pip-txt">Sport</span></div>
      <div class="step-pip-wrap"><div class="step-pip">6</div><span class="step-pip-txt">Docs</span></div>
    </div>
  </header>

  <main class="reg-form-panel">
    <div class="reg-form-inner">

      <span class="step-badge">Step 05 &nbsp;/&nbsp; 06</span>
      <h1 class="form-title">Competition Details</h1>
      <p class="form-subtitle">Tell us about your sport, age group, and competition level.</p>
      <h3 class="form-title-h3">Important Notes</h3>
      <p class="form-subtitle">
        Competition category and participation level will be verified by the Sports Club Administration before approval.
      </p>

      <form action="step-6-documents.php" method="POST" autocomplete="off">

       <div class="grid-2">

  <!-- SPORT NAME -->

  <div class="fg anim-fade-up delay-100">

    <label for="competition_name">

      Sport / Competition Name

    </label>

    <input
      type="text"
      name="competition_name"
      id="competition_name"
      class="sc-input"
      placeholder="e.g. Taekwondo, Boxing, Athletics"
      required>

  </div>

  <!-- EVENT NAME -->

  <div class="fg anim-fade-up delay-120">

    <label for="event_name">

      Event Name

    </label>

    <input
      type="text"
      name="event_name"
      id="event_name"
      class="sc-input"
      placeholder="e.g. Individual Sparring, Relay Race"
      required>

  </div>

  <!-- AGE GROUP -->

  <div class="fg anim-fade-up delay-150">

    <label for="age_group">

      Age Group

    </label>

    <div class="sel-wrap">

      <select
        name="age_group"
        id="age_group"
        class="sc-select"
        required>

        <option value="">
          Select Age Group
        </option>

        <option value="Under 8">
          Under 8
        </option>

        <option value="Under 10">
          Under 10
        </option>

        <option value="Under 14">
          Under 14
        </option>

        <option value="Under 17">
          Under 17
        </option>

        <option value="Under 21">
          Under 21
        </option>

        <option value="Senior">
          Senior
        </option>

        <option value="Veteran">
          Veteran
        </option>

      </select>

    </div>

  </div>

  <!-- GENDER CATEGORY -->

  <div class="fg anim-fade-up delay-170">

    <label for="gender_category">

      Gender Category

    </label>

    <div class="sel-wrap">

      <select
        name="gender_category"
        id="gender_category"
        class="sc-select"
        required>

        <option value="">
          Select Category
        </option>

        <option value="Male">
          Male
        </option>

        <option value="Female">
          Female
        </option>

        <option value="Mixed">
          Mixed
        </option>

      </select>

    </div>

  </div>

  <!-- WEIGHT CATEGORY -->

  <div class="fg anim-fade-up delay-200">

    <label for="weight_category">

      Weight Category

    </label>

    <input
      type="text"
      name="weight_category"
      id="weight_category"
      class="sc-input"
      placeholder="e.g. 60 KG, 75 KG, Open"
      required>

  </div>

  <!-- PARTICIPATION LEVEL -->

  <div class="fg anim-fade-up delay-220">

    <label for="participation_level">

      Participation Level

    </label>

    <div class="sel-wrap">

      <select
        name="participation_level"
        id="participation_level"
        class="sc-select"
        required>

        <option value="">
          Select Level
        </option>

        <option value="School">
          School
        </option>

        <option value="District">
          District
        </option>

        <option value="State">
          State
        </option>

        <option value="National">
          National
        </option>

        <option value="International">
          International
        </option>

      </select>

    </div>

  </div>

  <!-- EXPERIENCE -->

  <div class="fg anim-fade-up delay-240">

    <label for="competition_experience">

      Competition Experience

    </label>

    <div class="sel-wrap">

      <select
        name="competition_experience"
        id="competition_experience"
        class="sc-select"
        required>

        <option value="">
          Select Experience
        </option>

        <option value="First Time">
          First Time
        </option>

        <option value="1-2 Competitions">
          1-2 Competitions
        </option>

        <option value="3-5 Competitions">
          3-5 Competitions
        </option>

        <option value="5+ Competitions">
          5+ Competitions
        </option>

      </select>

    </div>

  </div>

  <!-- PARTICIPATION YEAR -->

  <div class="fg anim-fade-up delay-260">

    <label for="participation_year">

      Participation Year

    </label>

    <input
type="number"
name="participation_year"
id="participation_year"
class="sc-input"
placeholder="Enter competition year"
min="2000"
max="2099"
value="<?php echo date('Y'); ?>"
required>

  </div>

  <!-- ACHIEVEMENT -->

  <div class="fg anim-fade-up delay-280">

    <label for="previous_achievement">

      Previous Achievement

      <span class="field-optional">
        (Optional)
      </span>

    </label>

    <input
      type="text"
      name="previous_achievement"
      id="previous_achievement"
      class="sc-input"
      placeholder="e.g. Gold Medal, State Champion">

  </div>

  <!-- MEDICAL CONDITION -->

  <div class="fg full-width anim-fade-up delay-300">

    <label for="medical_condition">

      Medical Condition / Injury Details

      <span class="field-optional">
        (Optional)
      </span>

    </label>

    <textarea
      name="medical_condition"
      id="medical_condition"
      class="sc-input"
      rows="3"
      placeholder="Mention any medical issue, injury, allergy or physical limitation"
      style="resize:vertical; min-height:100px;"></textarea>

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
