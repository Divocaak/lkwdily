<?php
    session_start();

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $_SESSION["cart"][] = ["id" => $_POST["id"], "ammount" => $_POST["ammount"]];
?>