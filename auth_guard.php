<?php
// Proper cache prevention
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


require_once 'classes/Auth.php';
// Only redirect if user is NOT authenticated
if (!$auth->isAuthenticated()) {
    header('Location: index.php');
    exit;
}

