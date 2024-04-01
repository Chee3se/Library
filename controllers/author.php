<?php

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        view('author', [
            "page_title" => "Create author",
        ]);
        break;
    case 'POST':
        $config = require base_path("config.php");
        require "Database.php";
        $db = new Database($config);

        session_start();
        if ($_SESSION['user']['permission_level'] ?? 0 > 0) {
            $db->execute("INSERT INTO authors (name) VALUES (:name)", [
                ":name" => $_POST['name'],
            ]);
        }
        header("Location: /books");
        break;
    default:
        header("Location: /books");
        break;
}
