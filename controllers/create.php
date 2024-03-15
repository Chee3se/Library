<?php

$page_title = "Create book";

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        require 'views/create.view.php';
        break;
    case 'POST':
        
        header("Location: /");
        break;
    default:
        header("Location: /");
        break;
}