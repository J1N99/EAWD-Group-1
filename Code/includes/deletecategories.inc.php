<?php
if (isset($_GET['category_id'])) {
    $id=$_GET['category_id'];
    require_once("dbConnection.inc.php");
    require_once("functions.inc.php");

    deleteCategories($conn,$id);
  

}
?>