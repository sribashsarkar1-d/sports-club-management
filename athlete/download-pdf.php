<?php

ob_start();

include '../config/database.php';

require '../vendor/autoload.php';

use Dompdf\Dompdf;

/*
=====================================================
CHECK APPLICATION NUMBER
=====================================================
*/

if(!isset($_GET['application_no'])){

die("Invalid Request");

}

$application_no =

mysqli_real_escape_string(

$conn,

$_GET['application_no']

);

/*
=====================================================
GET ATHLETE
=====================================================
*/

$athleteQuery =

mysqli_query(

$conn,

"SELECT *

FROM athletes

WHERE registration_no='$application_no'

LIMIT 1"

);

if(mysqli_num_rows($athleteQuery) == 0){

die("Application Not Found");

}

$athlete =
mysqli_fetch_assoc($athleteQuery);

/*
=====================================================
ATHLETE ID
=====================================================
*/

$athlete_id =

$athlete['id']
??
$athlete['athlete_id'];

/*
=====================================================
GET GUARDIAN
=====================================================
*/

$guardianQuery =

mysqli_query(

$conn,

"SELECT *

FROM guardians

WHERE athlete_id='$athlete_id'

LIMIT 1"

);

$guardian =
mysqli_fetch_assoc($guardianQuery);

/*
=====================================================
GET ADDRESS
=====================================================
*/

$addressQuery =

mysqli_query(

$conn,

"SELECT *

FROM addresses

WHERE athlete_id='$athlete_id'

LIMIT 1"

);

$address =
mysqli_fetch_assoc($addressQuery);

/*
=====================================================
GET CLUB
=====================================================
*/

$clubQuery =

mysqli_query(

$conn,

"SELECT *

FROM clubs

WHERE athlete_id='$athlete_id'

LIMIT 1"

);

$club =
mysqli_fetch_assoc($clubQuery);

/*
=====================================================
GET COMPETITION
=====================================================
*/

$competitionQuery =

mysqli_query(

$conn,

"SELECT *

FROM competitions

WHERE athlete_id='$athlete_id'

LIMIT 1"

);

$competition =
mysqli_fetch_assoc($competitionQuery);

/*
=====================================================
GET DOCUMENTS
=====================================================
*/

$documentQuery =

mysqli_query(

$conn,

"SELECT *

FROM documents

WHERE athlete_id='$athlete_id'

LIMIT 1"

);

$document =
mysqli_fetch_assoc($documentQuery);

/*
=====================================================
PROFILE PHOTO
=====================================================
*/

$profilePhoto =

'../assets/uploads/photos/'.
($athlete['profile_photo'] ?? '');

if(!file_exists($profilePhoto)){

$profilePhoto = '';

}

/*
=====================================================
STATUS
=====================================================
*/

$status =

$athlete['status']
??
$athlete['athlete_status']
??
'Pending Verification';

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
<td class="value">'.$athlete['full_name'].'</td>
</tr>

<tr>
<td class="label">Date Of Birth</td>
<td class="value">'.$athlete['dob'].'</td>
</tr>

<tr>
<td class="label">Age</td>
<td class="value">'.$athlete['age'].'</td>
</tr>

<tr>
<td class="label">Gender</td>
<td class="value">'.$athlete['gender'].'</td>
</tr>

<tr>
<td class="label">Mobile</td>
<td class="value">'.$athlete['mobile'].'</td>
</tr>

<tr>
<td class="label">Email</td>
<td class="value">'.$athlete['email'].'</td>
</tr>

<tr>
<td class="label">Blood Group</td>
<td class="value">'.$athlete['blood_group'].'</td>
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
<td class="value">'.$guardian['father_name'].'</td>
</tr>

<tr>
<td class="label">Mother Name</td>
<td class="value">'.$guardian['mother_name'].'</td>
</tr>

<tr>
<td class="label">Guardian Name</td>
<td class="value">'.$guardian['guardian_name'].'</td>
</tr>

<tr>
<td class="label">Guardian Mobile</td>
<td class="value">'.$guardian['guardian_mobile'].'</td>
</tr>

<tr>
<td class="label">Emergency Contact</td>
<td class="value">'.$guardian['emergency_contact'].'</td>
</tr>

<tr>
<td class="label">Relationship</td>
<td class="value">'.$guardian['relation_with_athlete'].'</td>
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
<td class="value">'.$address['state'].'</td>
</tr>

<tr>
<td class="label">District</td>
<td class="value">'.$address['district'].'</td>
</tr>

<tr>
<td class="label">City</td>
<td class="value">'.$address['city'].'</td>
</tr>

<tr>
<td class="label">Pin Code</td>
<td class="value">'.$address['pin_code'].'</td>
</tr>

<tr>
<td class="label">Address</td>
<td class="value">'.$address['home_address'].'</td>
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
<td class="value">'.$club['club_name'].'</td>
</tr>

<tr>
<td class="label">Coach Name</td>
<td class="value">'.$club['coach_name'].'</td>
</tr>

<tr>
<td class="label">Coach Mobile</td>
<td class="value">'.$club['coach_mobile'].'</td>
</tr>

<tr>
<td class="label">State Association</td>
<td class="value">'.$club['state_association'].'</td>
</tr>

<tr>
<td class="label">Experience</td>
<td class="value">'.$club['experience'].'</td>
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
<td class="value">'.$competition['competition_name'].'</td>
</tr>

<tr>
<td class="label">Event Name</td>
<td class="value">'.$competition['event_name'].'</td>
</tr>

<tr>
<td class="label">Age Group</td>
<td class="value">'.$competition['age_group'].'</td>
</tr>

<tr>
<td class="label">Weight Category</td>
<td class="value">'.$competition['weight_category'].'</td>
</tr>

<tr>
<td class="label">Participation Level</td>
<td class="value">'.$competition['competition_level'].'</td>
</tr>

<tr>
<td class="label">Participation Year</td>
<td class="value">'.$competition['participation_year'].'</td>
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
CLEAR BUFFER
=====================================================
*/

ob_end_clean();

/*
=====================================================
DOMPDF
=====================================================
*/

$dompdf =
new Dompdf();

$dompdf->loadHtml($html);

$dompdf->set_option(
'isRemoteEnabled',
true
);

$dompdf->setPaper(
'A4',
'portrait'
);

$dompdf->render();

/*
=====================================================
DOWNLOAD PDF
=====================================================
*/

$dompdf->stream(

$application_no.".pdf",

array(
"Attachment" => true
)

);

exit;

?>