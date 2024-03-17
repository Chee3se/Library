<?php
// return.php
session_start();
$page_title = "Return book";

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to the login page
    header("Location: /login");
    exit();
}

$config = require "config.php";
require "Database.php";
$db = new Database($config);

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        // Check if the user has borrowed any books
        $borrowed_books = $db->execute("SELECT * FROM borrowed_books WHERE user_id = :user_id AND status = 'borrowing'", [":user_id" => $_SESSION['user']['id']]);
        if (empty($borrowed_books)) {
            // If the user hasn't borrowed any books, redirect them to /books
            header("Location: /books");
            exit();
        }

        // Get the details of the borrowed books from the books table
        $books = [];
        foreach ($borrowed_books as $borrowed_book) {
            $book = $db->execute("SELECT * FROM books WHERE id = :id", [":id" => $borrowed_book['book_id']]);
            if ($book) {
                $books[] = $book[0];
            }
        }

        require 'views/return.view.php';
        break;
    case 'POST':
        // Get the book ID from the POST data
        $book_id = $_POST['book_id'];

        // Update the borrowed_books table to mark the book as returned and change the status to 'returned'
        $db->execute("UPDATE borrowed_books SET status = 'returned' WHERE book_id = :book_id AND user_id = :user_id", [
            ":book_id" => $book_id,
            ":user_id" => $_SESSION['user']['id']
        ]);

        // Update the books table to mark the book as available
        $db->execute("UPDATE books SET availability = 1 WHERE id = :id", [":id" => $book_id]);

        $message = "Book returned successfully!";
        require 'views/message.view.php';
        break;
    default:
        header("Location: /books");
        break;
}