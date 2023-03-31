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
        $error_msg = "Cannot Empty Input";
        header("location:../position/admin/account.php?error=". urlencode($error_msg));
        exit(); //stop
    }
    if (invalidemail($email) !== false) {
        $error_msg = "Invalid Email";
        header("location:../position/admin/account.php?error=". urlencode($error_msg));
        exit(); //stop
    }
    if (invalidrepassword($password, $repeatpassword) !== false) {
        $error_msg = "Your password is invalid. Please enter a valid password.";
        header("location:../position/admin/account.php?error=". urlencode($error_msg));
        exit(); //stop
    }
    if (invalidpasswordlength($password) !== false) {
        $error_msg = "Your password is not enough length.";
        header("location:../position/admin/account.php?error=". urlencode($error_msg));        
        exit(); //stop
    }
    if (usernametaken($conn, $email) !== false) {
        $error_msg = "Username has been taken by other user.";
        header("location:../position/admin/account.php?error=". urlencode($error_msg));
        exit(); //stop
    }

    createUser($conn, $name, $email, $password, $department);
} else {
    header("location:../position/admin/account.php");
}
if (isset($_POST['login'])) {
    header("location:../position/admin/account.php");
}
