<?php
require_once("dbConnection.inc.php");
require_once("functions.inc.php");
$userid = $_POST['id'];
$id = $_POST['item_id'];
$comment = $_POST['comment'];
$date = date("Y/m/d");
$checkbox = $_POST['checkbox'];

$sql = "INSERT INTO comment (user_id,a_status,commentDate,idea_id,comment) VALUES (?,?,?,?,?);";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location:../listdetails.php?id=$id&commenterror=stmterror2");
    exit(); //stop
}
mysqli_stmt_bind_param($stmt, "sisss", $userid, $checkbox, $date, $id, $comment);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
header("location:../listdetails.php?id=$id&commentstatus=success");
exit();
