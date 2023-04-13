<?php
// Check if session is not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the $_SESSION['email'] has been assigned a value
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    // Set the alert message
    $message1 = "Please perform login action before accessing to the internal system.";
    // Implement the header below the alert message box
    echo "<script>alert('$message1');
    window.location.href='../../login.php';</script>";
    exit();
}

$url_path = $_SERVER['REQUEST_URI'];

$segments = explode('/', $url_path); // Split the path into segments
$place = $segments[5];

$QAM = "QA-Manager";
$QAC = "QA-Coordinator";
$admin = "admin";
$Staff = "Staff";

if($_SESSION['position'] == 1 && strpos($url_path, $QAM) === false)
{
    // Set the alert message
    $message = "You can only access to the internal system from the perspective of " . $QAM;
    // Implement the header below the alert message box
    echo "<script>alert('$message');
    window.location.href='../QA-Manager/dashboard.php';</script>";
    exit();
}
else if($_SESSION['position'] == 2 && strpos($url_path, $QAC) === false)
{
    // Set the alert message
    $message = "You can only access to the internal system from the perspective of " . $QAC;
    // Implement the header below the alert message box
    echo "<script>alert('$message');
    window.location.href='../QA-Coordinator/dashboard.php';</script>";
    exit();
}
else if($_SESSION['position'] == 3 && strpos($url_path, $admin) === false)
{
    // Set the alert message
    $message = "You can only access to the internal system from the perspective of " . $admin;
    // Implement the header below the alert message box
    echo "<script>alert('$message');
    window.location.href='../admin/dashboard.php';</script>";
    exit();
}
else if($_SESSION['position'] == 4 && strpos($url_path, $Staff) === false)
{
    // Set the alert message
    $message = "You can only access to the internal system from the perspective of " . $Staff;
    // Implement the header below the alert message box
    echo "<script>alert('$message');
    window.location.href='../Staff/dashboard.php';</script>";
    exit();
}


?>
