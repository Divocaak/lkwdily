<?php
session_start();
// nechat kategorii
// nechat kategorii
unset($_SESSION["openedPage"]);
// nechat vyhledávání
$_SESSION["selectedSortSql"] = returnSortSql($_POST["newSort"]);
$_SESSION["selectedSortName"] = returnSortName($_POST["newSort"]);

function returnSortSql($post){
    $sqlSort = ["price ASC", "price DESC", "name ASC", "name DESC", "code ASC", "code DESC", "storage DESC"];
    return $sqlSort[intval($post)];
}
function returnSortName($post){
    $textSort = ['Cena <i class="bi bi-caret-up-fill"></i>',
    'Cena <i class="bi-caret-down-fill"></i>',
    'Abecedně <i class="bi-caret-up-fill"></i>',
    'Abecedně <i class="bi-caret-down-fill"></i>',
    'Kód produktu <i class="bi-caret-up-fill"></i>',
    'Kód produktu <i class="bi-caret-down-fill"></i>',
    'Skladem'];
    return $textSort[intval($post)];
}
?>