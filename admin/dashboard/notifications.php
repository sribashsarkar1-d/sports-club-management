<?php

include '../../config/session.php';

include '../../config/database.php';

$query = mysqli_query(

$conn,

"SELECT *

FROM activity_logs

ORDER BY log_id DESC

LIMIT 20"

);

?>

<!DOCTYPE html>
<html>

<head>

<title>
Notifications
</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<link rel="stylesheet"
href="../assets/css/admin-style.css">

</head>

<body>

<?php include '../layouts/sidebar.php'; ?>

<?php include '../layouts/navbar.php'; ?>

<div class="main-content">

<h2 class="mb-4">

Notifications

</h2>

<div class="card shadow">

<div class="card-body">

<?php while(
$row = mysqli_fetch_assoc($query)
){ ?>

<div class="alert alert-info">

<?php echo $row['activity']; ?>

<br>

<small>

<?php echo $row['created_at']; ?>

</small>

</div>

<?php } ?>

</div>

</div>

</div>

<script src="../assets/js/admin-script.js"></script>

</body>
</html>