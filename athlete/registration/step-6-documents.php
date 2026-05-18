<?php

include '../../config/session.php';

/*
=========================================
SAVE STEP 5
=========================================
*/

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $_SESSION['step5'] = $_POST;

    header(
        'Location: step-6-documents.php'
    );

    exit();

}

/*
=========================================
BLOCK DIRECT ACCESS
=========================================
*/

if(!isset($_SESSION['step5'])){

    header(
        'Location: step-5-competition.php'
    );

    exit();

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0"
>
<link rel="icon" type="image/svg+xml" href="../../assets/images/logo.svg">
<title>

 Documents Upload's

</title>

<link
rel="stylesheet"
href="../../assets/css/athlete-style.css"
>

<style>

/*
=========================================
UPLOAD ACTIVE
=========================================
*/

.upload-zone{

position:relative;
cursor:pointer;

}

.upload-zone.has-file{

border:2px solid #11d6ff !important;

background:#edfdfd !important;

}

.upload-zone.has-file .upload-title{

color:#00bcd4;

}

.upload-zone.has-file::after{

content:'✓';

position:absolute;

top:14px;

right:18px;

font-size:22px;

font-weight:900;

color:#00d26a;

}

.upload-filename{

display:block;
margin-top:10px;
font-size:13px;
font-weight:600;
color:#1d2736;
word-break:break-all;

}

</style>

</head>

<body>

<div class="reg-root">

  <!-- =========================================
  LEFT PANEL
  ========================================= -->

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

        <div class="panel-brand-text">

          Sports Club
          <span>

            Management System

          </span>

        </div>

      </div>

      <div class="panel-headline">

        <div class="panel-accent-line"></div>

        <h2>

          Upload
          <br>

          <em>

            Required
            <br>

            Documents

          </em>

        </h2>

        <p>

          Upload all required athlete
          verification documents.

        </p>

      </div>

      <nav class="step-nav">

        <p class="step-nav-title">

          Registration Progress

        </p>

        <ul class="step-nav-list">

          <li class="step-nav-item is-done">
            <span class="step-dot">&#10003;</span>
            <span class="step-label">Personal Details</span>
          </li>

          <li class="step-nav-item is-done">
            <span class="step-dot">&#10003;</span>
            <span class="step-label">Guardian Info</span>
          </li>

          <li class="step-nav-item is-done">
            <span class="step-dot">&#10003;</span>
            <span class="step-label">Address</span>
          </li>

          <li class="step-nav-item is-done">
            <span class="step-dot">&#10003;</span>
            <span class="step-label">Club Details</span>
          </li>

          <li class="step-nav-item is-done">
            <span class="step-dot">&#10003;</span>
            <span class="step-label">Competition</span>
          </li>

          <li class="step-nav-item is-active">
            <span class="step-dot">6</span>
            <span class="step-label">Documents</span>
          </li>

        </ul>

      </nav>

    </div>

  </aside>

  <!-- =========================================
  FORM PANEL
  ========================================= -->

  <main class="reg-form-panel">

    <div class="reg-form-inner">

      <span class="step-badge">

        Step 06 / 06

      </span>

      <h1 class="form-title">

        Document Uploads

      </h1>

      <p class="form-subtitle">

        Upload all required athlete
        verification documents.

      </p>

      <!-- =========================================
      ALERT
      ========================================= -->

      <div
      class="sc-alert sc-alert-info"
      style="margin-bottom:24px;"
      >

        <strong>

          Upload Guidelines :

        </strong>

        <br><br>

        • JPG / PNG / WEBP automatically convert to PDF

        <br>

        • Auto compression enabled

        <br>

        • Final PDF under 2 MB

      </div>

      <!-- =========================================
      FORM START
      ========================================= -->

      <form

      action="submit-registration.php"

      method="POST"

      enctype="multipart/form-data"
      autocomplete="off"
      >

        <div class="grid-2">

          <!-- =========================================
          AADHAAR
          ========================================= -->

          <div class="fg">

            <label>

              Aadhaar Card *

            </label>

            <div
            class="upload-zone"
            id="zoneAadhaar"
            >

              <div class="upload-icon">📄</div>

              <div class="upload-title">

                Upload Aadhaar Card

              </div>

            </div>

            <input
            type="file"
            name="aadhaar_file"
            id="aadhaar_file"
            accept=".pdf,.jpg,.jpeg,.png,.webp"
            hidden
            required
            >

            <span
            id="aadhaar_name"
            class="upload-filename"
            ></span>

          </div>

          <!-- =========================================
          BIRTH
          ========================================= -->

          <div class="fg">

            <label>

              Birth Certificate *

            </label>

            <div
            class="upload-zone"
            id="zoneBirth"
            >

              <div class="upload-icon">📄</div>

              <div class="upload-title">

                Upload Birth Certificate

              </div>

            </div>

            <input
            type="file"
            name="birth_certificate"
            id="birth_certificate"
            accept=".pdf,.jpg,.jpeg,.png,.webp"
            hidden
            required
            >

            <span
            id="birth_name"
            class="upload-filename"
            ></span>

          </div>

          <!-- =========================================
          MEDICAL
          ========================================= -->

          <div class="fg">

            <label>

              Medical Certificate *

            </label>

            <div
            class="upload-zone"
            id="zoneMedical"
            >

              <div class="upload-icon">📄</div>

              <div class="upload-title">

                Upload Medical Certificate

              </div>

            </div>

            <input
            type="file"
            name="medical_certificate"
            id="medical_certificate"
            accept=".pdf,.jpg,.jpeg,.png,.webp"
            hidden
            required
            >

            <span
            id="medical_name"
            class="upload-filename"
            ></span>

          </div>

          <!-- =========================================
          PARENT
          ========================================= -->

          <div class="fg">

            <label>

              Parent Consent File *

            </label>

            <div
            class="upload-zone"
            id="zoneParent"
            >

              <div class="upload-icon">📄</div>

              <div class="upload-title">

                Upload Parent Consent

              </div>

            </div>

            <input
            type="file"
            name="parent_consent_file"
            id="parent_consent_file"
            accept=".pdf,.jpg,.jpeg,.png,.webp"
            hidden
            required
            >

            <span
            id="parent_name"
            class="upload-filename"
            ></span>

          </div>

          <!-- =========================================
          CLUB
          ========================================= -->

          <div class="fg">

            <label>

              Club Certificate File *

            </label>

            <div
            class="upload-zone"
            id="zoneClub"
            >

              <div class="upload-icon">📄</div>

              <div class="upload-title">

                Upload Club Certificate

              </div>

            </div>

            <input
            type="file"
            name="club_certificate_file"
            id="club_certificate_file"
            accept=".pdf,.jpg,.jpeg,.png,.webp"
            hidden
            required
            >

            <span
            id="club_name"
            class="upload-filename"
            ></span>

          </div>

          <!-- =========================================
          ACHIEVEMENT
          ========================================= -->

          <div class="fg">

            <label>

              Achievement Certificate (Optional)

            </label>

            <div
            class="upload-zone"
            id="zoneAchievement"
            >

              <div class="upload-icon">🏆</div>

              <div class="upload-title">

                Upload Achievement Certificate

              </div>

            </div>

            <input
            type="file"
            name="achievement_certificate_file"
            id="achievement_certificate_file"
            accept=".pdf,.jpg,.jpeg,.png,.webp"
            hidden
            >

            <span
            id="achievement_name"
            class="upload-filename"
            ></span>

          </div>

          <!-- =========================================
          PHOTO ID
          ========================================= -->

          <div class="fg">

            <label>

              Photo ID Proof *

            </label>

            <div
            class="upload-zone"
            id="zoneProof"
            >

              <div class="upload-icon">🪪</div>

              <div class="upload-title">

                Upload Photo ID Proof

              </div>

            </div>

            <input
            type="file"
            name="photo_id_proof"
            id="photo_id_proof"
            accept=".pdf,.jpg,.jpeg,.png,.webp"
            hidden
            required
            >

            <span
            id="proof_name"
            class="upload-filename"
            ></span>

          </div>

          <!-- =========================================
          ADDITIONAL
          ========================================= -->

          <div class="fg">

            <label>

              Additional Document (Optional)

            </label>

            <div
            class="upload-zone"
            id="zoneAdditional"
            >

              <div class="upload-icon">📁</div>

              <div class="upload-title">

                Upload Additional Document

              </div>

            </div>

            <input
            type="file"
            name="additional_document"
            id="additional_document"
            accept=".pdf,.jpg,.jpeg,.png,.webp"
            hidden
            >

            <span
            id="additional_name"
            class="upload-filename"
            ></span>

          </div>

        </div>

        <!-- =========================================
        BUTTONS
        ========================================= -->

        <div
        class="form-nav"
        style="margin-top:32px;"
        >

          <button type="button" onclick="window.history.back()" class="btn-ghost"> Previous </button>

          <button
          type="submit"
          class="btn-cyan"
          >

            Submit Registration

          </button>

        </div>

      </form>

    </div>

  </main>

</div>

<!-- =========================================
PDF LIBRARY
========================================= -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="../../assets/js/athlete-script.js"></script>
<script src="../../assets/js/registration-reset.js"></script> 
<script src="../../assets/js/multi-step-storage.js"></script>

<script>

/*
=========================================
AUTO PDF CONVERT
=========================================
*/

async function convertToPDF(file){

const { jsPDF } = window.jspdf;

return new Promise((resolve)=>{

if(file.type === 'application/pdf'){

resolve(file);
return;

}

if(file.type.startsWith('image/')){

const reader =
new FileReader();

reader.onload = function(e){

const img =
new Image();

img.onload = function(){

const canvas =
document.createElement('canvas');

const ctx =
canvas.getContext('2d');

let width =
img.width;

let height =
img.height;

const maxWidth = 1200;

if(width > maxWidth){

height *= maxWidth / width;

width = maxWidth;

}

canvas.width =
width;

canvas.height =
height;

ctx.drawImage(
img,
0,
0,
width,
height
);

const compressed =

canvas.toDataURL(
'image/jpeg',
0.6
);

const pdf =

new jsPDF({

orientation:
width > height
?
'landscape'
:
'portrait',

unit:'px',

format:[width,height]

});

pdf.addImage(
compressed,
'JPEG',
0,
0,
width,
height
);

const blob =
pdf.output('blob');

const pdfFile =

new File(

[blob],

file.name.replace(
/\.[^/.]+$/,
''
)+'.pdf',

{
type:'application/pdf'
}

);

resolve(pdfFile);

};

img.src =
e.target.result;

};

reader.readAsDataURL(file);

}

});

}

/*
=========================================
BIND UPLOAD
=========================================
*/

function bindUpload(

inputId,
zoneId,
nameId

){

const input =
document.getElementById(inputId);

const zone =
document.getElementById(zoneId);

const text =
document.getElementById(nameId);

/*
=========================================
OPEN FILE
=========================================
*/

zone.addEventListener(

'click',

function(){

input.click();

}

);

/*
=========================================
FILE CHANGE
=========================================
*/

input.addEventListener(

'change',

async function(){

const file =
this.files[0];

if(!file){

return;

}

if(file.size > 10485760){

alert(
'Maximum File Size 10 MB'
);

this.value = '';

return;

}

const pdfFile =

await convertToPDF(file);

if(pdfFile.size > 2097152){

alert(
'Compressed PDF Still Larger Than 2 MB'
);

this.value = '';

return;

}

const dataTransfer =
new DataTransfer();

dataTransfer.items.add(pdfFile);

input.files =
dataTransfer.files;

text.innerHTML =
pdfFile.name;

zone.classList.add(
'has-file'
);

}

);

}

/*
=========================================
BIND ALL
=========================================
*/

bindUpload(
'aadhaar_file',
'zoneAadhaar',
'aadhaar_name'
);

bindUpload(
'birth_certificate',
'zoneBirth',
'birth_name'
);

bindUpload(
'medical_certificate',
'zoneMedical',
'medical_name'
);

bindUpload(
'parent_consent_file',
'zoneParent',
'parent_name'
);

bindUpload(
'club_certificate_file',
'zoneClub',
'club_name'
);

bindUpload(
'achievement_certificate_file',
'zoneAchievement',
'achievement_name'
);

bindUpload(
'photo_id_proof',
'zoneProof',
'proof_name'
);

bindUpload(
'additional_document',
'zoneAdditional',
'additional_name'
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
</html>