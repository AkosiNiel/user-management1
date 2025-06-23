<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | MyApp</title>
    <link rel="stylesheet" href="../css/dashboard.css">
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

<div class="main-container">
    <div class="info-alert">
        Hello <strong><?= htmlspecialchars($user['username']) ?></strong>, welcome to your dashboard.
    </div>
</div>

</body>
</html>
