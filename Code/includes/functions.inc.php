<?php
function emptyInputSignup($name, $email, $password, $repeatpassword)
{

    if (empty($name) || empty($email) || empty($password) || empty($repeatpassword)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidemail($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidrepassword($password, $repeatpassword)
{
    if ($password != $repeatpassword) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidpasswordlength($password)
{
    $length = strlen($password);
    if ($length < 6) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function usernametaken($conn, $email)
{


    $sql = "SELECT * FROM user WHERE email=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:../signup.php?error=stmterror1");
        exit(); //stop
    }
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}




function createUser($conn, $name, $email, $password)
{


    $sql = "INSERT INTO user (position,name,department,email,password) VALUES (?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:../signup.php?error=stmterror2");
        exit(); //stop
    }

    //suffer password
    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
    $position = 1;
    $department="staff";
    mysqli_stmt_bind_param($stmt, "sssss",$position ,$name,$department,$email, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location:../signup.php?error=none");
    exit();
}

function emptyInputLogin($email, $password)
{

    if (empty($email) || empty($password)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}


function loginuser($conn, $email, $password)
{
    $uidexists = usernametaken($conn, $email);
    if ($uidexists === false) {
      
        header("location:../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidexists["password"];
    $checkPassword = password_verify($password, $pwdHashed);
    if ($checkPassword === false) {
        header("location:../login.php?error=wronglogin");
        exit();
    } else {
        //open session to store global variable
        session_start();
        $_SESSION['id'] = $uidexists["user_id"];
        $_SESSION['position'] = $uidexists["position"];
        $_SESSION['name'] = $uidexists["name"];
        $_SESSION['department'] = $uidexists["department"];
        $_SESSION['email'] = $uidexists["email"];
        header("location:../index.php");
        exit();
    }
}

?>