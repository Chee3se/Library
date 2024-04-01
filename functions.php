<?php
function dd($data) {
    echo '<pre>';
    die(var_dump($data));
    echo '</pre>';
    die();
}

function base_path($path) {
    return BASE_PATH . $path;
}

function view($view, $attributes = []) {
    extract($attributes);
    require base_path("views/{$view}.view.php");
}

