<?php
require_once "config.php";
session_start();

$_SESSION["selectedCategorySql"] = returnCategorySql($_POST["newCategory"]);
$_SESSION["selectedCategoryName"] = returnCategoryName($_POST["newCategory"], $link);
unset($_SESSION["openedPage"]);
unset($_SESSION["searchText"]);
// nechat sort sql
// nechat sort name

function returnCategorySql($post){
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
    
    if($post == " like %"){
        return " like '%'";
    }
    else
    {
        if(intval($post) < 85){
            return $allCategories[intval($post)];
        }
        else if(intval($post) == 85){
            return "=85";
        }
        else
        {
            return ("=" . $post);
        }
    }
}
function returnCategoryName($post, $link){
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

    if($post == " like %"){
        return "Všechny díly";
    }
    else
    {
        if(intval($post) < 85){
            return $textAllCategories[intval($post)];
        }
        else if(intval($post) == 85){
            return "Domů";
        }
        else
        {
            $sql = 'SELECT name FROM category WHERE id=' . $post . ';';
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