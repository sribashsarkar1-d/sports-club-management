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

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if(!$id) {
    header("Location: roles.php");
    exit;
}

$message = "";

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_user'])) {
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    
    // Check email logic (prevent dupes unless it's same user)
    $check = mysqli_query($conn, "SELECT email FROM admin_users WHERE email='$email' AND admin_id != $id");
    if(mysqli_num_rows($check) > 0) {
        $message = "<div class='alert alert-danger'>Email already in use.</div>";
    } else {
        $updateQuery = "UPDATE admin_users SET full_name='$full_name', email='$email', role='$role'";
        
        if(!empty($_POST['password'])) {
            $hashed = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $updateQuery .= ", password='$hashed'";
        }
        
        $updateQuery .= " WHERE admin_id=$id";
        
        if(mysqli_query($conn, $updateQuery)) {
            $message = "<div class='alert alert-success' style='background: #dcfce7; color: #166534;'>User updated successfully.</div>";
        } else {
            $message = "<div class='alert alert-danger'>Failed to update user.</div>";
        }
    }
}

$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM admin_users WHERE admin_id=$id"));
if(!$user) die("User not found.");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User — Sports Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin-style.css">
    <style>
        .card { background: white; padding: 25px; border-radius: 12px; max-width: 500px; margin: 0 auto; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .form-group { margin-bottom: 15px; }
        .form-label { display: block; margin-bottom: 5px; font-weight: 500; }
        .form-control { width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-family: inherit; }
        .btn-primary { background: var(--primary-color, #000052); color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; width: 100%; font-weight: 600; margin-top: 10px; }
        .alert { padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .alert-danger { background: #fee2e2; color: #991b1b; }
    </style>
</head>
<body>
<?php include '../layouts/sidebar.php'; ?>
<?php include '../layouts/navbar.php'; ?>

<div class="main-content">
<div class="page-body">
    <div class="dash-header">
        <div class="dash-header-left">
            <a href="roles.php" style="color: #64748b; text-decoration: none; margin-bottom: 10px; display: inline-block;">&larr; Back to Roles</a>
            <h1>Edit User: <?php echo htmlspecialchars($user['full_name']); ?></h1>
        </div>
    </div>

    <?php if($message) echo $message; ?>

    <div class="card">
        <form method="POST">
            <div class="form-group">
                <label class="form-label">Full Name</label>
                <input type="text" name="full_name" class="form-control" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
            </div>
            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="form-group">
                <label class="form-label">New Password (leave blank to keep current)</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label">Role</label>
                <select name="role" class="form-control" required>
                    <option value="Admin" <?php if($user['role']=='Admin') echo 'selected'; ?>>Admin</option>
                    <option value="Super Admin" <?php if($user['role']=='Super Admin') echo 'selected'; ?>>Super Admin</option>
                </select>
            </div>
            <button type="submit" name="update_user" class="btn-primary">Update User</button>
        </form>
    </div>
</div>
</div>
</body>
</html>
