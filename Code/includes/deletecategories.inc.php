<?php
if (isset($_POST['submit'])) {
    $id=$_POST['did'];
    require_once("dbConnection.inc.php");
    require_once("functions.inc.php");


    deleteCategories($conn,$id);
  

}
?>