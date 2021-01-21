<?php require_once ROOT . 'pages/templates/header.php'; ?>
<?php MessengerService::printMessages(); ?>
<div class="container admin admin-add">
    <h1 class="right">Add new product</h1>
    <form action="/admin/add" method="post" enctype="multipart/form-data">
        <label for="name">
            Product name:
            <input type="text" name="name" placeholder="Product name..." required>
        </label>
        <br>
        <label for="description">
            Product description:
            <br>
            <textarea name="description" cols="80" rows="10" placeholder="Product description..." required></textarea>
        </label>
        <br>
        <label for="image">
            Product image:
            <input type="file" name="image" required>
        </label>
        <br>
        <br>
        <label for="price">
            Price: $
            <input type="number" name="price" placeholder="Product price..." min="0.99" step="0.01" required>
        </label>
        <br>
        <br>
        <input type="submit" name="submit" value="Add">
    </form>
</div>
<?php require_once ROOT . 'pages/templates/footer.php'; ?>