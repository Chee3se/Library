<?php 

$config = require "config.php";
require "Database.php";
$page_title = "Books";
$db = new Database($config);

if (isset($_GET['name'])) {
    $query_string = "SELECT books.name AS name, authors.name AS author, books.image_url, books.release_date, books.availability, books.id FROM books JOIN authors ON books.author_id = authors.id WHERE books.name LIKE :name";
    $params = [":name" => "%" . $_GET['name'] . "%"];
    $books = $db->execute($query_string, $params);
} else if (isset($_GET['author'])) {
    $query_string = "SELECT books.name AS name, authors.name AS author, books.image_url, books.release_date, books.availability, books.id FROM books JOIN authors ON books.author_id = authors.id WHERE authors.name LIKE :author";
    $params = [":author" => "%" . $_GET['author'] . "%"];
    $books = $db->execute($query_string, $params);
} else {
    $query_string = "SELECT books.name AS name, authors.name AS author, books.image_url, books.release_date, books.availability, books.id FROM books JOIN authors ON books.author_id = authors.id";
    $params = [];
    $books = $db->execute($query_string, $params);
}

require "views/books.view.php";