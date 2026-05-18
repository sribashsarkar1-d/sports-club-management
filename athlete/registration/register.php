<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/svg+xml" href="../../assets/images/logo.svg">
<title>Athlete Registration — Sports Club Management</title>
<link rel="stylesheet" href="../../assets/css/athlete-style.css">
</head>
<body>

<div class="landing-root">
  <div class="landing-inner">

    <!-- Brand -->
    <div class="landing-brand anim-fade-down">
      <div class="landing-logo">SCM</div>
      <div class="landing-brand-text">
        Sports Club
        <small>Management System</small>
      </div>
    </div>

    <!-- Eyebrow -->
    <p class="landing-eyebrow anim-fade-in delay-100">Athlete Registration Portal</p>

    <!-- Headline -->
    <h1 class="landing-headline anim-fade-up delay-150">
      Register.
      <span class="h-cyan">Compete.</span>
      Win.
    </h1>

    <!-- Sub -->
    <p class="landing-sub anim-fade-up delay-200">
      Join our elite sports network. Complete your athlete profile in 6 simple steps
      and unlock your path to competition.
    </p>

    <!-- Step chips -->
    <div class="landing-chips anim-fade-up delay-300">
      <span class="chip"><span class="chip-num">1</span> Personal Details</span>
      <span class="chip"><span class="chip-num">2</span> Guardian Info</span>
      <span class="chip"><span class="chip-num">3</span> Address</span>
      <span class="chip"><span class="chip-num">4</span> Club Details</span>
      <span class="chip"><span class="chip-num">5</span> Competition</span>
      <span class="chip"><span class="chip-num">6</span> Documents</span>
    </div>

    <!-- CTA -->
    <div class="landing-cta anim-fade-up delay-400">
      <a href="step-1-personal.php" class="btn-cyan" style="font-size:1.1rem; padding:16px 40px;">
        Start Registration &rarr;
      </a>
      <a href="../status-check.php" class="btn-ghost" style="color:rgba(255,255,255,0.6); border-color:rgba(255,255,255,0.2);">
        Check Status
      </a>
    </div>

  </div>
</div>
<script src="../../assets/js/registration-reset.js"></script>


<script>

window.addEventListener(

'DOMContentLoaded',

function(){

if(
typeof clearRegistrationStorage === 'function'
){

clearRegistrationStorage();

}

}

);

</script>
</body>
</html>