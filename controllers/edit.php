<?php

$page_title = "Edit book";

$config = require "config.php";
require "Database.php";
$db = new Database($config);

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $book = $db->execute("SELECT * FROM books WHERE id = :id", [":id" => $_GET['id']])[0];
        require 'views/edit.view.php';
        break;
    case 'POST':
        $db->execute("UPDATE books SET name=:name, author=:author, release_date=:release_date, availability=:availability WHERE id=:id", [
            ":id" => $_POST['id'],
            ":name" => $_POST['name'],
            ":author" => $_POST['author'],
            ":release_date" => $_POST['release_date'],
            ":availability" => $_POST['availability']
        ]);
        header("Location: /books");
        break;
    default:
        header("Location: /books");
        break;
}