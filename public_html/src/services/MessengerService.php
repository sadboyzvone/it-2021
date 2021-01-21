<?php

/**
 * Messenger service takes care of rendering messages.
 */
class MessengerService {

    /**
     * Add a message to the array.
     *
     * @param string $message
     *   Message.
     */
    public static function addMessage(string $message) {
        if (!isset($_SESSION['messages'])) {
            $_SESSION['messages'] = [];
        }
        $_SESSION['messages'][] = $message;
        //var_dump($_SESSION);
    }

    /**
     * Print out the messages.
     */
    public static function printMessages() {
        $messages = $_SESSION['messages'] ?? [];

        if (!empty($messages)) {
            print '<div class="messages">';
            foreach ($messages as $message) {
                print '<div class="message"><h2>' . $message . '</h2></div>';
            }
            print '</div>';
        }

        $_SESSION['messages'] = [];
    }

}