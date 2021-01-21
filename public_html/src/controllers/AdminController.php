<?php

/**
 * Admin controller takes care of the admin process.
 */
class AdminController {

    public static function login() {
        // If we're already authenticated what are we doing here?
        if (AuthService::isAuthenticated()) {
            RedirectionService::redirect();
        }
        // Check if login succeeded.
        if (RequestService::isSubmitted()) {
            // Get the login data.
            [$username, $password] = RequestService::getFromPost(['username', 'password']);
            // Try to login.
            if (AuthService::login($username, $password)) {
                // Set the current active user.
                MessengerService::addMessage('You are now logged in.');
                AuthService::setCurrentUser($username);
                RedirectionService::redirect();
            }
            else {
                MessengerService::addMessage('Invalid credentials.');
            }
        }
        ThemeManager::render('admin/login');
    }

}