<?php
if (isset($_POST['submit'])) {
    $id=$_POST['category_id'];
    require_once("dbConnection.inc.php");
    require_once("functions.inc.php");

    echo $id;

    deleteCategories($conn,$id);
  

}
?>