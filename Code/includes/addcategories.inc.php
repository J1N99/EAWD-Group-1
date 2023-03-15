<?php
if (isset($_POST['submit'])) {
    $categories=$_POST['categories'];
    require_once("dbConnection.inc.php");
    require_once("functions.inc.php");

    if (categoriestaken($conn, $categories) !== false) {
        header("location:../admin/categories.php?error=categoriestaken");
        exit(); //stop
    }
    
    createCategories($conn,$categories);
}
