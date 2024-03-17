<?php
// checkout.php
session_start();
$page_title = "Checkout";

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
        // Get the book IDs from the cookie
        $book_ids = isset($_COOKIE['book_ids']) ? unserialize($_COOKIE['book_ids']) : [];

        // If a book ID is provided in the query string, add it to the array
        if (isset($_GET['id']) && !in_array($_GET['id'], $book_ids)) {
            $book_ids[] = $_GET['id'];
            // Store the updated array back in the cookie
            setcookie("book_ids", serialize($book_ids), time() + 3600);
        }

        // Get the books from the database
        $books = [];
        foreach ($book_ids as $book_id) {
            $book = $db->execute("SELECT * FROM books WHERE id = :id", [":id" => $book_id]);
            if ($book) {
                $books[] = $book[0];
            }
        }

        require 'views/checkout.view.php';
        break;
    case 'POST':
        // Get the book IDs from the cookie
        $book_ids = isset($_COOKIE['book_ids']) ? unserialize($_COOKIE['book_ids']) : [];

        // If there are books in the cookie
        if (!empty($book_ids) && isset($_POST['return_date'])) {
            $return_date = $_POST['return_date'];
            $borrow_date = date("Y-m-d");

            // Add each book to the borrowed_books table
            foreach ($book_ids as $book_id) {
                // Check if the book is available
                $book = $db->execute("SELECT * FROM books WHERE id = :id AND availability = 1", [":id" => $book_id]);
                if ($book) {
                    $db->execute("INSERT INTO borrowed_books (user_id, book_id, borrow_date, return_date, status) VALUES (:user_id, :book_id, :borrow_date, :return_date, 'borrowing')", [
                        ":user_id" => $_SESSION['user']['id'],
                        ":book_id" => $book_id,
                        ":borrow_date" => $borrow_date,
                        ":return_date" => $return_date
                    ]);

                    // Update the book's availability in the books table
                    $db->execute("UPDATE books SET availability = 0 WHERE id = :id", [":id" => $book_id]);
                }
            }

            // Clear the book_ids cookie
            setcookie("book_ids", "", time() - 3600);
            $message = "Books borrowed successfully!";
            require 'views/message.view.php';
        } else {
            $message = "No books in cart!";
            require 'views/message.view.php';
        }
        break;
    default:
        header("Location: /books");
        break;
}