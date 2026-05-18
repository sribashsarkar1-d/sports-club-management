<?php

include '../../config/database.php';

include '../../config/session.php';

include '../../config/smtp.php';

/*
=====================================================
CHECK SUBMIT
=====================================================
*/

if(isset($_POST['update_status'])){

/*
=====================================================
GET DATA
=====================================================
*/

$athlete_id =

intval(
$_POST['athlete_id']
);

$status =

mysqli_real_escape_string(

$conn,

$_POST['athlete_status']

);

/*
=====================================================
UPDATE STATUS
=====================================================
*/

$query =

mysqli_query(

$conn,

"UPDATE athletes SET

athlete_status='$status'

WHERE athlete_id='$athlete_id'"

);

/*
=====================================================
SUCCESS
=====================================================
*/

if($query){

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

WHERE athlete_id='$athlete_id'

LIMIT 1"

);

$athlete =
mysqli_fetch_assoc(
$athleteQuery
);

/*
=====================================================
ACTIVITY LOG
=====================================================
*/

mysqli_query(

$conn,

"INSERT INTO activity_logs

(

admin_id,
athlete_id,
activity

)

VALUES

(

'".$_SESSION['admin_id']."',

'$athlete_id',

'Status Updated To $status'

)"

);

/*
=====================================================
MAIL SUBJECT
=====================================================
*/

$subject =

"Sports Club Management - Application Status Update";

/*
=====================================================
STATUS COLOR
=====================================================
*/

$statusBg =
'#fff3cd';

$statusColor =
'#856404';

if($status == 'Approved'){

$statusBg =
'#d1e7dd';

$statusColor =
'#0f5132';

}

if($status == 'Rejected'){

$statusBg =
'#f8d7da';

$statusColor =
'#842029';

}

/*
=====================================================
EMAIL TEMPLATE
=====================================================
*/

$message = '

<div
style="

background:#eef2f7;
padding:40px 20px;

font-family:
Segoe UI,
sans-serif;

">

<div
style="

max-width:720px;
margin:auto;

background:#ffffff;

border-radius:28px;

overflow:hidden;

box-shadow:
0 10px 35px rgba(0,0,0,0.08);

">

<!-- =====================================
HEADER
===================================== -->

<div
style="

background:
linear-gradient(
135deg,
#000052,
#001a78,
#0028c8
);

padding:42px;

text-align:center;

color:#ffffff;

">

<div
style="

width:86px;
height:86px;

margin:auto;

border-radius:24px;

background:#0ff0fc;

display:flex;
align-items:center;
justify-content:center;

font-size:32px;
font-weight:900;

color:#000052;

box-shadow:
0 0 26px rgba(15,240,252,0.35);

">

SCM

</div>

<h1
style="

margin-top:22px;

font-size:34px;

font-weight:900;

letter-spacing:0.08em;

text-transform:uppercase;

">

Sports Club Management

</h1>

<p
style="

margin-top:10px;

font-size:14px;

letter-spacing:0.06em;

color:rgba(255,255,255,0.78);

">

Official Athlete Registration System

</p>

</div>

<!-- =====================================
BODY
===================================== -->

<div
style="

padding:40px;

">

<h2
style="

margin-top:0;

font-size:28px;

font-weight:900;

color:#000052;

">

Hello '.$athlete['full_name'].',

</h2>

<p
style="

font-size:15px;

line-height:1.9;

color:#41424C;

margin-top:20px;

">

Your athlete registration application status has been updated successfully by the Sports Club Management administration team.

</p>

<!-- =====================================
STATUS BOX
===================================== -->

<div
style="

margin-top:30px;

background:#f8f9fc;

border-radius:22px;

padding:28px;

border:1px solid #e5e7eb;

">

<table
width="100%"
cellpadding="0"
cellspacing="0">

<tr>

<td
style="

padding:14px 0;

font-size:13px;

font-weight:700;

color:#6b7280;

text-transform:uppercase;

letter-spacing:0.05em;

">

Application Number

</td>

<td
align="right"
style="

font-size:15px;

font-weight:900;

color:#000052;

">

'.$athlete['registration_no'].'

</td>

</tr>

<tr>

<td
style="

padding:14px 0;

font-size:13px;

font-weight:700;

color:#6b7280;

text-transform:uppercase;

letter-spacing:0.05em;

">

Current Status

</td>

<td
align="right">

<span
style="

display:inline-block;

padding:10px 22px;

border-radius:999px;

background:'.$statusBg.';

font-size:12px;

font-weight:900;

letter-spacing:0.08em;

text-transform:uppercase;

color:'.$statusColor.';

border:1px solid rgba(0,0,0,0.06);

">

'.$status.'

</span>

</td>

</tr>

<tr>

<td
style="

padding:14px 0;

font-size:13px;

font-weight:700;

color:#6b7280;

text-transform:uppercase;

letter-spacing:0.05em;

">

Updated On

</td>

<td
align="right"
style="

font-size:14px;

font-weight:700;

color:#111827;

">

'.date('d M Y h:i A').'

</td>

</tr>

</table>

</div>

<!-- =====================================
INFO BOX
===================================== -->

<div
style="

margin-top:30px;

background:
rgba(15,240,252,0.08);

padding:24px;

border-radius:18px;

border-left:5px solid #0ff0fc;

">

<p
style="

margin:0;

font-size:14px;

line-height:1.9;

color:#1f2937;

">

Please keep your application number safe for future reference. You may contact the administration team for any verification or registration related support.

</p>

</div>

<!-- =====================================
FOOTER TEXT
===================================== -->

<p
style="

margin-top:35px;

font-size:14px;

line-height:1.9;

color:#6b7280;

">

Thank you for registering with the official Sports Club Management System.

</p>

</div>

<!-- =====================================
FOOTER
===================================== -->

<div
style="

background:#000052;

padding:28px;

text-align:center;

color:rgba(255,255,255,0.78);

font-size:12px;

line-height:1.8;

">

<strong
style="

display:block;

font-size:15px;

margin-bottom:8px;

color:#0ff0fc;

letter-spacing:0.06em;

text-transform:uppercase;

">

Sports Club Management System

</strong>

This is an automated email from the official athlete registration platform.

</div>

</div>

</div>

';

/*
=====================================================
SEND MAIL
=====================================================
*/

sendMail(

$athlete['email'],

$subject,

$message

);

/*
=====================================================
REDIRECT
=====================================================
*/

header(

"Location: athlete-view.php?id=".$athlete_id

);

exit;

}

/*
=====================================================
FAILED
=====================================================
*/

else{

echo "

<div style='
padding:40px;
font-family:sans-serif;
'>

<h2 style='color:red;'>

Update Failed

</h2>

</div>

";

}

}

?>