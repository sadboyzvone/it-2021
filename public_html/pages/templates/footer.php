    <footer>
        <p>Copyleft &copy; <?= date('Y') ?> Zvonimir Rudinski</p>
        <div>
        <?php
            if (AuthService::isAuthenticated()) {
                print '<a href="/admin/login">Admin area</a>';
                print '<a href="/admin/logout">Log out</a>';
            }
            else {
                print '<a href="/admin/login">Log in as admin</a>';
            }
        ?>
        </div>
    </footer>
</body>
</html>