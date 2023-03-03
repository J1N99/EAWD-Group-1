<?php
if (isset($_POST['submit'])) {
    $email = $_POST["email"];
    $password = $_POST['password'];

    require_once("dbConnection.inc.php");
    require_once("functions.inc.php");

    if (emptyInputLogin($email, $password) !== false) {
        header("location:../login.php?error=emptyinput");
        exit();
    }
    loginuser($conn, $email, $password);
} else {
    header("location:../login.php");
}
if (isset($_POST['signup'])) {
    header("location:../signup.php");
}
