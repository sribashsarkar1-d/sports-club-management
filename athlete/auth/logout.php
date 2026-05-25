<?php
include '../../config/session.php';

// Unset only athlete session variables
unset($_SESSION['athlete_logged_in']);
unset($_SESSION['athlete_id']);
unset($_SESSION['athlete_application_no']);

header("Location: ../../index.php");
exit;
?>
