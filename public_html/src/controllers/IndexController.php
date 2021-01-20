<?php

/**
 * Index controller takes care of the homepage.
 */
class IndexController {

    /**
     * Renders the index page.
     */
    public static function index() {
        ThemeManager::render('index');
    }

}