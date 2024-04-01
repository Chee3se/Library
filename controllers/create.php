<?php

$config = require base_path("config.php");
$db = new Database($config);

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $authors = $db->execute("SELECT * FROM authors", []);
        view('create', [
            "authors" => $authors,
            "page_title" => "Create book"
        ]);
        break;
    case 'POST':
        session_start();
        $target_dir = "uploads/";
        $target_file = base_path("/public/images/". basename($_FILES["image"]["name"]));
        $target_file_name = 'images/' . $_FILES["image"]["name"];
        // check if file is even given
        $uploadOk = 1;
        if (empty($_FILES["image"]["name"])) {
            $errors['image'][] = "❌ Image is required.";
            $uploadOk = 0;
        }
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // check if filetype is valid
        if ($uploadOk) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                $errors['image'][] = "❌ File is not an image.";
                $uploadOk = 0;
            }
            // check if file already exists
            if (file_exists($target_file)) {
                $errors['image'][] = "❌ File already exists.";
                $uploadOk = 0;
            }
        }
        $errors = validateInput($_POST['name'], $_POST['author_id'], $target_file_name, $_POST['release_date'], $_POST['availability'], $_POST['about'], $_POST['count']);
        if (!empty($errors)) {
            $authors = $db->execute("SELECT * FROM authors", []);
            view('create', [
                "authors" => $authors,
                "errors" => $errors,
                "page_title" => "Create book"
            ]);
            exit();
        }
        // save file and hive the location to the database
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file) && $_SESSION['user']['permission_level'] ?? 0 > 0) {
                $db->execute("INSERT INTO books (name, author_id, image_url, release_date, availability, count, about) VALUES (:name, :author_id, :image_url, :release_date, :availability, :count, :about)", [
                    ":name" => $_POST['name'],
                    ":author_id" => $_POST['author_id'],
                    ":image_url" => $target_file_name,
                    ":release_date" => $_POST['release_date'],
                    ":availability" => $_POST['availability'],
                    ":about" => $_POST['about'],
                    ":count" => $_POST['count']
                ]);
            }
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