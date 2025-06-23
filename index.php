<?php
// File: index.ph
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



require_once 'classes/Auth.php';
require_once 'classes/User.php';
require_once 'classes/Profile.php';

$auth = new Auth();
if (isset($_POST['login'])) {
    $auth->login($_POST['username'], $_POST['password']);
}

if (isset($_GET['logout'])) {
    $auth->logout();
}

if ($auth->isAuthenticated()) {
    $user = $auth->getUser();
    // Ensure 'page' is set BEFORE index.php if coming from a wrapper
    $page = $_GET['page'] ?? basename($_SERVER['SCRIPT_NAME'], '.php');

    // Avoid double-inclusion if script was already directly executed
    if (basename(__FILE__) !== basename($_SERVER['SCRIPT_FILENAME'])) {
        return;
    }
   
    if ($page === 'manage_accounts' && $user['role'] === 'superadmin') {
        include 'manage_accounts.php';
    } elseif ($page === 'edit_account') {
        include 'edit_account.php';
    } else {
        include 'templates/dashboard.php';
    }
} else {
    include 'templates/login.php';
}
