<?php

ob_start();

error_reporting(E_ALL);
ini_set('display_errors',1);

/*
=====================================================
INCLUDE FILES
=====================================================
*/

include '../../config/database.php';

include '../../config/session.php';

include '../../config/smtp.php';

require '../../vendor/autoload.php';

use Dompdf\Dompdf;

/*
=====================================================
CHECK SESSION
=====================================================
*/

$requiredSteps = [

'step1',
'step2',
'step3',
'step4',
'step5'

];

foreach($requiredSteps as $step){

if(!isset($_SESSION[$step])){

die('Session Expired');

}

}

/*
=====================================================
GET SESSION DATA
=====================================================
*/

$step1 =
$_SESSION['step1'];

$step2 =
$_SESSION['step2'];

$step3 =
$_SESSION['step3'];

$step4 =
$_SESSION['step4'];

$step5 =
$_SESSION['step5'];

$photoName =
$_SESSION['step1']['photo'] ?? '';
if($photoName == ''){

$photoName =

$_SESSION['photo']

?? '';

}

/*
=====================================================
APPLICATION NUMBER
=====================================================
*/

$application_no =

'SCM-'.
date('Y').
'-'.
rand(100000,999999);

/*
=====================================================
CREATE DIRECTORIES
=====================================================
*/

$directories = [

'../assets/uploads/aadhaar/',
'../assets/uploads/birth/',
'../assets/uploads/medical/',
'../assets/uploads/photos/',
'../assets/uploads/pdf/'

];

foreach($directories as $dir){

if(!file_exists($dir)){

mkdir(
$dir,
0777,
true
);

}

}

/*
=====================================================
CLEAN FUNCTION
=====================================================
*/

function clean($conn,$value){

return mysqli_real_escape_string(

$conn,

trim($value ?? '')

);

}

/*
=====================================================
DYNAMIC INSERT FUNCTION
=====================================================
*/


/*
=====================================================
FILE UPLOAD FUNCTION
=====================================================
*/

function uploadFile(

$fileKey,
$folder

){

if(

isset($_FILES[$fileKey]) &&
!empty($_FILES[$fileKey]['name'])

){

$ext = strtolower(

pathinfo(

$_FILES[$fileKey]['name'],
PATHINFO_EXTENSION

)

);

$fileName =

time().
'_'.
rand(1000,9999).
'.'.
$ext;

move_uploaded_file(

$_FILES[$fileKey]['tmp_name'],

$folder.$fileName

);

return $fileName;

}

return '';

}
/*
=====================================================
CHECK COLUMN EXISTS
=====================================================
*/

function columnExists(

$conn,
$table,
$column

){

$table =

mysqli_real_escape_string(
$conn,
$table
);

$column =

mysqli_real_escape_string(
$conn,
$column
);

$query =

"SHOW COLUMNS FROM `$table`
LIKE '$column'";

$result =

mysqli_query(
$conn,
$query
);

if(!$result){

return false;

}

return mysqli_num_rows($result) > 0;

}

/*
=====================================================
DYNAMIC INSERT FUNCTION
=====================================================
*/

function dynamicInsert(

$conn,
$table,
$data

){

$columns = [];
$values  = [];

/*
=====================================================
LOOP DATA
=====================================================
*/

foreach($data as $column => $value){

/*
=====================================================
CHECK COLUMN EXISTS
=====================================================
*/

if(

columnExists(
$conn,
$table,
$column
)

){

/*
=====================================================
SKIP EMPTY FIELD
=====================================================
*/

if(

$value !== '' &&
$value !== null

){

$columns[] =

"`".$column."`";

$values[] =

"'".
mysqli_real_escape_string(
$conn,
trim($value)
).
"'";

}

}

}

/*
=====================================================
NO COLUMN
=====================================================
*/

if(empty($columns)){

throw new Exception(

"No valid insert data for ".$table

);

}

/*
=====================================================
FINAL QUERY
=====================================================
*/

$query =

"INSERT INTO `".$table."`

(

".implode(',',$columns)."

)

VALUES

(

".implode(',',$values)."

)";

/*
=====================================================
EXECUTE QUERY
=====================================================
*/

$result =

mysqli_query(
$conn,
$query
);

if(!$result){

throw new Exception(

mysqli_error($conn)

);

}

/*
=====================================================
RETURN INSERT ID
=====================================================
*/

return mysqli_insert_id($conn);

}


/*
=====================================================
UPLOAD FILES
=====================================================
*/

$aadhaarName =

