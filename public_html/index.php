<?php
// Preload definitions.
require_once 'lib/defs/basic.php';
require_once 'lib/defs/http.php';
// "Autoload" classes.
require_once 'src/autoloader.php';
// Extract the requested URL.
$requestUri = $_SERVER['REQUEST_URI'];
// Route the URI.
switch ($requestUri) {
    case '/index.php':
    case '/':
        IndexController::index();
        break;
    default:
        ErrorController::error();
        break;
}