<?php
// Fetch the product.
[$pid] = RequestService::getFromGet(['p']);

$statement = DatabaseService::getInstance()->prepare('SELECT name, image, price, description FROM products WHERE pid = :pid');
$statement->bindParam(':pid', $pid);
$statement->execute();

$products = $statement->fetchAll();
if (empty($products)) {
    RedirectionService::redirect();
}
$product = reset($products);
TitleService::setCurrentTitle($product['name']);
?>
<?php require_once ROOT . 'pages/templates/header.php'; ?>
    <div class="container product">
        <h1><?= $product['name'] ?></h1>
        <div id="product-wrapper">
            <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
            <p class="right"><?= htmlspecialchars($product['description']) ?></p>
        </div>
        <p id="price" class="right">$<?= number_format($product['price'], 2) ?></p>
        <button id="add-button">Out of Stock</button>
    </div>
<?php require_once ROOT . 'pages/templates/footer.php'; ?>