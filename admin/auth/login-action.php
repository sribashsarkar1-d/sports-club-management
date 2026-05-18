<?php

include '../../config/database.php';

include '../../config/session.php';

include '../../config/smtp.php';

/*
=====================================================
ADMIN LOGIN
=====================================================
*/

if(isset($_POST['admin_login'])){

/* =====================================================
INVALID PASSWORD
===================================================== */

header(
"Location: login.php?error=wrong_password"
);

exit;

/* =====================================================
ADMIN NOT FOUND
===================================================== */

header(
"Location: login.php?error=user_not_found"
);

exit;
/*
=====================================================
GET FORM DATA
=====================================================
*/

$email =

mysqli_real_escape_string(

$conn,

$_POST['email']

);

$password =

mysqli_real_escape_string(

$conn,

$_POST['password']

);

/*
=====================================================
CHECK ADMIN
=====================================================
*/

$select =

"SELECT *

FROM admin_users

WHERE email='$email'

LIMIT 1";

$query =

mysqli_query(

$conn,

$select

);

/*
=====================================================
ADMIN FOUND
=====================================================
*/

if(mysqli_num_rows($query) > 0){

$admin =
mysqli_fetch_assoc($query);

/*
=====================================================
PASSWORD VERIFY
=====================================================
*/

if(password_verify($password, $admin['password'])){

/*
=====================================================
SESSION
=====================================================
*/

$_SESSION['admin_id'] =
$admin['admin_id'];

$_SESSION['admin_name'] =
$admin['full_name'];

$_SESSION['admin_email'] =
$admin['email'];

/*
=====================================================
UPDATE LAST LOGIN
=====================================================
*/

mysqli_query(

$conn,

"UPDATE admin_users

SET last_login = NOW()

WHERE admin_id='".$admin['admin_id']."'"

);

/*
=====================================================
LOGIN DETAILS
=====================================================
*/

$loginTime =
date('d M Y h:i A');

$ipAddress =
$_SERVER['REMOTE_ADDR'] ?? 'Unknown';

$browser =
$_SERVER['HTTP_USER_AGENT'] ?? 'Unknown Device';

/*
=====================================================
MAIL SUBJECT
=====================================================
*/

$subject =
"Sports Club Management - Admin Login Alert";

/*
=====================================================
PREMIUM EMAIL TEMPLATE
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

Admin Security Login Notification

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

Hello '.$admin['full_name'].',

</h2>

<p
style="

font-size:15px;

line-height:1.9;

color:#41424C;

margin-top:20px;

">

A successful administrator login was detected in your Sports Club Management account.

</p>

<!-- =====================================
LOGIN DETAILS
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

Login Time

</td>

<td
align="right"
style="

font-size:15px;

font-weight:900;

color:#000052;

">

'.$loginTime.'

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

IP Address

</td>

<td
align="right"
style="

font-size:14px;

font-weight:700;

color:#111827;

">

'.$ipAddress.'

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

Browser / Device

</td>

<td
align="right"
style="

font-size:13px;

font-weight:700;

color:#111827;

word-break:break-word;

">

'.$browser.'

</td>

</tr>

</table>

</div>

<!-- =====================================
SECURITY MESSAGE
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

If this login activity was not performed by you, please change your administrator password immediately and contact the system administrator.

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

Thank you for using the official Sports Club Management administration system.

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

This is an automated security notification from the official administration platform.

</div>

</div>

</div>

';

/*
=====================================================
SEND EMAIL
=====================================================
*/

sendMail(

$admin['email'],

$subject,

$message

);

/*
=====================================================
REDIRECT
=====================================================
*/

header(

"Location: ../dashboard/index.php"

);

exit;

}

/*
=====================================================
INVALID PASSWORD
=====================================================
*/

else{

echo "

<div style='
padding:40px;
font-family:sans-serif;
'>

<h2 style='color:red;'>

Invalid Password

</h2>

</div>

";

}

}

/*
=====================================================
ADMIN NOT FOUND
=====================================================
*/

else{

echo "

<div style='
padding:40px;
font-family:sans-serif;
'>

<h2 style='color:red;'>

Admin Not Found

</h2>

</div>

";

}

}

?>