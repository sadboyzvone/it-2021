<?php

/**
 * Default controller takes care of the non-admin pages.
 */
class DefaultController {

    /**
     * Renders the homepage.
     */
    public static function homepage() {
        ThemeManager::render('index');
    }

    /**
     * Renders the about page.
     */
    public static function aboutUs() {
        ThemeManager::render('about');
    }

    /**
     * Renders the TOS page.
     */
    public static function termsOfService() {
        ThemeManager::render('terms-of-service');
    }

    /**
     * Renders the product page.
     */
    public static function product() {
        [$pid] = RequestService::getFromGet(['p']);
        if (!is_numeric($pid)) {
            RedirectionService::redirect();
        }

        ThemeManager::render('product');
    }
}