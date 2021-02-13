<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require_once "config.php";
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
    <script src="shopScripts.js"></script>

    <title>E-shop</title>
</head>

<body>
    <div class="row">
        <div class="col-3">
            <nav class="navbar bg-light">
                <ul class="nav flex-column">
                    <li class="nav-item" style="text-align: center;">
                        <p>Přihlášen uživatel <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.</p>
                    </li>
                    <div class="row justify-content-md-right" style="padding-left: 25px;">
                        <div class="col-md-auto">
                            <a href="reset_password.php" class="btn btn-warning">Změnit heslo</a>
                        </div>
                        <div class="col">
                            <a href="logout.php" class="btn btn-danger">Odhlásit</a>
                        </div>
                    </div>
                    <li class="nav-item">
                        <br>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="?selectedCategory= like '%'">Všechny produkty</a>
                    </li>
                    <li class="nav-item">
                        <br>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#karosarskeDily" role="button"
                            aria-expanded="false" aria-controls="collapseExample">
                            Karosářské díly
                        </a>
                    </li>
                    <div class="collapse" id="karosarskeDily">
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#daf" role="button" aria-expanded="false"
                                aria-controls="collapseExample">
                                &nbsp;&nbsp;DAF
                            </a>
                        </li>
                        <div class="collapse" id="daf">
                            <li class="nav-item">
                                <a class="nav-link" href="?selectedCategory='Home'" role="button" aria-expanded="false"
                                    aria-controls="collapseExample">
                                    &nbsp;&nbsp;&nbsp;&nbsp;XF 106
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="?selectedCategory='R'" role="button" aria-expanded="false"
                                    aria-controls="collapseExample">
                                    &nbsp;&nbsp;&nbsp;&nbsp;XF 105
                                </a>
                            </li>
                        </div>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#iveco" role="button" aria-expanded="false"
                                aria-controls="collapseExample">
                                &nbsp;&nbsp;Iveco
                            </a>
                        </li>
                        <div class="collapse" id="iveco">
                            <li class="nav-item">
                                <a class="nav-link" href="?selectedCategory='Stralis'" role="button"
                                    aria-expanded="false" aria-controls="collapseExample">
                                    &nbsp;&nbsp;&nbsp;&nbsp;Stralis Hi-Way
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="?selectedCategory='SCANIA'" role="button"
                                    aria-expanded="false" aria-controls="collapseExample">
                                    &nbsp;&nbsp;&nbsp;&nbsp;Stralis
                                </a>
                            </li>
                        </div>

                    </div>
                </ul>
            </nav>
        </div>
        <div class="col-9">
            <div class="row mt-1">
                <div class="col">
                    <div class="dropdown">
                        <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button" id="sortByDropdown"
                            data-toggle="dropdown" aria-expanded="false">Seřadit podle</a>
                        <ul class="dropdown-menu" aria-labelledby="sortByDropdown">
                            <li><a class="dropdown-item" href="#">Cena <i class="bi bi-caret-up-fill"></i></a></li>
                            <li><a class="dropdown-item" href="#">Cena <i class="bi bi-caret-down-fill"></i></a></li>
                            <li><a class="dropdown-item" href="#">Abecedně <i class="bi bi-caret-up-fill"></i></a></li>
                            <li><a class="dropdown-item" href="#">Abecedně <i class="bi bi-caret-down-fill"></i></a>
                            </li>
                            <li><a class="dropdown-item" href="#">Kód produktu <i class="bi bi-caret-up-fill"></i></a>
                            </li>
                            <li><a class="dropdown-item" href="#">Kód produktu <i class="bi bi-caret-down-fill"></i></a>
                            </li>
                            <li><a class="dropdown-item" href="#">Skladem</i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col">
                    <p></p>
                </div>
                <div class="col">
                    <button type="button" class="btn btn-primary cartButton"><i class="bi bi-cart2"></i></button>
                </div>
            </div>
            <div class="row">
                <?php
                    function RemoveEquals($selectedCategory)
                    {
                        return $selectedCategory[0] == "=" ? substr($selectedCategory, 1) : $selectedCategory;
                    }

                    if(!isset($_GET["selectedCategory"])){
                        $_GET["selectedCategory"] = " like '%'";
                    }else{
                        if($_GET["selectedCategory"][0] != " "){
                            $_GET["selectedCategory"] = "=" . $_GET["selectedCategory"];
                        }
                    }

                    $openedPage = (!isset($_GET["openedPage"]) ? 1 : $_GET["openedPage"]);

                    $sql = 'SELECT id FROM part WHERE category' . $_GET["selectedCategory"]. ';';
                    if ($result = mysqli_query($link, $sql)) {
                        $partsCount = mysqli_num_rows($result);
                        mysqli_free_result($result);
                    }

                    $sql = 'SELECT * FROM part WHERE category' . $_GET["selectedCategory"]. ' LIMIT 40 OFFSET ' . ($openedPage -1) * 40 . ';';
                    if ($result = mysqli_query($link, $sql)) {
                        while ($row = mysqli_fetch_row($result)) {
                        echo '<div class="col-3">
                                    <div class="card my-2">
                                    <div class="card-img-top">
                                        <img class="img-fluid d-block mx-auto" style="max-height: 200px;" src="' . $row[7] . '" alt="Card image cap">
                                    </div>
                                        <div class="card-body">
                                            <h5 class="card-title">' . $row[1] . '</h5>
                                            <p class="card-text">Kód produktu: ' . $row[8] . '</p>
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

                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?php
                            echo '<li class="page-item ' . ($openedPage == 1 ? "disabled" : "") . '">
                                    <a class="page-link" href="?openedPage=1' . '&selectedCategory=' . RemoveEquals($_GET["selectedCategory"]) . '">První</a>
                                </li>';
                            echo '<li class="page-item ' . ($openedPage == 1 ? "disabled" : "") . '">
                                    <a class="page-link" href="?openedPage=' . ($openedPage - 1) . '&selectedCategory=' . RemoveEquals($_GET["selectedCategory"]) . '">Předchozí</a>
                                </li>';

                            $pagesCount = $partsCount < 40 ? 1 : (round($partsCount / 40, 0) + ($partsCount % 40 != 0 && $partsCount > 40 ? 1 : 0)); 
                            $paginationActive = ($openedPage == 1 ? 0 : ($openedPage == $pagesCount ? ($pagesCount > 2 ? -2 : -1) : -1));
                         
                            for($i = ($openedPage + $paginationActive); $i < $pagesCount + 1; $i++){
                                if($i == ($openedPage - 1) || $i == $openedPage || $i == ($openedPage + 1)){
                                    echo '<li class="page-item ' . ($openedPage == $i ? "active" : "") . '">
                                    <a class="page-link" href="?openedPage=' . $i . '&selectedCategory=' . RemoveEquals($_GET["selectedCategory"]) . '">' . $i . '</a>
                                    </li>';
                                }
                                else{
                                    continue;
                                }
                            }

                            echo '<li class="page-item ' . ($openedPage == $pagesCount ? "disabled" : "") . '">
                                    <a class="page-link" href="?openedPage=' . ($openedPage + 1) . '&selectedCategory=' . RemoveEquals($_GET["selectedCategory"]) . '">Další</a>
                                </li>';
                            echo '<li class="page-item ' . ($openedPage == $pagesCount ? "disabled" : "") . '">
                                <a class="page-link" href="?openedPage=' . ($pagesCount - 1) . '&selectedCategory=' . RemoveEquals($_GET["selectedCategory"]) . '">Poslední</a>
                            </li>';

                            echo "&nbsp;<b>" . $partsCount . "</b>&nbsp;položek,&nbsp;<b>" . $pagesCount . "</b>&nbsp;stránek.";
                        ?>
                    </ul>
                </nav>
            </div>

            <div class="modal fade" id="partModal" tabindex="-1" role="dialog" aria-labelledby="partModalCenterTitle"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title partLoaded" id="partModalTitle"></h5>
                            <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex justify-content-center" id="partLoading">
                                <div class="spinner-grow" role="status">
                                    <span class="sr-only"></span>
                                </div>
                            </div>
                            <div class="row partLoaded">
                                <div class="col">
                                    <img src="" id="partImg" class="img-fluid">
                                </div>
                                <div class="col">
                                    <table class="table table-sm table-borderless table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">&nbsp;</th>
                                                <th scope="col">bez DPH</th>
                                                <th scope="col">s DPH</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">Běžná cena</th>
                                                <td id="priceNormalWithout"></td>
                                                <td id="priceNormalWith"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Vaše cena</th>
                                                <td id="priceWithout"></td>
                                                <td id="priceWith"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-sm table-borderless table-hover">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Výrobce</th>
                                                <td id="manufacturer"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Značka</th>
                                                <td id="brand"></td>
                                            </tr>
                                            <tr>
                                                <th>&nbsp;</th>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Kód produktu</th>
                                                <td id="code"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p id="text_small"></p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="row partLoaded">
                                <div class="col">
                                    <p id="storage"></p>
                                </div>
                                <div class="col">
                                    <input type="number" id="ammount" min="1" class="form-control" placeholder="Počet"
                                        aria-label="ammount" data-toggle="popover" title="Upozornění"
                                        data-placement="top" data-content="Počet musí být větší než 0">
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-primary" id="add-to-cart-btn">Koupit</button>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-outline-secondary cartButton"
                                        data-dismiss="modal">Košík</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalCenterTitle"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cartTitle">Košík</h5>
                            <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex justify-content-center" id="cartLoading">
                                <div class="spinner-grow" role="status">
                                    <span class="sr-only"></span>
                                </div>
                            </div>
                            <table class="table table-striped table-borderless table-hover" id="cartLoaded">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">Položka</th>
                                        <th scope="col">Počet</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody id="cartBody">
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="orderOverviewButton"
                                data-dismiss="modal">Objednat</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="emptyCartModal" tabindex="-1" role="dialog"
                aria-labelledby="emptyCartModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="emptyCartTitle">Košík</h5>
                            <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Váš košík je prázdný.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Nakoupit</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="orderOverviewModal" tabindex="-1" role="dialog"
                aria-labelledby="orderOverviewCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cartTitle">Shrnutí objednávky</h5>
                            <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex justify-content-center" id="orderOverviewLoading">
                                <div class="spinner-grow" role="status">
                                    <span class="sr-only"></span>
                                </div>
                            </div>
                            <table class="table table-striped table-borderless table-hover" id="orderOverviewLoaded">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">Položka</th>
                                        <th scope="col">Počet</th>
                                        <th scope="col">Celkem s DPH</th>
                                        <th scope="col">Celkem bez DPH</th>
                                    </tr>
                                </thead>
                                <tbody id="orderOverviewBody">
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="contactFormButton"
                                data-dismiss="modal">Pokračovat k
                                fakturačním údajům</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="contactFormModal" tabindex="-1" role="dialog"
                aria-labelledby="contactFormCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cartTitle">Fakturační údaje</h5>
                            <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="row g-3 needs-validation" novalidate autocomplete="on">
                                <div class="col-md-4">
                                    <label for="validationCustom01" class="form-label">Křestní jméno</label>
                                    <input type="text" class="form-control" autocomplete="given-name"
                                        id="validationCustom01" value="" required>
                                    <div class="valid-feedback">
                                        &nbsp;
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="validationCustom02" class="form-label">Příjmení</label>
                                    <input type="text" class="form-control" autocomplete="family-name"
                                        id="validationCustom02" value="" required>
                                    <div class="valid-feedback">
                                        &nbsp;
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom03" class="form-label">Město</label>
                                    <input type="text" class="form-control" autocomplete="address-level2"
                                        id="validationCustom03" required>
                                    <div class="invalid-feedback">
                                        Prosím, zadejte město.
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="validationCustom04" class="form-label">Země</label>
                                    <select class="form-select" id="validationCustom04" required>
                                        <option selected disabled>Vybrat…</option>
                                        <option value="CZ">Česká republika</option>
                                        <option value="DE">Německo</option>
                                        <option value="AU">Rakousko</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Prosím, vyberte stát.
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom05" class="form-label">Ulice a č.p.</label>
                                    <input type="text" class="form-control" autocomplete="street-address"
                                        id="validationCustom05" required>
                                    <div class="invalid-feedback">
                                        Prosím, zadejte ulici a číslo popisné.
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="validationCustom06" class="form-label">PSČ</label>
                                    <input type="text" class="form-control" autocomplete="postal-code"
                                        id="validationCustom06" required>
                                    <div class="invalid-feedback">
                                        Prosím, zadejte platné PSČ.
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck"
                                            required>
                                        <label class="form-check-label" for="invalidCheck">
                                            Souhlasím se zpracováním osobních údajů a přečetl jsem si <a
                                                href="terms.pdf" target="_blank">Obchodní podmínky</a>
                                        </label>
                                        <div class="invalid-feedback">
                                            Pro pokračování prosím zaškrtněte.
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="deliveryAddress" value="">
                                        <label class="form-check-label" for="deliveryAddress">
                                            Jiná dodací adresa, než je adresa fakturační
                                        </label>
                                    </div>
                                </div>
                            </form>
                            <form class="row g-3 needs-validation" id="deliveryAddressForm" novalidate
                                autocomplete="on">
                                <div class="col-md-6">
                                    <label for="validationCustom07" class="form-label">Město</label>
                                    <input type="text" class="form-control" autocomplete="address-level2"
                                        id="validationCustom07" required>
                                    <div class="invalid-feedback">
                                        Prosím, zadejte město.
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="validationCustom08" class="form-label">Země</label>
                                    <select class="form-select" id="validationCustom08" required>
                                        <option selected disabled>Vybrat…</option>
                                        <option value="CZ">Česká republika</option>
                                        <option value="DE">Německo</option>
                                        <option value="AU">Rakousko</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Prosím, vyberte stát.
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom09" class="form-label">Ulice a č.p.</label>
                                    <input type="text" class="form-control" autocomplete="street-address"
                                        id="validationCustom09" required>
                                    <div class="invalid-feedback">
                                        Prosím, zadejte ulici a číslo popisné.
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="validationCustom10" class="form-label">PSČ</label>
                                    <input type="text" class="form-control" autocomplete="postal-code"
                                        id="validationCustom10" required>
                                    <div class="invalid-feedback">
                                        Prosím, zadejte platné PSČ.
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="submitContactForm">Pokračovat k
                                platbě</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentCenterTitle"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Platba a potvrezní</h5>
                            <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="card">
                                        <h5 class="card-header">Na dobírku</h5>
                                        <div class="card-body">
                                            <p class="card-text">Zaplatíte při převzetí zásilky</p>
                                            <a href="#" class="btn btn-primary">Potvrdit objednávku</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card">
                                        <h5 class="card-header">Fakturou</h5>
                                        <div class="card-body">
                                            <p class="card-text">Faktura bude odeslána na mail</p>
                                            <a href="#" class="btn btn-primary">Potvrdit objednávku</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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