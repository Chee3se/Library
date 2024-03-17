<?php

$page_title = "Create book";

$config = require "config.php";
require "Database.php";
$db = new Database($config);

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $authors = $db->execute("SELECT * FROM authors", []);
        require 'views/create.view.php';
        break;
    case 'POST':
        session_start();
        if ($_SESSION['user']['permission_level'] ?? 0 > 0) {
            $db->execute("INSERT INTO books (name, author_id, image_url, release_date, availability, about) VALUES (:name, :author_id, :image_url, :release_date, :availability, :about)", [
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