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
        if ($user) {
            header("Location: /register");
        } else {
            $db->execute("INSERT INTO users (username, password, email, permission_level) VALUES (:username, :password, :email, :permission_level)", [
                ":username" => $_POST['username'],
                ":password" => password_hash($_POST['password'], PASSWORD_DEFAULT),
                ":email" => $_POST['email'],
                ":permission_level" => 0
            ]);
            header("Location: /login");
        }
        break;
    default:
        header("Location: /register");
        break;
}