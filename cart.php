<?php
include "config.php";
session_start();

$ids = "";
$returnArr = [];
for($i = 0; $i < sizeof($_SESSION['cart']); $i++){
    $returnArr[] = ["name" => $_SESSION['cart'][$i]["id"],
                    "ammount" => $_SESSION['cart'][$i]["ammount"]];
    $ids .= $_SESSION['cart'][$i]["id"] . ", ";
}

$sql = 'SELECT id, name, img_path, price FROM part WHERE id IN(' . substr($ids, 0, -2) . ');';
$names = $partIds = $imgs = $prices = [];
if ($result = mysqli_query($link, $sql)) {
    while ($row = mysqli_fetch_row($result)) {
        $partIds[$row[0]] = $row[0];
        $names[$row[0]] = $row[1];
        $imgs[$row[0]] = $row[2];
        $prices[$row[0]] = $row[3];
    }
    mysqli_free_result($result);
}
mysqli_close($link);


for ($x = 0; $x <= sizeof($returnArr) - 1; $x++) {
    $id = $returnArr[$x]["name"];
    $returnArr[$x]["name"] = ($id == 0 ? "nula" : $names[$id]);
    $returnArr[$x]["id"] = $partIds[$id];
    $returnArr[$x]["img"] = $imgs[$id];
    $returnArr[$x]["price"] = $prices[$id];
}

echo json_encode($returnArr);
?>