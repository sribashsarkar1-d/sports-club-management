<?php

include '../../config/session.php';

if(!isset($_GET['application_no'])){
  header("Location: register.php");
  exit();
}

$application_no = $_GET['application_no'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/svg+xml" href="../../assets/images/logo.svg">
<title>Registration Successful</title>
<link rel="stylesheet" href="../../assets/css/athlete-style.css">
</head>
<body>

<div class="success-root">
  <div class="success-card anim-scale-in">

    <div class="success-icon">&#10003;</div>

    <h1 class="success-title">Registration<br>Submitted!</h1>
    <p class="success-sub">
      Your athlete registration has been successfully submitted.
      Our team will review your application and update you shortly.
    </p>

    <div class="app-number-card">
      <div class="app-number-label">Application Number</div>
      <div class="app-number-value"><?php echo htmlspecialchars($application_no); ?></div>
      <div class="app-number-hint">Save this number to track your application status</div>
    </div>

    <div class="success-actions">
      <a href="../assets/uploads/pdf/<?php echo $application_no; ?>.pdf"
         download class="btn-cyan" style="display:inline-flex;align-items:center;gap:8px;">
        &#11015;&nbsp; Download Registration PDF
      </a>
      <a href="register.php" class="btn-ghost" style="color:var(--clr-graphite);border-color:var(--clr-border);">
        &larr; Back to Home
      </a>
    </div>

    <p class="success-note">
      You can check your application status anytime at
      <a href="../status-check.php" style="color:var(--clr-cyan-dark);font-weight:600;">Status Check</a>.
    </p>

  </div>
</div>

<script src="../../assets/js/registration-reset.js"></script>

<script>

/*
==================================================
FULL REGISTRATION RESET
==================================================
*/

if(
typeof clearRegistrationStorage === 'function'
){

clearRegistrationStorage();

}

/*
==================================================
REMOVE HISTORY
==================================================
*/

window.history.replaceState(
{},
document.title,
window.location.pathname
);

</script>
</body>
</html>
