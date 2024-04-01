<?php

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        session_start();
        if ($_SESSION['user']['permission_level'] ?? 0 > 0) {
            $config = require base_path("config.php");
            $db = new Database($config);
            $db->execute("DELETE FROM borrowed_books WHERE book_id=:id", [":id" => $_POST['id']]);
            $db->execute("DELETE FROM books WHERE id=:id", [":id" => $_POST['id']]);
        }
        header("Location: /books");
        break;
    default:
        header("Location: /books");
        break;
}