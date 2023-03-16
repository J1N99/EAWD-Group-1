<?php

require_once("dbConnection.inc.php");
require_once("functions.inc.php");
$item_id = $_POST['item_id'];
$count = $_POST['view_count'];

$query = "UPDATE idea SET views=$count WHERE idea_id=$item_id";
$query_run = mysqli_query($conn, $query);
