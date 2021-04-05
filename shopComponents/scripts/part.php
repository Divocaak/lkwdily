<?php
include "config.php";

$sql = 'SELECT * FROM part p
        JOIN manufacturer m ON (p.manufacturer_id=m.id)
        JOIN brand b ON (p.brand_id=b.id)
        WHERE p.id=' . $_POST["id"] . ';';

$returnArr = [];
if ($result = mysqli_query($link, $sql)) {
    while ($row = mysqli_fetch_row($result)) {
         $returnArr = ["name" => $row[1], "price" => $row[2], "manufacturer" => $row[9],"brand" => $row[11],
            "storage" => $row[5], "img_path" => $row[6], "code" => $row[7]];
    }
    mysqli_free_result($result);
}

mysqli_close($link);

echo json_encode($returnArr);
?>