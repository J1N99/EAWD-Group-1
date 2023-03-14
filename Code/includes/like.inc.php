<?php
require_once("dbConnection.inc.php");
require_once("functions.inc.php");
$userid=$_POST['id'];
$id=$_POST['item_id'];
$up=1;
$down=0;

$sql = "INSERT INTO likepost (idea_id,user_id,t_up,t_down) VALUES (?,?,?,?);";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location:../listdetails.php?id=$id&error=stmterror2");
    exit(); //stop
}


mysqli_stmt_bind_param($stmt, "ssss",$id,$userid,$up,$down);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
header("location:../listdetails.php?id=$id&status=success");
exit();
?>