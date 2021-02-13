<?php
session_start();

if(isset($_SESSION["cart"])){
    unset($_SESSION["cart"]);
    echo "unsetted";
}else{
    echo "cart doesnt exist";
}
?>