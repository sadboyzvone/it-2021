<?php

/**
 * Index controller takes care of the rendering the errors.
 */
class ErrorController {

    /**
     * Renders an HTTP error page.
     *
     * @param int $errorCode
     *   HTTP status code.
     */
    public static function error(int $errorCode = HTTP_NOT_FOUND) {
        http_response_code($errorCode);
        ThemeManager::render("error/$errorCode");
    }

}