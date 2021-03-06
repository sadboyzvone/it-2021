<?php
// Preload definitions.
require_once 'lib/defs/basic.php';
require_once 'lib/defs/http.php';
require_once 'lib/defs/database.php';
// "Autoload" classes.
require_once 'src/autoloader.php';
// Extract the requested URL.
$requestUri = explode('?', $_SERVER['REQUEST_URI'])[0];
// Start the session.
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
// Route the URI.
// Check if we have a admin route.
if ((dirname($requestUri) === '/admin') || ($requestUri === '/admin')) {
    if (!AuthService::isAuthenticated() && basename($requestUri) !== 'login') {
        ErrorController::error(HTTP_UNAUTHORIZED);
    }
    TitleService::setCurrentTitle('Administration');
    // Admin actions.
    switch (basename($requestUri)) {
        case 'admin':
            RedirectionService::redirect('admin/dashboard');
            break;
        case 'add':
            AdminController::addProduct();
            break;
        case 'delete':
            AdminController::deleteProduct();
            break;
        case 'update':
            AdminController::updateProduct();
            break;
        case 'dashboard':
            AdminController::dashboard();;
            break;
        case 'login':
            AdminController::login();
            break;
        case 'logout':
            session_destroy();
            RedirectionService::redirect();
            break;
        default:
            TitleService::setCurrentTitle('Not found');
            ErrorController::error();
            break;
    }
}
else {
    switch ($requestUri) {
        case '/index.php':
        case '/':
            DefaultController::homepage();
            break;
        case '/about':
            TitleService::setCurrentTitle('About us');
            DefaultController::aboutUs();
            break;
        case '/terms-of-service':
            TitleService::setCurrentTitle('Terms of Service');
            DefaultController::termsOfService();
            break;
        case '/product':
            DefaultController::product();
            break;
        case '/products':
            TitleService::setCurrentTitle('Products');
            DefaultController::products();
            break;
        default:
            TitleService::setCurrentTitle('Not found');
            ErrorController::error();
            break;
    }
}