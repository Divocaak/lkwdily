<div class="row mt-1">
    <div class="col-xs-2 col-md-3 col-lg-2">
        <div class="dropdown">
            <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button" id="sortByDropdown"
                data-toggle="dropdown" aria-expanded="false">Seřadit podle</a>
            <ul class="dropdown-menu" aria-labelledby="sortByDropdown">
                <li><a class="dropdown-item sortOption" data-sort-by="0">Cena <i class="bi bi-caret-up-fill"></i></a>
                </li>
                <li><a class="dropdown-item sortOption" data-sort-by="1">Cena <i class="bi bi-caret-down-fill"></i></a>
                </li>
                <li><a class="dropdown-item sortOption" data-sort-by="2">Abecedně <i class="bi bi-caret-up-fill"></i></a>
                </li>
                <li><a class="dropdown-item sortOption" data-sort-by="3">Abecedně <i class="bi bi-caret-down-fill"></i></a>
                </li>
                <li><a class="dropdown-item sortOption" data-sort-by="4">Kód produktu <i class="bi bi-caret-up-fill"></i></a>
                </li>
                <li><a class="dropdown-item sortOption" data-sort-by="5">Kód produktu <i class="bi bi-caret-down-fill"></i></a>
                </li>
                <li><a class="dropdown-item sortOption" data-sort-by="6">Skladem</a></li>
            </ul>
        </div>
    </div>
    <div class="col-xs-2 col-md-3 col-lg-2">
        <div class="input-group" id="searchInputField">
            <input type="text" class="form-control sm-2" placeholder="Orig. číslo, název">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="searchItemsButton"><i class="bi bi-search"></i></button>
            </div>
        </div>
    </div>
    <div class="col-xs-7 col-md-5 col-lg-7">
        <p>
            <?php
                $sql = 'SELECT id FROM part WHERE category' . $_SESSION["selectedCategorySql"]. ';';
                if ($result = mysqli_query($link, $sql)) {
                    $partsCount = mysqli_num_rows($result);
                    mysqli_free_result($result);
                }
                
                $pagesCount = $partsCount < 40 ? 1 : (round($partsCount / 40, 0) + ($partsCount % 40 != 0 && $partsCount > 40 ? 1 : 0)); 

                echo "<b>" . $_SESSION["selectedCategoryName"] . "</b>: <b>" . $partsCount . "</b> položek, rozděleno na <b>" . $pagesCount . "</b> stránek,
                        řazeno podle <b>" . $_SESSION["selectedSortName"] . "</b> | 
                        V košíku <b>" . (isset($_SESSION["cart"]) ? sizeof($_SESSION["cart"]) : 0) . "</b> položek za <b>" . "" . " Kč</b>";
                ?>
        </p>
    </div>
    <div class="col-xs-1 col-md-1 col-lg-1">
        <button type="button" class="btn btn-primary cartButton"><i class="bi bi-cart2"></i></button>
    </div>
</div>