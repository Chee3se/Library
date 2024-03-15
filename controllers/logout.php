<?php

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        session_start();
        session_destroy();
        header("Location: /books");
        break;
    default:
        header("Location: /books");
        break;
}