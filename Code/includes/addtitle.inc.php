<?php
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $closeDate = $_POST['closeDate'];
    $finalCloseDate = $_POST['finalCloseDate'];
    require_once("dbConnection.inc.php");
    require_once("functions.inc.php");


    createTitle($conn, $title, $closeDate, $finalCloseDate);
}