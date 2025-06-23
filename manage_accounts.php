<?php

// File: /exam/manage_accounts.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$_GET['page'] = 'manage_accounts';
require_once 'index.php';
require_once 'auth_guard.php';


// File: templates/manage_accounts.php
require_once 'classes/User.php';

if (!isset($user) || $user['role'] !== 'superadmin') {
    header('Location: index.php');
    exit;
}

$users = User::getAllExcept($user['id']);


?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Accounts</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
</head>
<body>
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
                        <li class="nav-item">
                            <a class="nav-link" href="create_user.php">Add User</a>
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
    <h3>Manage User Accounts</h3>
    <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 'success'): ?>
        <div class="alert alert-success">User deleted successfully.</div>
    <?php elseif (isset($_GET['created']) && $_GET['created'] == 'success'): ?>
        <div class="alert alert-success">User Created successfully.</div>
    <?php elseif (isset($_GET['deleted']) && $_GET['deleted'] == 'error'): ?>
        <div class="alert alert-danger">Failed to delete user.</div>
    <?php endif; ?>

    <table id="userTable" class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $u): ?>
            <tr>
                <td><?= $u['id'] ?></td>
                <td><?= htmlspecialchars($u['username']) ?></td>
                <td><?= htmlspecialchars($u['email']) ?></td>
                <td><?= $u['role'] ?></td>
                <td>
                    <form method="POST" action="toggle_status.php">
                        <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
                        <div class="form-check form-switch">
                            <input 
                                class="form-check-input" 
                                type="checkbox" 
                                name="status" 
                                value="active"
                                <?= $u['status'] === 'active' ? 'checked' : '' ?>
                                onchange="this.form.submit()">
                            <label class="form-check-label">
                                <?= $u['status'] === 'active' ? 'Active' : 'Deactivated' ?>
                            </label>
                        </div>
                    </form>
                </td>

                <td>
                    <button class="btn btn-primary btn-sm edit-btn" data-id="<?= $u['id'] ?>">Edit</button>
                    <button class="btn btn-danger btn-sm delete-btn" data-id="<?= $u['id'] ?>">Delete</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>

    </table>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this user?
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="POST" action="delete_user.php">
                    <input type="hidden" name="user_id" id="deleteUserId">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('#userTable').DataTable();

        $('.edit-btn').on('click', function () {
            const userId = $(this).data('id');
            window.location.href = 'edit_account.php?user_id=' + userId;
        });

        $('.delete-btn').on('click', function () {
            const userId = $(this).data('id');
            $('#deleteUserId').val(userId);
            const modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
            modal.show();
        });
    });
</script>
</body>
</html>
