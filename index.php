<?php

$url = parse_url($_SERVER['REQUEST_URI'])["path"];
$dir = 'controllers/';

switch ($url) {
    case '':
    case '/':
        require $dir.'index.php';
        break;

    case '/books':
        require $dir.'books.php';
        break;
    case '/books/create':
        require $dir.'create.php';
        break;
    case '/books/edit':
        require $dir.'edit.php';
        break;
    case '/books/delete':
        require $dir.'delete.php';
        break;

    default:
        http_response_code(404);
        require $dir.'404.php';
}