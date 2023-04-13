<?php
if (isset($_GET['id'])) {
  $id=$_GET['id'];
  
    require_once("dbConnection.inc.php");
    require_once("functions.inc.php");


    deletedepartment($conn, $id);
}
