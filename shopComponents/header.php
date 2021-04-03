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
    <div class="col-8">
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

                if(!isset($_SESSION["selectedCategory"])){
                    $_SESSION["selectedCategory"] = " like '%'";
                }

                if(!isset($_SESSION["openedPage"])){
                    $_SESSION["openedPage"] = 1;
                }

                if(isset($_GET["sortBy"])){
                    $_SESSION["sortBy"] = intval($_GET["sortBy"]);
                    $_SESSION["openedPage"] = 1;
                }

                if(isset($_GET["selectedCategory"])){
                    if($_GET["selectedCategory"][0] != " "){
                        $_SESSION["selectedCategory"] = "=" . $_GET["selectedCategory"];
                    }
                    else{
                        $_SESSION["selectedCategory"] = " like '%'";
                    }

                    $_SESSION["openedPage"] = 1;
                }
                            
                if(isset($_GET["openedPage"])){
                    $_SESSION["openedPage"] = $_GET["openedPage"];
                }

                $sql = 'SELECT id FROM part WHERE category' . $_SESSION["selectedCategory"]. ';';
                if ($result = mysqli_query($link, $sql)) {
                    $partsCount = mysqli_num_rows($result);
                    mysqli_free_result($result);
                }

                $pagesCount = $partsCount < 40 ? 1 : (round($partsCount / 40, 0) + ($partsCount % 40 != 0 && $partsCount > 40 ? 1 : 0)); 

                echo "<b>" . $_SESSION["selectedCategory"] . "</b>: <b>" . $partsCount . "</b> položek, rozděleno na <b>" . $pagesCount . "</b> stránek,
                        řazeno podle <b>" . $textSort[$_SESSION["sortBy"]] . "</b> | 
                        V košíku <b>" . (isset($_SESSION["cart"]) ? sizeof($_SESSION["cart"]) : 0) . "</b> položek za <b>" . "" . " Kč</b>";
            ?>
        </p>
    </div>
    <div class="col-2">
        <button type="button" class="btn btn-primary cartButton"><i class="bi bi-cart2"></i></button>
    </div>
</div>