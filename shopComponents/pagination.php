<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <?php
            echo '<li class="page-item ' . ($_SESSION["openedPage"] == 1 ? "disabled" : "") . '">
                    <a class="page-link" href="?openedPage=1">První</a>
                </li>';
            echo '<li class="page-item ' . ($_SESSION["openedPage"] == 1 ? "disabled" : "") . '">
                    <a class="page-link" href="?openedPage=' . ($_SESSION["openedPage"] - 1) . '">Předchozí</a>
                </li>';

            $paginationActive = ($_SESSION["openedPage"] == 1 ? 0 : ($_SESSION["openedPage"] == $pagesCount ? ($pagesCount > 2 ? -2 : -1) : -1));
                         
            for($i = ($_SESSION["openedPage"] + $paginationActive); $i < $pagesCount + 1; $i++){
                if($i == ($_SESSION["openedPage"] - 1) || $i == $_SESSION["openedPage"] || $i == ($_SESSION["openedPage"] + 1)){
                    echo '<li class="page-item ' . ($_SESSION["openedPage"] == $i ? "active" : "") . '">
                    <a class="page-link" href="?openedPage=' . $i . '">' . $i . '</a>
                    </li>';
                }
                else{
                    continue;
                }
            }

            echo '<li class="page-item ' . ($_SESSION["openedPage"] == $pagesCount ? "disabled" : "") . '">
                    <a class="page-link" href="?openedPage=' . ($_SESSION["openedPage"] + 1) . '">Další</a>
                </li>';
            echo '<li class="page-item ' . ($_SESSION["openedPage"] == $pagesCount ? "disabled" : "") . '">
                <a class="page-link" href="?openedPage=' . ($pagesCount - 1) . '">Poslední</a>
            </li>';
        ?>
    </ul>
</nav>