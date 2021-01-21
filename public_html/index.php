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
    // Admin actions.
    switch (basename($requestUri)) {
        case 'admin':
            if (!AuthService::isAuthenticated()) {
                RedirectionService::redirect('admin/login');
            }
            else {
                RedirectionService::redirect();
            }
            break;
        case 'login':
            AdminController::login();
            break;
        case 'logout':
            session_destroy();
            RedirectionService::redirect();
            break;
        default:
            var_dump($requestUri);
            ErrorController::error(HTTP_UNAUTHORIZED);
            break;
    }
}
else {
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
}