uploadFile(
'aadhaar_file',
'../assets/uploads/aadhaar/'
);

$birthName =

uploadFile(
'birth_certificate',
'../assets/uploads/birth/'
);

$medicalName =

uploadFile(
'medical_certificate',
'../assets/uploads/medical/'
);

$parentConsentName =

uploadFile(
'parent_consent_file',
'../assets/uploads/parent/'
);

$clubCertificateName =

uploadFile(
'club_certificate_file',
'../assets/uploads/club/'
);

$achievementName =

uploadFile(
'achievement_certificate_file',
'../assets/uploads/achievement/'
);

$photoProofName =

uploadFile(
'photo_id_proof',
'../assets/uploads/proof/'
);

$additionalName =

uploadFile(
'additional_document',
'../assets/uploads/additional/'
);
/*
=====================================================
START DATABASE TRANSACTION
=====================================================
*/

mysqli_begin_transaction($conn);

try{

/*
=====================================================
ATHLETES TABLE
=====================================================
*/

$athleteData = [

'registration_no'      => $application_no,
'full_name'            => $step1['full_name'] ?? '',
'dob'                  => $step1['date_of_birth'] ?? '',
'age'                  => $step1['age'] ?? '',
'gender'               => $step1['gender'] ?? '',
'country'              => 'India',
'mobile'               => $step1['mobile'] ?? '',
'email'                => $step1['email'] ?? '',
'blood_group'          => $step1['blood_group'] ?? '',
'profile_photo'        => basename($photoName),
'medical_condition'    => $step5['medical_condition'] ?? '',
'previous_achievement' => $step5['previous_achievement'] ?? '',
'status'               => 'Pending'

];

$athlete_id =

dynamicInsert(

$conn,
'athletes',
$athleteData

);

/*
=====================================================
GUARDIANS TABLE
=====================================================
*/

$guardianData = [

'athlete_id'            => $athlete_id,
'father_name'           => $step2['father_name'] ?? '',
'mother_name'           => $step2['mother_name'] ?? '',
'guardian_name'         => $step2['guardian_name'] ?? '',
'guardian_mobile'       => $step2['guardian_mobile'] ?? '',
'guardian_email'        => $step2['guardian_email'] ?? '',
'emergency_contact'     => $step2['emergency_contact'] ?? '',
'relation_with_athlete' => $step2['relationship'] ?? ''

];

dynamicInsert(

$conn,
'guardians',
$guardianData

);

/*
=====================================================
ADDRESSES TABLE
=====================================================
*/

$addressData = [

'athlete_id'   => $athlete_id,
'country'      => 'India',
'state'        => $step3['state'] ?? '',
'district'     => $step3['district'] ?? '',
'city'         => $step3['city'] ?? '',
'locality'     => $step3['locality'] ?? '',
'village'      => $step3['village'] ?? '',
'landmark'     => $step3['landmark'] ?? '',
'pin_code'     => $step3['pin_code'] ?? '',
'home_address' => $step3['home_address'] ?? '',
'full_address' => $step3['home_address'] ?? ''

];

dynamicInsert(

$conn,
'addresses',
$addressData

);

/*
=====================================================
CLUBS TABLE
=====================================================
*/

$clubData = [

'athlete_id'           => $athlete_id,
'club_name'            => $step4['club_name'] ?? '',
'club_registration_no' => $step4['club_registration_no'] ?? '',
'state_association'    => $step4['state_association'] ?? '',
'association_id'       => $step4['association_id'] ?? '',
'coach_name'           => $step4['coach_name'] ?? '',
'coach_mobile'         => $step4['coach_mobile'] ?? '',
'coach_email'          => $step4['coach_email'] ?? '',
'experience_years'     => $step4['experience_years'] ?? '',
'training_address'     => $step4['training_address'] ?? ''

];

dynamicInsert(

$conn,
'clubs',
$clubData

);

/*
=====================================================
COMPETITIONS TABLE
=====================================================
*/

$competitionData = [

'athlete_id'             => $athlete_id,
'competition_name'       => $step5['competition_name'] ?? '',
'event_name'             => $step5['event_name'] ?? '',
'age_group'              => $step5['age_group'] ?? '',
'weight_category'        => $step5['weight_category'] ?? '',
'competition_level'      => $step5['participation_level'] ?? '',
'competition_experience' => $step5['competition_experience'] ?? '',
'participation_year'     => $step5['participation_year'] ?? '',
'previous_achievement'   => $step5['previous_achievement'] ?? '',
'medical_condition'      => $step5['medical_condition'] ?? ''

];

dynamicInsert(

$conn,
'competitions',
$competitionData

);

/*
=====================================================
DOCUMENTS TABLE
=====================================================
*/

$documentData = [

'athlete_id'                    => $athlete_id,

'aadhaar_file'                  => $aadhaarName,

'birth_certificate'             => $birthName,

'passport_photo'                => $photoName,

'medical_certificate'           => $medicalName,

'parent_consent_file'           => $parentConsentName,

'club_certificate_file'         => $clubCertificateName,

'achievement_certificate_file'  => $achievementName,

'photo_id_proof'                => $photoProofName,

'additional_document'           => $additionalName,

'upload_status'                 => 'Uploaded'

];

dynamicInsert(

$conn,
'documents',
$documentData

);


/*
=====================================================
COMMIT DATABASE
=====================================================
*/

mysqli_commit($conn);

}catch(Exception $e){

mysqli_rollback($conn);

die(

'Database Error : '.
$e->getMessage()

);

}

