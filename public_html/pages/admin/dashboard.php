<?php require_once ROOT . 'pages/templates/header.php'; ?>
<?php
    $products = DatabaseService::getInstance()->query('SELECT * FROM products')->fetchAll();
?>
<div class="container admin admin-dashboard">
    <h1 class="right">Welcome back, <span class="underline"><?= AuthService::getCurrentUser() ?></span>!</h1>
    <a href="/admin/add"><button id="add-button">+ Add Product</button></a>
    <table border="1px solid black">
        <thead>
            <tr>
                <th>Product</th>
                <th>Title</th>
                <th>Price</th>
                <th>Operations</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach ($products as $product) {
                ?>
                <tr>
                    <td>
                        <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
                    </td>
                    <td>
                        <?= $product['name'] ?>
                    </td>
                    <td>
                        $<?= number_format($product['price'], 2) ?>
                    </td>
                    <td>
                        <a href="/admin/update?p=<?= $product['pid'] ?>"><button>Update</button></a>
                        <a href="/admin/delete?p=<?= $product['pid'] ?>"><button>Delete</button></a>
                    </td>
                </tr>
                <?php
            }
        ?>
        </tbody>
    </table>
</div>
<?php require_once ROOT . 'pages/templates/footer.php'; ?>