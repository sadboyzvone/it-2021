<?php require_once ROOT . 'pages/templates/header.php'; ?>
<?php
    $products = DatabaseService::getInstance()->query('SELECT * FROM products ORDER BY pid DESC LIMIT 3')->fetchAll();
?>
<div class="container homepage">
    <h1 class="center">Welcome to the Animu Weaboo Shop!</h1>
    <img id="excited-image" src="/images/excited.png" alt="Excited anime girl">
    <p class="center">Today is: <?= date('d/m/Y') ?></p>
    <h2>Newest Products</h2>
    <div id="products-wrapper">
        <?php
            foreach ($products as $product) {
        ?>
        <div class="product">
            <a href="/product?p=<?= $product['pid'] ?>">
                <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
            </a>
        </div>
        <?php
            }
        ?>
    </div>
</div>
<?php require_once ROOT . 'pages/templates/footer.php'; ?>
