<?php
// File: classes/Auth.php
require_once 'Database.php';
require_once 'User.php';

class Auth {
    public function login($username, $password) {
        $user = User::findByUsername($username);
        if ($user && password_verify($password, $user['password']) && $user['status'] === 'active') {
            $_SESSION['user_id'] = $user['id'];
            return true;
        }
        echo "<script>alert('Invalid credentials or deactivated account.');</script>";
        return false;
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit;
    }
    

    public function isAuthenticated() {
        return isset($_SESSION['user_id']);
    }

    public function getUser() {
        if ($this->isAuthenticated()) {
            return User::findById($_SESSION['user_id']);
        }
        return null;
    }
}