/*
=====================================================
PDF HTML
=====================================================
*/

$html = '

<html>

<head>

<style>

body{

font-family: DejaVu Sans, sans-serif;
background:#F2F0EC;
color:#1a1a2e;
font-size:13px;
line-height:1.7;
margin:0;
padding:30px;

}

.wrapper{

background:#ffffff;
border-radius:22px;
overflow:hidden;

}

.header{

background:#000052;
padding:45px 50px;
color:#ffffff;

}

.header h1{

margin:0;
font-size:42px;
font-weight:900;
text-transform:uppercase;

}

.header h1 span{

color:#0ff0fc;

}

.header p{

margin-top:12px;
font-size:14px;
color:rgba(255,255,255,0.70);

}

.section{

padding:35px 50px 10px;

}

.section-title{

font-size:20px;
font-weight:900;
text-transform:uppercase;
color:#000052;
margin-bottom:20px;

}

.info-table{

width:100%;
border-collapse:collapse;
margin-bottom:25px;

}

.info-table td{

padding:14px 18px;
border:1px solid #e4e5ea;

}

.label{

width:32%;
background:#f8f9fb;
font-size:11px;
font-weight:700;
text-transform:uppercase;

}

.value{

background:#ffffff;
font-size:13px;

}

.footer{

margin-top:30px;
background:#000052;
padding:28px 40px;
text-align:center;
color:#ffffff;

}

.status{

display:inline-block;
padding:8px 18px;
border-radius:999px;
background:#0ff0fc;
font-size:11px;
font-weight:800;
color:#000;

}

</style>

</head>

<body>

<div class="wrapper">

<div class="header">

<h1>

Sports Club
<span>Management</span>

</h1>

<p>

Official Athlete Registration Application

</p>

</div>

<div class="section">

<div class="section-title">

Application Details

</div>

<table class="info-table">

<tr>
<td class="label">Application Number</td>
<td class="value">'.$application_no.'</td>
</tr>

<tr>
<td class="label">Status</td>
<td class="value">

<span class="status">

Pending Verification

</span>

</td>
</tr>

<tr>
<td class="label">Date</td>
<td class="value">'.date('d M Y').'</td>
</tr>

</table>

</div>

<div class="section">

<div class="section-title">

Personal Details

</div>

<table class="info-table">

<tr>
<td class="label">Full Name</td>
<td class="value">'.$step1['full_name'].'</td>
</tr>

<tr>
<td class="label">Date Of Birth</td>
<td class="value">'.$step1['date_of_birth'].'</td>
</tr>

<tr>
<td class="label">Age</td>
<td class="value">'.$step1['age'].'</td>
</tr>

<tr>
<td class="label">Gender</td>
<td class="value">'.$step1['gender'].'</td>
</tr>

<tr>
<td class="label">Mobile</td>
<td class="value">'.$step1['mobile'].'</td>
</tr>

<tr>
<td class="label">Email</td>
<td class="value">'.$step1['email'].'</td>
</tr>

<tr>
<td class="label">Blood Group</td>
<td class="value">'.$step1['blood_group'].'</td>
</tr>

</table>

</div>

<div class="section">

<div class="section-title">

Guardian Details

</div>

<table class="info-table">

<tr>
<td class="label">Father Name</td>
<td class="value">'.$step2['father_name'].'</td>
</tr>

<tr>
<td class="label">Mother Name</td>
<td class="value">'.$step2['mother_name'].'</td>
</tr>

