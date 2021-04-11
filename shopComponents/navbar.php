<div class="h-100 bg-light">
    <div class="fixed-top flex-column p-2">
        <div class="row justify-content-xs-right">
            <div class="col-xs-6">
                <p>Přihlášen uživatel:</p>
            </div>
            <div class="col-xs-6">
                <p><b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.</p>
            </div>
        </div>
        <div class="row justify-content-md-right">
            <div class="col-xs-6">
                <a href="shopComponents/scripts/reset_password.php" class="btn btn-warning">Změnit heslo</a>
            </div>
            <div class="col-xs-6">
                <a href="shopComponents/scripts/logout.php" class="btn btn-danger">Odhlásit</a>
            </div>
        </div>
        <?php include("categories.html");?>
    </div>
</div>