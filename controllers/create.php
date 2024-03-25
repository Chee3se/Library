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
        $errors = validateInput($_POST['name'], $_POST['author_id'], $_POST['image_url'], $_POST['release_date'], $_POST['availability'], $_POST['about'], $_POST['count']);
        if (!empty($errors)) {
            $authors = $db->execute("SELECT * FROM authors", []);
            require 'views/create.view.php';
            exit();
        }
        if ($_SESSION['user']['permission_level'] ?? 0 > 0) {
            $db->execute("INSERT INTO books (name, author_id, image_url, release_date, availability, count, about) VALUES (:name, :author_id, :image_url, :release_date, :availability, :count, :about)", [
                ":name" => $_POST['name'],
                ":author_id" => $_POST['author_id'],
                ":image_url" => $_POST['image_url'],
                ":release_date" => $_POST['release_date'],
                ":availability" => $_POST['availability'],
                ":about" => $_POST['about'],
                ":count" => $_POST['count']
            ]);
        }
        header("Location: /books");
        break;
    default:
        header("Location: /books");
        break;
}

function validateInput($name, $author_id, $image, $release, $availability, $about, $count): array {
    $errors = [];
    if (strlen($name) < 3) {
        $errors['name'][] = "❌ Name must be at least 3 characters long.";
    }
    if (empty($author_id)) {
        $errors['author_id'][] = "❌ Author is required.";
    }
    if (empty($image)) {
        $errors['image_url'][] = "❌ Image URL is required.";
    }
    if (empty($release)) {
        $errors['release_date'][] = "❌ Release date is required.";
    }
    if (empty($availability)) {
        $errors['availability'][] = "❌ Availability is required.";
    }
    if (empty($about)) {
        $errors['about'][] = "❌ About is required.";
    }
    if (empty($count)) {
        $errors['count'][] = "❌ Count is required.";
    }
    return $errors;
}