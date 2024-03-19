<?php
$page_title = "Register";
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        require 'views/register.view.php';
        break;
    case 'POST':
        $config = require "config.php";
        require "Database.php";
        $db = new Database($config);
        $user = $db->execute("SELECT * FROM users WHERE username = :username", [":username" => $_POST['username']]);
        $errors = validateInput($_POST['username'], $_POST['password'], $_POST['email'], $_POST['password_confirmation'], $user);
        if (!empty($errors)) {
            // Store the error messages in the session and redirect back to the register page
            session_start();
            require 'views/register.view.php';
            exit();
        }
        $db->execute("INSERT INTO users (username, password, email, permission_level) VALUES (:username, :password, :email, :permission_level)", [
            ":username" => $_POST['username'],
            ":password" => password_hash($_POST['password'], PASSWORD_DEFAULT),
            ":email" => $_POST['email'],
            ":permission_level" => 0
        ]);
        header("Location: /login");
        break;
    default:
        header("Location: /register");
        break;
}

function validateInput($username, $password, $email, $password_confirmation, $user): array {
    $errors = [];
    if (strlen($username) < 3) {
        $errors['username'][] = "❌ Username must be at least 3 characters long.";
    }
    if (strlen($password) < 8) {
        $errors['password'][] = "❌ Password must be at least 8 characters long.";
    }
    if (!preg_match('/[A-Z]/', $password)) {
        $errors['password'][] = "❌ Password must contain at least one capital letter.";
    }
    if (!preg_match('/[\W]/', $password)) {
        $errors['password'][] = "❌ Password must contain at least one symbol.";
    }
    if ($password !== $password_confirmation) {
        $errors['confirm_password'][] = "❌ Passwords do not match.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'][] = "❌ Invalid email address.";
    }
    if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
        $errors['all'][] = "❌ All fields are required";
    }
    if ($user) {
        $errors['username'][] = "❌ Username already exists";
    }
    return $errors;
}