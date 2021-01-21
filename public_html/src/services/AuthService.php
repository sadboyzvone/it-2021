<?php

/**
 * Auth service takes care of all the authentication.
 */
class AuthService {

    /**
     * Current username.
     *
     * @var string
     */
    static string $currentUser = '';

    /**
     * Set current user.
     *
     * @param string $user
     *   Current user to set.
     */
    public static function setCurrentUser(string $user) {
        $_SESSION['currentUser'] = $user;
    }

    /**
     * Check if you're authenticated.
     *
     * @return bool
     *   If we have a session, TRUE else FALSE.
     */
    public static function isAuthenticated(): bool {
        return !empty($_SESSION['currentUser'] ?? NULL);
    }

    /**
     * Get the current user.
     *
     * @return string
     *   Current username.
     */
    public static function getCurrentUser(): string {
        if (!self::isAuthenticated()) {
            return '';
        }
        else {
            self::$currentUser = htmlspecialchars($_SESSION['currentUser']);
            return self::$currentUser;
        }
    }

    /**
     * Try to login.
     *
     * @param $username
     *   Username.
     * @param $password
     *   Password.
     *
     * @return bool
     *   TRUE if credentials valid.
     */
    public static function login($username, $password): bool {
        if (empty($username) || empty($password)) {
            return FALSE;
        }
        // Get the password.
        $statement = DatabaseService::getInstance()->prepare('SELECT password FROM administrators WHERE username = :username');
        $statement->bindParam(':username', $username);
        $statement->execute();
        // If the password is not found we failed.
        $hashed_password = $statement->fetch();
        if ($hashed_password === FALSE) {
            return FALSE;
        }
        // Verify the password.
        return password_verify($password, reset($hashed_password));
    }

}