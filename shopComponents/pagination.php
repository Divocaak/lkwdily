<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <?php
            echo '<li class="page-item ' . enableOrDisable(1) . '">
                    <a class="page-link paginationPage" data-new-page-number="1">První</a>
                </li>';
            echo '<li class="page-item ' . enableOrDisable(1) . '">
                    <a class="page-link paginationPage" data-new-page-number="' . ($_SESSION["openedPage"] - 1) . '">Předchozí</a>
                </li>';

            $paginationActive = ($_SESSION["openedPage"] == 1 ? 0 : ($_SESSION["openedPage"] == $pagesCount ? ($pagesCount > 2 ? -2 : -1) : -1));
                         
            for($i = ($_SESSION["openedPage"] + $paginationActive); $i < $pagesCount + 1; $i++){
                if($i == ($_SESSION["openedPage"] - 1) || $i == $_SESSION["openedPage"] || $i == ($_SESSION["openedPage"] + 1)){
                    echo '<li class="page-item ' . ($_SESSION["openedPage"] == $i ? "active" : "") . '">
                    <a class="page-link paginationPage" data-new-page-number="' . $i . '">' . $i . '</a>
                    </li>';
                }
                else{
                    continue;
                }
            }

            echo '<li class="page-item ' . enableOrDisable($pagesCount) . '">
                    <a class="page-link paginationPage" data-new-page-number="' . ($_SESSION["openedPage"] + 1) . '">Další</a>
                </li>';
            echo '<li class="page-item ' . enableOrDisable($pagesCount) . '">
                <a class="page-link paginationPage" data-new-page-number="' . ($pagesCount - 1) . '">Poslední</a>
            </li>';

            function enableOrDisable($checkWith){
                return ($_SESSION["openedPage"] == $checkWith ? "disabled" : "");
            }
        ?>
    </ul>
</nav>