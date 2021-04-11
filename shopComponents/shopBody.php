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