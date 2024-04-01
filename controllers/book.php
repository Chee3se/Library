<?php
$config = require base_path("config.php");
$db = new Database($config);
if (isset($_GET['name'])) {
    $book = $db->execute("SELECT books.*, authors.name AS author_name FROM books 
                                  INNER JOIN authors ON books.author_id = authors.id 
                                  WHERE books.name = :name", [":name" => ucwords($_GET['name'])]);
    if ($book) {
        $book = $book[0];
        view('book', [
            "book" => $book,
            "page_title" => $book['name']
        ]);
    } else {
        view('404', []);
    }
} else {
    view('404', []);
}