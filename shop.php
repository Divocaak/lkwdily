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
</head>

<body>
    <div class="row">
        <div class="col-3">
            <?php include("shopComponents/navbar.php");?>
        </div>
        <div class="col-9">
            <?php include("shopComponents/header.php");?>
            <div class="row">
                <?php
                    function RemoveEquals($selectedCategory)
                    {
                        return $selectedCategory[0] == "=" ? substr($selectedCategory, 1) : $selectedCategory;
                    }

                    $sql = 'SELECT * FROM part WHERE category' . $_SESSION["selectedCategory"]. ' ORDER BY ' . $sqlSort[$_SESSION["sortBy"]] . ' LIMIT 40 OFFSET ' . ($_SESSION["openedPage"] -1) * 40 . ';';
                    if ($result = mysqli_query($link, $sql)) {
                        while ($row = mysqli_fetch_row($result)) {
                        echo '<div class="col-3">
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
                        mysqli_free_result($result);
                    }
                    mysqli_close($link);
                ?>

                <?php include("shopComponents/pagination.php");?>
            </div>
            
            <?php
                include("shopComponents/modals/part.html");
                include("shopComponents/modals/cart/cart.html");
                include("shopComponents/modals/cart/cartEmpty.html");
                include("shopComponents/modals/orderOverview.html");
                include("shopComponents/modals/contactInfo.html");
                include("shopComponents/modals/payment.html");
            ?>

            <div class="row">
                <div class="col">
                    <button id="testButton" class="btn btn-danger">delete cart content</button>
                    <p id="testP"></p>

                    <button id="writeCart" class="btn btn-warning">write cart</button>
                    <p id="cartP"></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
</body>

</html>