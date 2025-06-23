<?php
// File: templates/create_user.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$_GET['page'] = 'create_user';
require_once 'index.php';
require_once 'auth_guard.php';

require_once 'classes/User.php';
require_once 'classes/Profile.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userData = [
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'role' => 'user',
        'status' => $_POST['status'] ?? 'deactivate'
    ];

    if ($_POST['password'] !== $_POST['repassword']) {
        $error = "Passwords do not match.";
    } elseif (User::create($userData)) {
        $user = User::findByUsername($userData['username']);
        Profile::create($user['id'], $_POST);
        header("Location: manage_accounts.php?created=success");
        exit;
    } else {
        $error = "Failed to create user.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">MyApp</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Dashboard</a>
                    </li>
                    <?php if ($user['role'] === 'superadmin'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="manage_accounts.php">Manage Accounts</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="edit_account.php?user_id=<?= htmlspecialchars($user['id']) ?>">Edit Personal Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?logout=1">Logout</a>
                    </li>
                </ul>
                <span class="navbar-text text-white">
                    Welcome, <?= htmlspecialchars($user['username']) ?>
                </span>
            </div>
        </div>
</nav>
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Create User</h3>
            <a href="manage_accounts.php" class="text-decoration-none">&larr; Back to User List</a>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger mt-2"><?= $error ?></div>
            <?php endif; ?>
            <form method="POST">
                <fieldset class="border p-3 mb-3">
                    <legend class="w-auto px-2">User Account</legend>
                    <div class="mb-3">
                        <label>Username:</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Password:</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Retype Password:</label>
                        <input type="password" name="repassword" class="form-control" required>
                    </div>
                </fieldset>

                <fieldset class="border p-3 mb-3">
                    <legend class="w-auto px-2">User Profile</legend>
                    <div class="mb-3">
                        <label>First Name:</label>
                        <input type="text" name="firstname" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Middle Name:</label>
                        <input type="text" name="middlename" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Last Name:</label>
                        <input type="text" name="lastname" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Address:</label>
                        <input type="text" name="address" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Company:</label>
                        <input type="text" name="company" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Contact Number:</label>
                        <input type="text" name="contact_number" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Position:</label>
                        <input type="text" name="position" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Status:</label>
                        <select name="status" class="form-select">
                            <option value="active">Active</option>
                            <option value="deactivate">Deactivated</option>
                        </select>
                    </div>
                </fieldset>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Save User</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
