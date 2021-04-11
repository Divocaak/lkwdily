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

<div class="row mh-100">
    <div class="d-md-none col-xs-6 bg-light">
        <div class="row">
            <div class="col">
                <img src="imgs/logo.jpg" class="d-inline-block img-fluid">
            </div>
            <div class="col">
                <div class="container float-right justify-content-right">
                    <a class="btn btn-outline-primary" role="button" data-toggle="modal" href="#navModal">
                        <i class="bi bi-list"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="modal fade" id="navModal" tabindex="-1" aria-labelledby="navModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Navigace</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body h-100">
                            <div class="container-fluid">
                                <?php include("shopComponents/navbarModal.php");?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-3 mh-100 d-none d-md-block">
        <?php include("shopComponents/navbar.php");?>
    </div>
    <div class="col-md-8 col-xs-6 col-lg-9">
        <div class="d-flex align-items-center justify-content-center" id="shopLoading">
            <div class="spinner-grow mt-5" role="status">
                <span class="sr-only"></span>
            </div>
        </div>
        <div class="col-md-8 col-xs-6 col-lg-9">
            <div class="row" id="shopBody">
                <?php include("shopComponents/shopBody.php");?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
</body>

</html>