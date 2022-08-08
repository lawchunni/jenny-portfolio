<?php 

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/connect.php';

//require a config file here 

date_default_timezone_set("America/Winnipeg");

ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

ob_start();
session_start();

if(empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = md5(uniqid(mt_rand(), true));
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

// Log Events
use App\Lib\DatabaseLogger;
use App\Lib\FileLogger;
use App\Lib\Utils;

$databaseLogger = new DatabaseLogger($dbh);

$fh = fopen(__DIR__ . '/../logs/events.log', 'a+');
$fileLogger = new FileLogger($fh);

$utils = new Utils();
$logEvent = $utils->logEvent($databaseLogger);
$logEvent = $utils->logEvent($fileLogger);

// allowed routes
$allowed = [
    'home', 
    'portfolio', 
    'all-services', 
    'service-details', 
    'contact-me', 
    'register', 
    'process_register', 
    'profile', 
    'login', 
    'process_login', 
    'process_logout', 
    'cart', 
    'process-cart', 
    'checkout', 
    'process-checkout',
    'thank-you'
];

// routing handling
if(empty($_GET['p'])) {
    if(empty($_GET['search'])) {
        $page = 'home';
    } else {
        $page = 'all-services';
    }
} elseif(in_array($_GET['p'], $allowed)) {
    $page = $_GET['p'];
} else {
    // header("HTTP/1.1 404 Not Found"); // same as below
    http_response_code(404);
    $page = "error404";
}

use App\Lib\Router;

$route = new Router($page, $args);
$route->route();

