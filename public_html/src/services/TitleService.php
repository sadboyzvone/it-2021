<?php

/**
 * Resolves the title based on the URI.
 */
class TitleService {

    /**
     * A default title.
     * @var string
     */
    static string $title = '';

    /**
     * Sets the current page title.
     *
     * @param string $title
     *   The title.
     */
    public static function setCurrentTitle(string $title) {
        self::$title = $title;
    }

    /**
     * Resolves the title based on the URI.
     *
     * @return string
     *   Title.
     */
    public static function resolve(): string {
        if (!empty(self::$title)) {
            return self::$title;
        }
        return 'Homepage';
    }

}