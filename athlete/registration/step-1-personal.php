<?php

include '../../config/session.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/svg+xml" href="../../assets/images/logo.svg">
<title>Personal Details</title>
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
        <h2>Your<br>Journey<br><em>Starts<br>Here</em></h2>
        <p>Complete all 6 steps to submit your official athlete registration.</p>
      </div>
      <nav class="step-nav">
        <p class="step-nav-title">Registration Progress</p>
        <ul class="step-nav-list">
          <li class="step-nav-item is-active"><span class="step-dot">1</span><span class="step-label">Personal Details</span></li>
          <li class="step-nav-item"><span class="step-dot">2</span><span class="step-label">Guardian Info</span></li>
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
      <span class="mobile-step-info">Step 1 of 6</span>
    </div>
    <div class="step-pips">
      <div class="step-pip-wrap is-active"><div class="step-pip">1</div><span class="step-pip-txt">Personal</span></div>
      <div class="step-pip-wrap"><div class="step-pip">2</div><span class="step-pip-txt">Guardian</span></div>
      <div class="step-pip-wrap"><div class="step-pip">3</div><span class="step-pip-txt">Address</span></div>
      <div class="step-pip-wrap"><div class="step-pip">4</div><span class="step-pip-txt">Club</span></div>
      <div class="step-pip-wrap"><div class="step-pip">5</div><span class="step-pip-txt">Sport</span></div>
      <div class="step-pip-wrap"><div class="step-pip">6</div><span class="step-pip-txt">Docs</span></div>
    </div>
  </header>

  <!-- ── Form Panel ── -->
  <main class="reg-form-panel">
    <div class="reg-form-inner">

      <span class="step-badge">Step 01 &nbsp;/&nbsp; 06</span>
      <h1 class="form-title">Personal Details</h1>
      <p class="form-subtitle">Enter your basic personal information to begin your registration.</p>

     <form
id="step1Form"
action="step-2-guardian.php"
method="POST"
enctype="multipart/form-data"
autocomplete="off">

<div class="grid-2">

<!-- FULL NAME -->

<div class="fg anim-fade-up delay-100">

<label for="full_name">
Full Name
</label>

<input
type="text"
name="full_name"
id="full_name"
class="sc-input"
placeholder="Enter your full name"
required>

</div>

<!-- EMAIL -->

<div class="fg anim-fade-up delay-150">

<label for="email">
Email Address
</label>

<input
type="email"
name="email"
id="email"
class="sc-input"
placeholder="you@example.com"
required>

</div>

<!-- MOBILE -->

<div class="fg anim-fade-up delay-200">

<label for="mobile">
Mobile Number
</label>

<input
type="text"
name="mobile"
id="mobile"
class="sc-input"
placeholder="10-digit mobile number"
maxlength="10"
required>

</div>

<!-- GENDER -->

<div class="fg anim-fade-up delay-250">

<label for="gender">
Gender
</label>

<div class="sel-wrap">

<select
name="gender"
id="gender"
class="sc-select"
required>

<option value="">
Select Gender
</option>

<option value="Male">
Male
</option>

<option value="Female">
Female
</option>

<option value="Other">
Other
</option>

</select>

</div>

</div>

<!-- DOB -->

<div class="fg anim-fade-up delay-300">

<label for="dob">
Date of Birth
</label>

<input
type="date"
name="date_of_birth"
id="dob"
class="sc-input"
required>

</div>

<!-- AGE -->

<div class="fg anim-fade-up delay-300">

<label for="age">
Age
</label>

<input
type="text"
name="age"
id="age"
class="sc-input"
readonly
placeholder="Auto-calculated">

</div>

<!-- BLOOD GROUP -->

<div class="fg anim-fade-up delay-400">

<label for="blood_group">
Blood Group
</label>

<div class="sel-wrap">

<select
name="blood_group"
id="blood_group"
class="sc-select"
required>

<option value="">
Select Blood Group
</option>

<option value="A+">A+</option>
<option value="A-">A-</option>
<option value="B+">B+</option>
<option value="B-">B-</option>
<option value="O+">O+</option>
<option value="O-">O-</option>
<option value="AB+">AB+</option>
<option value="AB-">AB-</option>

</select>

</div>

</div>

<!-- ADDRESS -->

<!-- PHOTO -->

<div class="fg anim-fade-up delay-500"
style="grid-column:1/-1;">

<label>
Passport Size Photo
</label>

<div
class="upload-zone"
onclick="document.getElementById('photo').click();"
id="photoZone">

<div class="upload-icon">
📷
</div>

<div class="upload-title">
Click to Upload Photo
</div>

<div class="upload-hint">
Auto convert & compress below 1 MB
</div>

<img
id="preview"
class="photo-preview-img"
style="display:none;"
alt="Photo Preview">

</div>

<input
type="file"
name="photo"
id="photo"
accept="image/*"
hidden>

<input
type="hidden"
name="compressed_photo"
id="compressed_photo">

</div>

</div>

<!-- BUTTONS -->

<div
class="form-nav"
style="justify-content:flex-end;">

<button
type="submit"
class="btn-navy">

Next Step →

</button>

</div>

</form>

    </div><!-- /reg-form-inner -->

    <footer class="sc-footer">
      &copy; <?php echo date('Y'); ?> Sports Club Management &nbsp;&middot;&nbsp;
      <a href="../status-check.php">Check Status</a>
    </footer>

  </main><!-- /reg-form-panel -->

</div><!-- /reg-root -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/compressorjs/1.2.1/compressor.min.js"></script>
<script src="../../assets/js/athlete-script.js"></script>
<script src="../../assets/js/registration-reset.js"></script>
<script src="../../assets/js/multi-step-storage.js"></script> 
<script>

/*
=========================================
PHOTO AUTO COMPRESS
=========================================
*/

const photoInput =

document.getElementById('photo');

/*
=========================================
FILE CHANGE
=========================================
*/

photoInput.addEventListener(

'change',

function(e){

const file =

e.target.files[0];

if(!file){

return;

}

/*
=========================================
IMAGE CHECK
=========================================
*/

if(

!file.type.startsWith('image/')

){

alert(

'Only Image Allowed'

);

photoInput.value = '';

return;

}

/*
=========================================
AUTO COMPRESS
=========================================
*/

new Compressor(

file,

{

quality:0.6,

maxWidth:1200,

maxHeight:1200,

mimeType:'image/jpeg',

convertSize:0,

success(result){

/*
=========================================
FINAL SIZE CHECK
=========================================
*/

if(result.size > 1048576){

alert(

'Compressed Image Still Larger Than 1 MB'

);

photoInput.value = '';

return;

}

/*
=========================================
CREATE NEW FILE
=========================================
*/

const compressedFile =

new File(

[result],

'profile-photo.jpg',

{

type:'image/jpeg'

}

);

/*
=========================================
REPLACE INPUT FILE
=========================================
*/

const dataTransfer =

new DataTransfer();

dataTransfer.items.add(
compressedFile
);

photoInput.files =
dataTransfer.files;

/*
=========================================
SHOW SUCCESS
=========================================
*/

const uploadZone =

document.querySelector(
'#photoUploadZone'
);

if(uploadZone){

uploadZone.classList.add(
'has-file'
);

}

const photoName =

document.querySelector(
'#photo_name'
);

if(photoName){

photoName.innerHTML =

compressedFile.name +

' (' +

Math.round(
compressedFile.size / 1024
) +

' KB)';

}

},

error(err){

alert(

'Image Compression Failed'

);

console.log(err);

}

}

);

}

);




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
