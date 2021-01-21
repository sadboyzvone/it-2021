<?php require_once ROOT . 'pages/templates/header.php'; ?>
<div class="container admin admin-login">
    <h1 class="center">Administration Login</h1>
    <form action="/admin/login" method="post">
        <label for="username">
            Username:
            <br>
            <input type="text" name="username" placeholder="Username..." required>
        </label>
        <br>
        <label for="password">
            Password:
            <br>
            <input type="password" name="password" placeholder="Password..." required>
        </label>
        <br>
        <input id="submit" type="submit" value="Log in" name="submit">
    </form>
</div>
<?php require_once ROOT . 'pages/templates/footer.php'; ?>
