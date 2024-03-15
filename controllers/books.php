<?php 

$config = require "config.php";
require "Database.php";
$page_title = "Books";

$db = new Database($config);

$query_string = "SELECT books.name AS name, authors.name AS author, books.image_url, books.release_date, books.availability, books.id FROM books JOIN authors ON books.author_id = authors.id";
$params = [];

// Send querry
$books = $db->execute($query_string, $params);

require "views/books.view.php";