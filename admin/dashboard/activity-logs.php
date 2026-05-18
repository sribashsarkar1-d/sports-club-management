<?php

include '../../config/session.php';

include '../../config/database.php';

$query = mysqli_query(

$conn,

"SELECT *

FROM activity_logs

ORDER BY log_id DESC"

);

?>

<!DOCTYPE html>
<html>

<head>

<title>
Activity Logs
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

Activity Logs

</h2>

<div class="card shadow">

<div class="card-body">

<table class="table table-bordered">

<thead>

<tr>

<th>ID</th>
<th>Activity</th>
<th>Date</th>

</tr>

</thead>

<tbody>

<?php while(
$row = mysqli_fetch_assoc($query)
){ ?>

<tr>

<td>

<?php echo $row['log_id']; ?>

</td>

<td>

<?php echo $row['action_performed']; ?>

</td>

<td>

<?php echo $row['action_time']; ?>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

<script src="../assets/js/admin-script.js"></script>

</body>
</html>