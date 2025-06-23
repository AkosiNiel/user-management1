<?php
// File: delete_user.php
require_once 'classes/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['user_id'] ?? null;

    if ($id && User::delete($id)) {
        header('Location: index.php?page=manage_accounts&deleted=success');
    } else {
        header('Location: index.php?page=manage_accounts&deleted=error');
    }
    exit;
} else {
    header('Location: index.php');
    exit;
}
