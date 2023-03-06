<?php

$serverName = "localhost:3307";
$dbUserName = "root";
$dbUserPassword = "";
$dbName = "feedbackDB";

$conn = mysqli_connect($serverName, $dbUserName, $dbUserPassword, $dbName);

if (!$conn) {
    die("Connection failed " . mysqli_connect_error());
}