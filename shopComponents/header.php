<div class="row mt-1">
    <div class="col-2">
        <div class="dropdown">
            <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button" id="sortByDropdown"
                data-toggle="dropdown" aria-expanded="false">Seřadit podle</a>
            <ul class="dropdown-menu" aria-labelledby="sortByDropdown">
                <li><a class="dropdown-item" href="?sortBy=0">Cena <i class="bi bi-caret-up-fill"></i></a>
                </li>
                <li><a class="dropdown-item" href="?sortBy=1">Cena <i class="bi bi-caret-down-fill"></i></a>
                </li>
                <li><a class="dropdown-item" href="?sortBy=2">Abecedně <i class="bi bi-caret-up-fill"></i></a>
                </li>
                <li><a class="dropdown-item" href="?sortBy=3">Abecedně <i class="bi bi-caret-down-fill"></i></a>
                </li>
                <li><a class="dropdown-item" href="?sortBy=4">Kód produktu <i class="bi bi-caret-up-fill"></i></a>
                </li>
                <li><a class="dropdown-item" href="?sortBy=5">Kód produktu <i class="bi bi-caret-down-fill"></i></a>
                </li>
                <li><a class="dropdown-item" href="?sortBy=6">Skladem</a></li>
            </ul>
        </div>
    </div>
    <div class="container col-2">
        <div class="input-group" id="searchInputField">
            <input type="text" class="form-control sm-2" placeholder="Orig. číslo, název">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="searchItemsButton"><i class="bi bi-search"></i></button>
            </div>
        </div>
    </div>
    <div class="col-7">
        <p>
            <?php
                $sqlSort = ["price ASC", "price DESC", "name ASC", "name DESC", "code ASC", "code DESC", "storage DESC"];
                $textSort = ['Cena <i class="bi bi-caret-up-fill"></i>',
                'Cena <i class="bi-caret-down-fill"></i>',
                'Abecedně <i class="bi-caret-up-fill"></i>',
                'Abecedně <i class="bi-caret-down-fill"></i>',
                'Kód produktu <i class="bi-caret-up-fill"></i>',
                'Kód produktu <i class="bi-caret-down-fill"></i>',
                'Skladem'];
                
                if(!isset($_SESSION["sortBy"])){
                    $_SESSION["sortBy"] = 2;
                }
                
                if(!isset($_SESSION["openedPage"])){
                    $_SESSION["openedPage"] = 1;
                }
                
                if(isset($_GET["openedPage"])){
                    $_SESSION["openedPage"] = $_GET["openedPage"];
                }
                
                if(isset($_GET["sortBy"])){
                    $_SESSION["sortBy"] = intval($_GET["sortBy"]);
                    $_SESSION["openedPage"] = 1;
                }

                $categoryName = returnCategory($link);                            
                
                $sql = 'SELECT id FROM part WHERE category' . $_SESSION["selectedCategory"]. ';';
                if ($result = mysqli_query($link, $sql)) {
                    $partsCount = mysqli_num_rows($result);
                    mysqli_free_result($result);
                }
                
                $pagesCount = $partsCount < 40 ? 1 : (round($partsCount / 40, 0) + ($partsCount % 40 != 0 && $partsCount > 40 ? 1 : 0)); 

                echo "<b>" . $categoryName . "</b>: <b>" . $partsCount . "</b> položek, rozděleno na <b>" . $pagesCount . "</b> stránek,
                        řazeno podle <b>" . $textSort[$_SESSION["sortBy"]] . "</b> | 
                        V košíku <b>" . (isset($_SESSION["cart"]) ? sizeof($_SESSION["cart"]) : 0) . "</b> položek za <b>" . "" . " Kč</b>";
                ?>
        </p>
    </div>
    <div class="col-1">
        <button type="button" class="btn btn-primary cartButton"><i class="bi bi-cart2"></i></button>
    </div>
</div>

<?php
    function returnCategory($link){
        $allCategories = [
            " BETWEEN 86 AND 142",
            "=87 OR category=88 OR category=89 OR category=90 OR category=91 OR category=92 OR category=93 OR category=94 OR category=95 OR category=96 OR category=97",
            "=88 OR category=89 OR category=90 OR category=91",
            "=98 OR category=99 OR category=100 OR category=101 OR category=102 OR category=103 OR category=104 OR category=105 OR category=106 OR category=107",
            "=108 OR category=109 OR category=110 OR category=111 OR category=112 OR category=113 OR category=114 OR category=115 OR category=116",
            "=117 OR category=118 OR category=119 OR category=120 OR category=121 OR category=122 OR category=123 OR category=124 OR category=125",
            "=126 OR category=127 OR category=128 OR category=129 OR category=130 OR category=131 OR category=132",
            "=133 OR category=134 OR category=135 OR category=136",
            "=137 OR category=138 OR category=139 OR category=140 OR category=141 OR category=142",
            "=143 OR category=144 OR category=145 OR category=146 OR category=147 OR category=148 OR category=149 OR category=150 OR category=151",
            "=152 OR category=153 OR category=154"
        ];
        $textAllCategories = [
            "Karosářské díly",
            "DAF",
            "XF 106",
            "Iveco",
            "MAN",
            "Mercedes Benz",
            "Renault",
            "Scania",
            "Volvo",
            "Osvětlení",
            "Brzdové segmenty"
        ];

        if(!isset($_SESSION["selectedCategory"])){
            $_SESSION["selectedCategory"] = " like '%'";
        }

        if($_GET["selectedCategory"] == " like %"){
            $_SESSION["selectedCategory"] = " like '%'";
            return "Všechny díly";
        }
        else
        {
            if($_GET["selectedCategory"] < 85){
                $_SESSION["selectedCategory"] = $allCategories[$_GET["selectedCategory"]];
                return $textAllCategories[intval($_GET["selectedCategory"])];
            }
            else if($_GET["selectedCategory"] == 85){
                $_SESSION["selectedCategory"] = "=85";
                return "Domů";
            }
            else
            {
                $_SESSION["selectedCategory"] = "=" . $_GET["selectedCategory"];
                $sql = 'SELECT name FROM category WHERE id=' . $_GET["selectedCategory"] . ';';
                if ($result = mysqli_query($link, $sql)) {
                    while ($row = mysqli_fetch_row($result)) {
                        return $row[0];
                        mysqli_free_result($result);
                    }
                }
            }
        }
    }
?>