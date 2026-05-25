<?php
$activePage = 'roles';
include '../../config/session.php';
include '../../config/database.php';

if(!isset($_SESSION['admin_id'])){
    header("Location: ../auth/login.php");
    exit;
}

if($_SESSION['admin_role'] !== 'Super Admin'){
    echo "<script>alert('Access Denied. Only Super Admins can manage roles.'); window.location.href='../dashboard/index.php';</script>";
    exit;
}

$query = mysqli_query(
    $conn,
    "SELECT * FROM admin_users ORDER BY admin_id DESC"
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles & Access — Sports Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin-style.css">
    <style>
        .page-actions { margin-left: auto; display: flex; gap: 10px; }
        .btn-primary { background: var(--primary-color, #000052); color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; font-weight: 500; }
    </style>
</head>

<body>
<?php include '../layouts/sidebar.php'; ?>
<?php include '../layouts/navbar.php'; ?>

<div class="main-content">
<div class="page-body">

    <div class="dash-header">
        <div class="dash-header-left">
            <h1>Roles & Access</h1>
            <p>Manage system users, roles, and permissions</p>
        </div>
        <div class="page-actions">
            <a href="create_user.php" class="btn-primary">
                <i class="bi bi-person-plus"></i> Add User
            </a>
        </div>
    </div>

    <div class="table-card">
        <div class="table-card-header">
            <span class="table-card-title">
                <i class="bi bi-shield-lock"></i> System Users
            </span>
        </div>

        <div class="athletes-table-wrap">
            <table class="athletes-table" id="dataTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Last Login</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(mysqli_num_rows($query) > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($query)): ?>
                    <tr class="athlete-row">
                        <td>#<?php echo $row['admin_id']; ?></td>
                        <td><strong><?php echo htmlspecialchars($row['full_name']); ?></strong></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td>
                            <span class="status-badge status-badge--approved" style="background: #e0f2fe; color: #0369a1;">
                                <?php echo htmlspecialchars($row['role']); ?>
                            </span>
                        </td>
                        <td><?php echo $row['last_login'] ? date('d M Y, h:i A', strtotime($row['last_login'])) : 'Never'; ?></td>
                        <td>
                            <a href="edit_user.php?id=<?php echo $row['admin_id']; ?>" class="btn-view">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 30px;">No users found.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
</div>

<script src="../assets/js/admin-script.js"></script>
</body>
</html>
