<?php

if (isset($_POST["submit"])) {
    //initial variable to post value;
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeatpassword = $_POST['repassword'];
    $department = $_POST['did'];
    require_once("dbConnection.inc.php");
    require_once("functions.inc.php");

    if (emptyInputSignup($name, $email, $password, $repeatpassword) !== false) {
        header("location:../signup.php?error=emptyinput");
        exit(); //stop
    }
    if (invalidemail($email) !== false) {
        header("location:../signup.php?error=invalidemail");
        exit(); //stop
    }
    if (invalidrepassword($password, $repeatpassword) !== false) {
        header("location:../signup.php?error=passwordwrong");
        exit(); //stop
    }
    if (invalidpasswordlength($password) !== false) {
        header("location:../signup.php?error=invalidpassword");
        exit(); //stop
    }
    if (usernametaken($conn, $email) !== false) {
        header("location:../signup.php?error=usernametaken");
        exit(); //stop
    }

    createUser($conn, $name, $email, $password, $department);
} else {
    header("location:../signup.php");
}
if (isset($_POST['login'])) {
    header("location:../login.php");
}
