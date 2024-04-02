<?php
// checkout.php
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
        get([]);
        break;
    case 'POST':
        // Get the book IDs from the cookie
        $book_ids = isset($_COOKIE['book_ids']) ? unserialize($_COOKIE['book_ids']) : [];

        $errors = validateInput($_POST['return_date'], $book_ids);
        if (!empty($errors)) {
            get($errors);
            exit();
        }

        // If there are books in the cookie
        if (!empty($book_ids) && isset($_POST['return_date'])) {
            $borrow_date = date("Y-m-d");

            // Add each book to the borrowed_books table
            foreach ($book_ids as $book_id) {
                // Check if the book is available
                $book = $db->execute("SELECT * FROM books WHERE id = :id AND availability = 'Available'", [":id" => $book_id]);
                if ($book) {
                    $count = $_POST['count'][$book_id] ?? 0;
                    $newCount = $book[0]['count'] - $count;
                    $availability = $newCount > 0 ? 'Available' : 'Not Available';
                    $db->execute("INSERT INTO borrowed_books (user_id, book_id, count, borrow_date, return_date, status) VALUES (:user_id, :book_id, :count, :borrow_date, :return_date, 'borrowing')", [
                        ":user_id" => $_SESSION['user']['id'],
                        ":book_id" => $book_id,
                        ":count" => $count,
                        ":borrow_date" => $borrow_date,
                        ":return_date" => $_POST['return_date']
                    ]);
                    $db->execute("UPDATE books SET count = :count, availability = :availability WHERE id = :id", [":count" => $newCount, ":availability" => $availability, ":id" => $book_id]);
                }
            }

            // Clear the book_ids cookie
            setcookie("book_ids", "", time() - 3600);
            view('message', [
                "message" => "Books borrowed successfully!"
            ]);
        }
        break;
    default:
        header("Location: /books");
        break;
}

function validateInput($return_date, $book_ids): array {
    $errors = [];
    if (empty($return_date)) {
        $errors[] = "❌ Return date is required";
    }
    if (strtotime($return_date) < strtotime(date("Y-m-d") . "+3 days")) {
        $errors[] = "❌ Return date must be in the future (at least 3 days from today)";
    }
    if (empty($book_ids)) {
        $errors[] = "❌ No books in cart!";
    }
    return $errors;
}

function get($errs) {
    $page_title = "Checkout";
    $errors = $errs ?? [];
    $config = require base_path("config.php");
    $db = new Database($config);
    // Get the book IDs from the cookie
    $book_ids = isset($_COOKIE['book_ids']) ? unserialize($_COOKIE['book_ids']) : [];

    // If a book ID is provided in the query string, add it to the array
    if (isset($_GET['id']) && !in_array($_GET['id'], $book_ids)) {
        $book_ids[] = $_GET['id'];
        // Store the updated array back in the cookie
        setcookie("book_ids", serialize($book_ids), time() + 3600);
    }

    if (empty($book_ids)) {
        header("Location: /books");
        exit();
    }

    // Get the books from the database
    $books = [];
    foreach ($book_ids as $book_id) {
        $book = $db->execute("SELECT * FROM books WHERE id = :id", [":id" => $book_id]);
        if ($book) {
            $books[] = $book[0];
        }
    }

    view('checkout', [
        'books' => $books
    ]);
}