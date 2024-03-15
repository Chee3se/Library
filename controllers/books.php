<?php 

$config = require "config.php";
require "Database.php";
$page_title = "Books";

$db = new Database($config);

$query_string = "SELECT * FROM books";
$params = [];

// Send querry
$books = $db->execute($query_string, $params);

require "views/books.view.php";