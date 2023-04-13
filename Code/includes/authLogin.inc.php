<?php
// Check if session is not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the $_SESSION['email'] has been assigned a value
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    // Set the alert message
    $message = "Please perform login action before accessing to the internal system.";
    // Implement the header below the alert message box
    echo "<script>alert('$message');
    window.location.href='../../login.php';</script>";
    exit();
}
?>
