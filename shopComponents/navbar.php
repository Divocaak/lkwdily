<nav class="navbar bg-light">
    <ul class="nav flex-column">
        <li class="nav-item" style="text-align: center;">
            <p>Přihlášen uživatel <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.</p>
        </li>
        <div class="row justify-content-md-right" style="padding-left: 25px;">
            <div class="col-md-auto">
                <a href="shopComponents/scripts/reset_password.php" class="btn btn-warning">Změnit heslo</a>
            </div>
            <div class="col">
                <a href="shopComponents/scripts/logout.php" class="btn btn-danger">Odhlásit</a>
            </div>
        </div>
        <li class="nav-item">
            <br>
        </li>
        <?php include("categories.html");?>
    </ul>
</nav>