<?php

include '../../config/session.php';

include '../../config/database.php';

$query = mysqli_query(

$conn,

"SELECT *

FROM athletes

WHERE athlete_status='Approved'

ORDER BY athlete_id DESC"

);

?>

<!DOCTYPE html>
<html>

<head>

<title>
Approved Athletes
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

<h2 class="mb-4 text-success">

Approved Athletes

</h2>

<div class="card shadow">

<div class="card-body">

<table class="table table-bordered">

<thead>

<tr>

<th>ID</th>
<th>Name</th>
<th>Mobile</th>
<th>Email</th>
<th>Status</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php while(
$row = mysqli_fetch_assoc($query)
){ ?>

<tr>

<td>

<?php echo $row['athlete_id']; ?>

</td>

<td>

<?php echo $row['full_name']; ?>

</td>

<td>

<?php echo $row['mobile']; ?>

</td>

<td>

<?php echo $row['email']; ?>

</td>

<td>

<span class="badge bg-success">

Approved

</span>

</td>

<td>

<a href="athlete-view.php?id=<?php
echo $row['athlete_id'];
?>"

class="btn btn-primary btn-sm">

View

</a>

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