<?php require_once ROOT . 'pages/templates/header.php'; ?>
<?php
    [$search] = RequestService::getFromGet(['q']);
    if (!empty($search)) {
        $statement = DatabaseService::getInstance()->prepare('SELECT * FROM products WHERE name LIKE :name');
        $query = "%$search%";
        $statement->bindParam(':name', $query);
        $statement->execute();
        $products = $statement->fetchAll();
    }
    else {
        $products = DatabaseService::getInstance()->query('SELECT * FROM products')->fetchAll();
    }
    $products_chunk = array_chunk($products, 3);
?>
<div class="container products">
    <h1>Products</h1>
    <div id="search-form">
        <form action="/products" method="get">
            <input type="text" name="q" placeholder="Search by name..." value="<?= $search ?>">
            <input type="submit" name="submit" value="Search">
        </form>
    </div>
    <hr>
    <?php
        foreach ($products_chunk as $chunk) {
        ?>
        <div class="row">
            <?php
            foreach ($chunk as $product) {
            ?>
                <div class="column">
                    <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
                    <a href="/product?p=<?= $product['pid'] ?>"><?= $product['name'] ?></a>
                    <p class="underline">$<?= number_format($product['price'], 2) ?></p>
                </div>
            <?php
            }
            ?>
        </div>
        <?php
        }
    ?>
</div>
<?php require_once ROOT . 'pages/templates/footer.php'; ?>