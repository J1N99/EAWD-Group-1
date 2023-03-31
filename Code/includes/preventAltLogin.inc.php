<?php
session_start();

if (!isset($_SESSION['email']) || $_SESSION['email'] !== true) {
    // Set the alert message
    $message = "Please perform login action before accessing to the internal system.";
    // Header need to be implemented below the alert message box
    // Do not use the php header function or else the message box will not popping up at all
    echo "<script>alert('$message');
    window.location.href='../Code/login.php';</script>";
    exit();
}
?>