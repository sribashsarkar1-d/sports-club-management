<?php

include '../../config/session.php';

include '../../config/database.php';

if(!isset($_SESSION['admin_id'])){

    header(
        "Location: ../auth/login.php"
    );
}

$query = mysqli_query(

$conn,

"SELECT

a.athlete_id,
a.full_name,
a.mobile,
a.athlete_status,

cp.age_group,
cp.competition_name

FROM athletes a

LEFT JOIN competitions cp
ON a.athlete_id = cp.athlete_id

ORDER BY a.athlete_id DESC"

);

$totalAthletes = mysqli_num_rows($query);

?>

<!DOCTYPE html>
<html>

<head>

<title>
Athlete Dashboard
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

<div class="d-flex
justify-content-between
align-items-center
mb-4">

<div>

<h2 class="fw-bold">

Athlete Management Dashboard

</h2>

<p class="text-muted mb-0">

Centralized Athlete Database View

</p>

</div>

<div>

<span class="badge bg-primary p-3">

Total Athletes :
<?php echo $totalAthletes; ?>

</span>

</div>

</div>

<!-- Search Box -->

<div class="card shadow border-0 mb-4">

<div class="card-body">

<input type="text"

id="searchInput"

class="form-control search-box"

placeholder="Search athlete by name or mobile">

</div>

</div>

<!-- Athlete Table -->

<div class="card shadow border-0">

<div class="card-body">

<div class="table-responsive">

<table class="table table-hover table-bordered align-middle">

<thead>

<tr>

<th width="80">
ID
</th>

<th>
Name
</th>

<th>
Mobile
</th>

<th>
Age Group
</th>

<th>
Competition Applied
</th>

<th>
Status
</th>

<th width="160">
Action
</th>

</tr>

</thead>

<tbody>

<?php while(
$row = mysqli_fetch_assoc($query)
){ ?>

<tr class="athlete-row">

<td>

#<?php echo $row['athlete_id']; ?>

</td>

<td>

<div class="fw-bold">

<?php echo $row['full_name']; ?>

</div>

</td>

<td>

<?php echo $row['mobile']; ?>

</td>

<td>

<?php echo $row['age_group']; ?>

</td>

<td>

<?php echo $row['competition_name']; ?>

</td>

<td>

<?php

$status =
$row['athlete_status'];

if($status == 'Approved'){

echo '

<span class="badge bg-success">

Approved

</span>

';

}elseif($status == 'Rejected'){

echo '

<span class="badge bg-danger">

Rejected

</span>

';

}else{

echo '

<span class="badge bg-warning text-dark">

Pending

</span>

';
}

?>

</td>

<td>

<a href="athlete-view.php?id=<?php
echo $row['athlete_id'];
?>"

class="btn btn-primary btn-sm">

<i class="bi bi-eye"></i>

View Profile

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</div>

<script src="../assets/js/admin-script.js"></script>

</body>
</html>