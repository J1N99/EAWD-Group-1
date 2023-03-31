<?php
if (isset($_POST['submit'])) {
    $id = $_POST['department_id'];
    require_once("dbConnection.inc.php");
    require_once("functions.inc.php");


    deletedepartment($conn, $id);
}
