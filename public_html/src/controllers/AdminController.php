<?php

/**
 * Admin controller takes care of the admin process.
 */
class AdminController {

    /**
     * Logic behind the login.
     */
    public static function login() {
        // If we're already authenticated what are we doing here?
        if (AuthService::isAuthenticated()) {
            RedirectionService::redirect('admin/dashboard');
        }
        // Check if login succeeded.
        if (RequestService::isSubmitted()) {
            // Get the login data.
            [$username, $password] = RequestService::getFromPost(['username', 'password']);
            // Try to login.
            if (AuthService::login($username, $password)) {
                // Set the current active user.
                MessengerService::addMessage('You are now logged in.');
                AuthService::setCurrentUser($username);
                RedirectionService::redirect('admin/dashboard');
            }
            else {
                MessengerService::addMessage('Invalid credentials.');
            }
        }
        ThemeManager::render('admin/login');
    }

    /**
     * Render the dashboard.
     */
    public static function dashboard() {
        ThemeManager::render('admin/dashboard');
    }

    /**
     * Render the add product page.
     */
    public static function addProduct() {
        if (RequestService::isSubmitted()) {
            // Get everything.
            [$name, $description, $price] = RequestService::getFromPost(['name', 'description', 'price']);
            $image = RequestService::getFile('image');
            // Validate image.
            if (empty($image['tmp_name'])) {
                MessengerService::addMessage('Please upload a valid image.');
                RedirectionService::redirect('admin/add');
            }
            if (getimagesize($image['tmp_name'] ?? '') === FALSE) {
                MessengerService::addMessage('Please upload a valid image.');
                RedirectionService::redirect('admin/add');
            }
            // Validate everything else.
            if (empty($name) || empty($description) || !is_numeric($price)) {
                MessengerService::addMessage('Please check your input and try again.');
                RedirectionService::redirect('admin/add');
            }
            // Upload the file.
            $filename = str_replace(ROOT, '/', UPLOADS_FOLDER . $image['name']);
            if (!move_uploaded_file($image['tmp_name'] ?? '', UPLOADS_FOLDER . $image['name'])) {
                MessengerService::addMessage('Failed to upload the image.');
                RedirectionService::redirect('admin/add');
            }
            // Sanitize.
            $name = htmlspecialchars($name);
            $description = htmlspecialchars($description);
            $price = (float) $price;
            // Input to the database.
            $statement = DatabaseService::getInstance()->prepare('INSERT INTO products (name, image, price, description) VALUES (:name, :image, :price, :description)');
            $statement->bindParam(':name', $name);
            $statement->bindParam(':image', $filename);
            $statement->bindParam(':price', $price);
            $statement->bindParam(':description', $description);
            if ($statement->execute()) {
                MessengerService::addMessage("You added '$name'!");
                RedirectionService::redirect('admin/dashboard');
            }
            else {
                MessengerService::addMessage('Failed to insert into the database.');
            }
        }
        ThemeManager::render('admin/add');
    }

    public static function updateProduct() {
        [$pid] = RequestService::getFromGet(['p']);
        if (!is_numeric($pid)) {
            RedirectionService::redirect('admin/dashboard');
        }

        if (RequestService::isSubmitted()) {
            // Get everything.
            [$name, $description, $price] = RequestService::getFromPost(['name', 'description', 'price']);
            $image = RequestService::getFile('image');
            // Validate image.
            if (!empty($image['tmp_name'])) {
                if (getimagesize($image['tmp_name']) === FALSE) {
                    $image = NULL;
                }
            }
            else {
                $image = NULL;
            }
            // Validate everything else.
            if (empty($name) || empty($description) || !is_numeric($price)) {
                MessengerService::addMessage('Please check your input and try again.');
                RedirectionService::refresh();
            }
            // Upload the file.
            if (!is_null($image)) {
                $filename = str_replace(ROOT, '/', UPLOADS_FOLDER . $image['name']);
                if (!move_uploaded_file($image['tmp_name'] ?? '', UPLOADS_FOLDER . $image['name'])) {
                    MessengerService::addMessage('Failed to upload the image.');
                    RedirectionService::refresh();
                }
                $statement = DatabaseService::getInstance()->prepare('UPDATE products SET image=:image WHERE pid=:pid');
                $statement->bindParam(':image', $filename);
                $statement->bindParam(':pid', $pid);
                if (!$statement->execute()) {
                    MessengerService::addMessage('Failed to upload the image.');
                    RedirectionService::refresh();
                }
            }
            // Sanitize.
            $name = htmlspecialchars($name);
            $description = htmlspecialchars($description);
            $price = (float) $price;
            // Input to the database.
            $statement = DatabaseService::getInstance()->prepare('UPDATE products SET name=:name,description=:description,price=:price WHERE pid=:pid');
            $statement->bindParam(':name', $name);
            $statement->bindParam(':price', $price);
            $statement->bindParam(':description', $description);
            $statement->bindParam(':pid', $pid);

            if ($statement->execute()) {
                MessengerService::addMessage("You updated '$name'!");
                RedirectionService::redirect('admin/dashboard');
            }
            else {
                MessengerService::addMessage('Failed to update the database.');
            }
        }
        ThemeManager::render('admin/update');
    }

    public static function deleteProduct() {
        // Get the PID.
        [$pid] = RequestService::getFromGet(['p']);
        if (is_numeric($pid)) {
            $statement = DatabaseService::getInstance()->prepare('DELETE FROM products WHERE pid = :pid');
            $statement->bindParam(':pid', $pid);
            if ($statement->execute()) {
                MessengerService::addMessage('Product deleted successfully.');
            }
            else {
                MessengerService::addMessage('Failed to delete the product.');
            }
        }
        RedirectionService::redirect('admin/dashboard');
    }

}