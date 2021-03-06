<?php

use JetBrains\PhpStorm\Pure;

/**
 * Request service takes care of all the requests.
 */
class RequestService {

    /**
     * Get the data from GET.
     *
     * @param array $keys
     *   Array of keys to look for. If empty returns all.
     *
     * @return array
     *   Array.
     */
    public static function getFromGet(array $keys = []): array {
        return self::getFromArray($_GET, $keys);
    }

    /**
     * Get the data from POST.
     *
     * @param array $keys
     *   Array of keys to look for. If empty returns all.
     *
     * @return array
     *   Array.
     */
    public static function getFromPost(array $keys = []): array {
        return self::getFromArray($_POST, $keys);
    }

    /**
     * Get file.
     *
     * @param string $name
     *   File POST name.
     *
     * @return array
     *   File info.
     */
    public static function getFile(string $name = ''): array {
        return $_FILES[$name] ?? [];
    }

    /**
     * Check if a form was submitted.
     *
     * @return bool
     *   TRUE if yes.
     */
    public static function isSubmitted(): bool {
        return isset($_POST['submit']);
    }

    private static function getFromArray(array $array, array $keys = []): array{
        if (empty($keys)) {
            return $array;
        }
        $data = [];
        foreach ($keys as $key) {
            $data[] = $array[$key] ?? NULL;
        }

        return $data;
    }

}