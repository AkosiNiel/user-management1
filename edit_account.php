<?php
// File: /exam/edit_account.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$_GET['page'] = 'edit_account';
require_once 'index.php';
require_once 'auth_guard.php';

// File: templates/edit_account.php
require_once 'classes/User.php';
require_once 'classes/Profile.php';

$editingUserId = $_GET['user_id'] ?? $user['id'];
$editingUser = User::findById($editingUserId);

if (!$editingUser) {
    echo "<div class='alert alert-danger'>User not found.</div>";
    exit;
}


$profile = Profile::findByUserId($editingUserId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updated = User::update($editingUserId, [
        // 'username' => $_POST['username'],
        'email' => $_POST['email'],
        'role' => $_POST['role'] ?? $editingUser['role'],
        'status' => $_POST['status'] ?? $editingUser['status']
    ]);

    $updatedProfile = Profile::update($editingUserId, $_POST);
    $success = $updated && $updatedProfile;
    header("Location: index.php?page=edit_account&user_id={$editingUserId}&updated=" . ($success ? 'success' : 'error'));
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Account</title>
    <link rel="stylesheet" href="../css/edit_account.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<nav class="custom-navbar">
    <div class="navbar-container">
        <a class="navbar-brand" href="#">MyApp</a>
        <ul class="navbar-menu">
            <li><a href="index.php">Dashboard</a></li>
            <?php if ($user['role'] === 'superadmin'): ?>
                <li><a href="manage_accounts.php">Manage Accounts</a></li>
                <li><a href="create_user.php">Add User</a></li>
            <?php endif; ?>
            <li><a href="edit_account.php?user_id=<?= htmlspecialchars($user['id']) ?>">Edit Personal Account</a></li>
            <li><a href="?logout=1">Logout</a></li>
        </ul>
        <span class="navbar-welcome">
            Welcome, <?= htmlspecialchars($user['username']) ?>
        </span>
    </div>
</nav>

<div class="container">
    <h3>Edit Account</h3>

    <?php if (isset($_GET['updated'])): ?>
        <div class="alert <?= $_GET['updated'] === 'success' ? 'alert-success' : 'alert-danger' ?>">
            <?= $_GET['updated'] === 'success' ? 'Account updated successfully.' : 'Failed to update account.' ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-row">
            <div class="column">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" value="<?= htmlspecialchars($editingUser['username']) ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($editingUser['email']) ?>">
                </div>
                <?php if ($user['role'] === 'admin'): ?>
                    <div class="form-group">
                        <label>Role</label>
                        <select name="role">
                            <option value="admin" <?= $editingUser['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                            <option value="user" <?= $editingUser['role'] === 'user' ? 'selected' : '' ?>>User</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status">
                            <option value="active" <?= $editingUser['status'] === 'active' ? 'selected' : '' ?>>Active</option>
                            <option value="deactivate" <?= $editingUser['status'] === 'deactivate' ? 'selected' : '' ?>>Deactivate</option>
                        </select>
                    </div>
                <?php endif; ?>
            </div>

            <div class="column">
                <div class="form-group"><label>First Name</label><input type="text" name="firstname" value="<?= htmlspecialchars($profile['firstname']) ?>"></div>
                <div class="form-group"><label>Last Name</label><input type="text" name="lastname" value="<?= htmlspecialchars($profile['lastname']) ?>"></div>
                <div class="form-group"><label>Middle Name</label><input type="text" name="middlename" value="<?= htmlspecialchars($profile['middlename']) ?>"></div>
                <div class="form-group"><label>Address</label><input type="text" name="address" value="<?= htmlspecialchars($profile['address']) ?>"></div>
                <div class="form-group"><label>Company</label><input type="text" name="company" value="<?= htmlspecialchars($profile['company']) ?>"></div>
                <div class="form-group"><label>Contact Number</label><input type="text" name="contact_number" value="<?= htmlspecialchars($profile['contact_number']) ?>"></div>
                <div class="form-group"><label>Position</label><input type="text" name="position" value="<?= htmlspecialchars($profile['position']) ?>"></div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit">Update</button>
        </div>
    </form>
</div>

</body>
</html>
