<?php
// toggle_status.php
require_once 'classes/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'] ?? null;
    $newStatus = isset($_POST['status']) && $_POST['status'] === 'active' ? 'active' : 'deactivate';

    if ($userId) {
        $user = User::findById($userId);
        if ($user) {
            $user['status'] = $newStatus;
            User::update($userId, $user);
        }
    }
}

header('Location: manage_accounts.php');
exit;
