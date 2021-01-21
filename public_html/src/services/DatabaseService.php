<?php

/**
 * Database services takes care of all the database connections.
 */
class DatabaseService {

    /**
     * PDO Connection.
     *
     * @var PDO|null
     */
    private static PDO|null $pdo = NULL;

    /**
     * Create a PDO connection.
     */
    public static function init() {
        self::$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE, DB_USER, DB_PASS);
    }

    /**
     * Return the PDO instance.
     *
     * @return PDO
     *   PDO connection.
     */
    public static function getInstance(): PDO {
        if (is_null(self::$pdo)) {
            self::init();
        }
        return self::$pdo;
    }

}