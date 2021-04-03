<?php
session_start();

unset($_SESSION["cart"][$_POST["index"]]);
$_SESSION["cart"] = array_filter($_SESSION["cart"]);
$_SESSION["cart"] = array_values($_SESSION["cart"]);
?>