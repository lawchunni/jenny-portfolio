<?php

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../config/connect.php';

use App\Models\Log;
use App\Lib\Utils;

ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

ob_start();
session_start();

if(!isAdmin()) {
    $_SESSION['flash']['error'] = "Please login as administrator to view the admin section.";
    header('Location: /');
    die;
}

$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);

$post = $_SESSION['post'] ?? [];
unset($_SESSION['post']);

$flash = $_SESSION['flash'] ?? [];
unset($_SESSION['flash']);

$args = [
    'dbh' => $dbh,
    'post' => $post,
    'flash' => $flash,
    'errors' => $errors
];

$allowed = [
    'categories',
    'products',
    'product-add',
    'product-edit',
    'process-product-add',
    'process-product-edit',
    'process-product-delete',
    'orders',
    'users',
    'logs'
];

// routing handling
if(empty($_GET['p'])) {
    if(empty($_GET['search'])) {
        $page = 'dashboard';
    } else {
        $page = 'products';
    }
} else if (in_array($_GET['p'], $allowed)) {
    $page = $_GET['p'];
} else {
    http_response_code(404);
    $page = "error404";
}

use App\Lib\Router;

$route = new Router($page, $args);
$route->route();
