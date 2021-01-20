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
        StaticPageController::homepage();
        break;
    case '/about':
        TitleService::setCurrentTitle('About us');
        StaticPageController::aboutUs();
        break;
    case '/terms-of-service':
        TitleService::setCurrentTitle('Terms of Service');
        StaticPageController::termsOfService();
        break;
    default:
        ErrorController::error();
        break;
}