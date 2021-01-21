<?php require_once ROOT . 'pages/templates/header.php'; ?>
<?php
    // Fetch the product.
    [$pid] = RequestService::getFromGet(['p']);

    $statement = DatabaseService::getInstance()->prepare('SELECT name, image, price, description FROM products WHERE pid = :pid');
    $statement->bindParam(':pid', $pid);
    $statement->execute();

    $products = $statement->fetchAll();
    if (empty($products)) {
        RedirectionService::redirect('admin/dashboard');
    }
    $product = reset($products);
?>
<div class="container admin admin-update">
    <h1 class="right">Update <?= $product['name'] ?></h1>
    <div id="update-wrapper">
        <form action="/admin/update?p=<?= $pid ?>" method="post" enctype="multipart/form-data">
            <label for="name">
                Product name:
                <input type="text" name="name" placeholder="Product name..." required value="<?= $product['name'] ?>">
            </label>
            <br>
            <label for="description">
                Product description:
                <br>
                <textarea name="description" cols="80" rows="10" placeholder="Product description..." required><?= $product['description'] ?></textarea>
            </label>
            <br>
            <label for="image">
                Product image:
                <input type="file" name="image">
            </label>
            <br>
            <br>
            <label for="price">
                Price: $
                <input type="number" name="price" placeholder="Product price..." min="0.99" step="0.01" value="<?= $product['price'] ?>" required>
            </label>
            <br>
            <br>
            <input type="submit" name="submit" value="Update">
            <a href="/admin/dashboard">Back</a>
        </form>
        <img src="<?= $product['image'] ?>" alt="Image">
    </div>
</div>
<?php require_once ROOT . 'pages/templates/footer.php'; ?>