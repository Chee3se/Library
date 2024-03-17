<?php

$page_title = "Edit book";

$config = require "config.php";
require "Database.php";
$db = new Database($config);

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $book = $db->execute("SELECT * FROM books WHERE id = :id", [":id" => $_GET['id']])[0];
        $authors = $db->execute("SELECT * FROM authors", []);
        require 'views/edit.view.php';
        break;
    case 'POST':
        session_start();
        if ($_SESSION['user']['permission_level'] ?? 0 > 0) {
            $db->execute("UPDATE books SET name=:name, author_id=:author_id, image_url=:image_url, release_date=:release_date, availability=:availability, about=:about WHERE id=:id", [
                ":id" => $_POST['id'],
                ":name" => $_POST['name'],
                ":author_id" => $_POST['author_id'],
                ":image_url" => $_POST['image_url'],
                ":release_date" => $_POST['release_date'],
                ":availability" => $_POST['availability'],
                ":about" => $_POST['about']
            ]);
        }
        header("Location: /books");
        break;
    default:
        header("Location: /books");
        break;
}