<?php

$config = require "config.php";
require "Database.php";
$page_title = "Book";
$db = new Database($config);

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['name'])) {
            $book = $db->execute("SELECT books.*, authors.name AS author_name FROM books 
                                  INNER JOIN authors ON books.author_id = authors.id 
                                  WHERE books.name = :name", [":name" => ucwords($_GET['name'])]);
            if ($book) {
                $book = $book[0];
                require 'views/book.view.php';
            } else {
                require 'views/404.view.php';
            }
        } else {
            require 'views/404.view.php';
        }
        break;
    default:
        require 'views/404.view.php';
        break;
}