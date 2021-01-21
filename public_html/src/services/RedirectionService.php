<?php

/**
 * Redirection service takes care of all the redirections.
 */
class RedirectionService {

    /**
     * Redirect to a certain location.
     *
     * @param string $location
     *   Location.
     */
    public static function redirect(string $location = '') {
        header('Location: /' . $location);
        die();
    }

    public static function refresh() {
        header('Location: ' . $_SERVER['REQUEST_URI']);
        die();
    }

}