<tr>
<td class="label">Guardian Name</td>
<td class="value">'.$step2['guardian_name'].'</td>
</tr>

<tr>
<td class="label">Guardian Mobile</td>
<td class="value">'.$step2['guardian_mobile'].'</td>
</tr>

<tr>
<td class="label">Emergency Contact</td>
<td class="value">'.$step2['emergency_contact'].'</td>
</tr>

<tr>
<td class="label">Relationship</td>
<td class="value">'.$step2['relationship'].'</td>
</tr>

</table>

</div>

<div class="section">

<div class="section-title">

Address Details

</div>

<table class="info-table">

<tr>
<td class="label">Country</td>
<td class="value">India</td>
</tr>

<tr>
<td class="label">State</td>
<td class="value">'.$step3['state'].'</td>
</tr>

<tr>
<td class="label">District</td>
<td class="value">'.$step3['district'].'</td>
</tr>

<tr>
<td class="label">City</td>
<td class="value">'.$step3['city'].'</td>
</tr>

<tr>
<td class="label">Pin Code</td>
<td class="value">'.$step3['pin_code'].'</td>
</tr>

<tr>
<td class="label">Address</td>
<td class="value">'.$step3['home_address'].'</td>
</tr>

</table>

</div>

<div class="section">

<div class="section-title">

Club Details

</div>

<table class="info-table">

<tr>
<td class="label">Club Name</td>
<td class="value">'.$step4['club_name'].'</td>
</tr>

<tr>
<td class="label">Coach Name</td>
<td class="value">'.$step4['coach_name'].'</td>
</tr>

<tr>
<td class="label">Coach Mobile</td>
<td class="value">'.$step4['coach_mobile'].'</td>
</tr>

<tr>
<td class="label">State Association</td>
<td class="value">'.$step4['state_association'].'</td>
</tr>

<tr>
<td class="label">Experience</td>
<td class="value">'.$step4['experience_years'].'</td>
</tr>

</table>

</div>

<div class="section">

<div class="section-title">

Competition Details

</div>

<table class="info-table">

<tr>
<td class="label">Competition Name</td>
<td class="value">'.$step5['competition_name'].'</td>
</tr>

<tr>
<td class="label">Event Name</td>
<td class="value">'.$step5['event_name'].'</td>
</tr>

<tr>
<td class="label">Age Group</td>
<td class="value">'.$step5['age_group'].'</td>
</tr>

<tr>
<td class="label">Weight Category</td>
<td class="value">'.$step5['weight_category'].'</td>
</tr>

<tr>
<td class="label">Participation Level</td>
<td class="value">'.$step5['participation_level'].'</td>
</tr>

<tr>
<td class="label">Participation Year</td>
<td class="value">'.$step5['participation_year'].'</td>
</tr>

</table>

</div>

<div class="footer">

<h3>

Sports Club Management System

</h3>

<p>

This document is digitally generated from the
official Sports Club Management registration system.

</p>

</div>

</div>

</body>

</html>

';

/*
=====================================================
GENERATE PDF
=====================================================
*/

$dompdf =
new Dompdf();

$dompdf->loadHtml($html);

$dompdf->setPaper(

'A4',

'portrait'

);

$dompdf->render();

$output =
$dompdf->output();

/*
=====================================================
SAVE PDF
=====================================================
*/

$pdfPath =

'../assets/uploads/pdf/'.
$application_no.
'.pdf';

file_put_contents(

$pdfPath,

$output

);

/*
=====================================================
SEND EMAIL
=====================================================
*/

$subject =
'Registration Successful';

$message = '

<div style="font-family:Arial;background:#f4f7fb;padding:40px;">

<div style="max-width:700px;margin:auto;background:#fff;border-radius:20px;overflow:hidden;">

<div style="background:#000052;padding:40px;text-align:center;color:#fff;">

<h1>

Sports Club Management

</h1>

<p>

Athlete Registration Successful

</p>

</div>

<div style="padding:35px;">

<h2>

Hello '.$step1['full_name'].'

</h2>

<p>

Your athlete registration has been submitted successfully.

</p>

<p>

Application Number :

<b>

'.$application_no.'

</b>

</p>

<p>

Status :

<b>

Pending Verification

</b>

</p>

</div>

</div>

</div>

';

sendMail(

$step1['email'],

$subject,

$message

);

/*
=====================================================
CLEAR SESSION
=====================================================
*/

session_destroy();

/*
=====================================================
REDIRECT
=====================================================
*/

header(

'Location: success.php?application_no='.
$application_no

);

exit;

?>