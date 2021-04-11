<?php
session_start();

unset($_SESSION["selectedCategorySql"]);
unset($_SESSION["selectedCategoryName"]);
unset($_SESSION["openedPage"]);
$_SESSION["searchText"] = $_POST["findText"];
//nechat sort
?>