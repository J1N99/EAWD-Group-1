<?php
require_once("dbConnection.inc.php");
require_once("functions.inc.php");
$userid = $_POST['id'];
$id = $_POST['item_id'];
$up = 1;
$down = 0;


$sqlcheck = "SELECT * FROM likepost WHERE user_id=$userid AND idea_id=$id";
$result = mysqli_query($conn, $sqlcheck);
$resultCheck = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);
if ($resultCheck > 0) {
    $Oriup = $row['t_up'];
    $Oridown = $row['t_down'];
    if ($up == $Oriup) {
        $query = "UPDATE likepost SET t_up=0, t_down=0 WHERE user_id=$userid";
        $query_run = mysqli_query($conn, $query);
    } else {
        $query = "UPDATE likepost SET t_up=1, t_down=0 WHERE user_id=$userid";
        $query_run = mysqli_query($conn, $query);
    }
} else {
    $sql = "INSERT INTO likepost (idea_id,user_id,t_up,t_down) VALUES (?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:../listdetails.php?id=$id&error=stmterror2");
        exit(); //stop
    }


    mysqli_stmt_bind_param($stmt, "ssss", $id, $userid, $up, $down);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location:../listdetails.php?id=$id&status=success");
    exit();
}
