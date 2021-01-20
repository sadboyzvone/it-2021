<?php

/**
 * Theme manager renders everything.
 */
class ThemeManager {

    /**
     * Render the specified theme.
     *
     * @param string|null $theme
     *   Theme name.
     */
    public static function render(string $theme = NULL) {
        $filename = ROOT . 'pages/' . $theme . '.php';
        if (is_file($filename)) {
            require_once $filename;
        }
    }

}