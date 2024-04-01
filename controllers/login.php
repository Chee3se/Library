<?php

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        view('login', [
            "page_title" => "Login"
        ]);
        break;
    case 'POST':
        $config = require base_path("config.php");
        $db = new Database($config);

        $user = $db->execute("SELECT * FROM users WHERE username = :username", [":username" => $_POST['username']])[0] ?? null;
        if ($user && password_verify($_POST['password'], $user['password'])) {
            session_start();
            $_SESSION['user'] = $user;
            header("Location: /books");
        } else {
            $error = "❌ Invalid username or password";
            view('login', [
                "error" => $error,
                "page_title" => "Login"
            ]);
        }
        break;
    default:
        header("Location: /login");
        break;
}
