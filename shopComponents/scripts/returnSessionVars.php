<?php
session_start();
$returnArr = ["cartCount" => (isset($_SESSION["cart"]) ? sizeof($_SESSION["cart"]) : 0),
    "discount" =>  $_SESSION["discount"]];

echo json_encode($returnArr);
?>