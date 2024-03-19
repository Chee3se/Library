<?php
$page_title = "Login";
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        require 'views/login.view.php';
        break;
    case 'POST':
        $config = require "config.php";
        require "Database.php";
        $db = new Database($config);

        $user = $db->execute("SELECT * FROM users WHERE username = :username", [":username" => $_POST['username']])[0] ?? null;
        if ($user && password_verify($_POST['password'], $user['password'])) {
            session_start();
            $_SESSION['user'] = $user;
            header("Location: /books");
        } else {
            $error = "❌ Invalid username or password";
            require 'views/login.view.php';
        }
        break;
    default:
        header("Location: /login");
        break;
}
