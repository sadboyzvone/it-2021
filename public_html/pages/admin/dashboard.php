<?php require_once ROOT . 'pages/templates/header.php'; ?>
<?php
    $products = DatabaseService::getInstance()->prepare('SELECT * FROM products')->fetchAll();
?>
<div class="container admin admin-dashboard">
    <h1 class="right">Welcome back, <span class="underline"><?= AuthService::getCurrentUser() ?></span>!</h1>
    <a href="/admin/add"><button id="add-button">+ Add Product</button></a>
</div>
<?php require_once ROOT . 'pages/templates/footer.php'; ?>