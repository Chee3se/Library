<?php

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $page_title = "Create author";

        require "views/author.view.php";
        break;
    case 'POST':
        $config = require "config.php";
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
