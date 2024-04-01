<?php
// return.php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to the login page
    header("Location: /login");
    exit();
}

$config = require base_path("config.php");
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
                $books[$borrowed_book['id']] = $book[0];
            }
        }

        view('return', [
            "borrowed_books" => $borrowed_books,
            "books" => $books,
            "page_title" => "Return book"
        ]);
        break;
    case 'POST':
        // Get the book ID from the POST data
        $borrowed_books_id = $_POST['borrowed_books_id'];

        // Update the borrowed_books table to mark the book as returned and change the status to 'returned'
        $db->execute("UPDATE borrowed_books SET status = 'returned' WHERE id = :id AND user_id = :user_id", [
            ":id" => $borrowed_books_id,
            ":user_id" => $_SESSION['user']['id']
        ]);

        $borrowed_book = $db->execute("SELECT * FROM borrowed_books WHERE id = :id", [":id" => $borrowed_books_id])[0];

        // Update the books table to up the book count
        $db->execute("UPDATE books SET count = count + :count, availability = 'Available' WHERE id = :id", [":id" => $borrowed_book['book_id'], ":count" => $borrowed_book['count']]);

        view('message', [
            "message" => "Book returned successfully!"
        ]);
        break;
    default:
        header("Location: /books");
        break;
}