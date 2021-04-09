<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require_once "shopComponents/scripts/config.php";
?>

<!doctype html>
<html lang="cs">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="shopComponents/scripts/shopScripts.js"></script>

    <title>E-shop</title>

    <style>
        .categoryChange, .sortOption, .page-link {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php
        include("shopComponents/modals/part.html");
        include("shopComponents/modals/cart/cart.html");
        include("shopComponents/modals/cart/cartEmpty.html");
        include("shopComponents/modals/orderOverview.html");
        include("shopComponents/modals/contactInfo.html");
        include("shopComponents/modals/payment.html");
    ?>

<div class="row">
    <div class="col-md-3 mh-100 col-xs-2">
        <?php include("shopComponents/navbar.php");?>
    </div>
    <div class="col-md-9 col-xs-10">
        <div class="d-flex align-items-center justify-content-center" id="shopLoading">
            </br></br></br>
            <div class="spinner-grow" role="status">
                <span class="sr-only"></span>
            </div>
        </div>
        <div class="row" id="shopBody">
            <?php
                if(!isset($_SESSION["selectedCategoryName"]) || !isset($_SESSION["selectedCategorySql"])){
                    $_SESSION["selectedCategorySql"] = " BETWEEN 86 AND 142";
                    $_SESSION["selectedCategoryName"] = "Všechny produkty";
                }

                if(!isset($_SESSION["selectedSortName"]) || !isset($_SESSION["selectedSortSql"])){
                    $_SESSION["selectedSortName"] = 2;
                    $_SESSION["selectedSortSql"] = 2;
                }
                    
                if(!isset($_SESSION["openedPage"])){
                    $_SESSION["openedPage"] = 1;
                }

                include("shopComponents/header.php");

                $sql = 'SELECT * FROM part WHERE category' . $_SESSION["selectedCategorySql"] . searchItems() . '
                    ORDER BY ' . $_SESSION["selectedSortSql"] . '
                    LIMIT 40 OFFSET ' . ($_SESSION["openedPage"] -1) * 40 . ';';

                //echo $sql;

                if ($result = mysqli_query($link, $sql)) {
                    if(mysqli_num_rows($result) > 0){
                        while ($row = mysqli_fetch_row($result)) {
                            echo '<div class="col-xs-12 col-lg-3 col-md-6">
                                        <div class="card my-2">
                                            <div class="card-img-top">
                                                <img class="img-fluid d-block mx-auto" style="max-height: 200px;" src="' . $row[6] . '" alt="Card image cap">
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title">' . $row[1] . '</h5>
                                                <p class="card-text">Kód produktu: ' . $row[7] . '</p>
                                                <button type="button" class="btn btn-primary partButton" data-part-id="' . $row[0] . '">
                                                    Zobrazit detail
                                                </button>
                                            </div>
                                        </div>
                                    </div>';
                        }
                    }
                    else{
                        echo "<br><br><p class='text-center'><b>" . $_SESSION["searchText"] . "</b>: žádná shoda</p><br><br>";
                    }
                    mysqli_free_result($result);
                }
                mysqli_close($link);

                function searchItems(){
                    if(isset($_SESSION["searchText"]) && $_SESSION["searchText"] != ""){
                        return ' AND (name LIKE "%' . $_SESSION["searchText"] . '%"
                        OR code LIKE "%' . $_SESSION["searchText"] . '%")';
                    }
                    else
                    {
                        return "";
                    }
                }

                include("shopComponents/pagination.php");
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
</body>

</html>