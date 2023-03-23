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




function createUser($conn, $name, $email, $password, $department)
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

    mysqli_stmt_bind_param($stmt, "ssiss", $position, $name, $department, $email, $hashedPwd);
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
        if ($_SESSION['position'] == 1) {
            // if position is  QA manager redirect to admin pages;
            header("location:../admin/index.php");
        } else {
            header("location:../index.php");
        }
        exit();
    }
}

function categoriestaken($conn, $categories)
{

    $sql = "SELECT * FROM categories WHERE categories=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:../admin/addcategories.php?error=stmterror1");
        exit(); //stop
    }
    mysqli_stmt_bind_param($stmt, "s", $categories);
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

function createCategories($conn, $categories)
{
    $lowerCategories = strtolower($categories);

    $sql = "INSERT INTO categories (categories) VALUES (?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:../admin/addcategories.php?error=stmterror2");
        exit(); //stop
    }
    mysqli_stmt_bind_param($stmt, "s", $lowerCategories);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location:../admin/addcategories.php?error=none");
    exit();
}

function deleteCategories($conn, $id)
{
    $sql = "DELETE FROM categories WHERE categories_id=$id";

    if (!mysqli_query($conn, $sql)) {
        header("Location:../admin/addcategories.php?error=deletecartfail");
    } else {
        header("location:../admin/addcategories.php?error=none");
    }
}


function filevalidationpdf($img_name, $img_tempname, $conn, $categories, $description, $id, $title)
{


    //file type
    $filetype = pathinfo($img_name, PATHINFO_EXTENSION);
    //to lower case
    $filetypelower = strtolower($filetype);
    //allow file type
    $allowfiletype = array("pdf");
    $date = date("Y/m/d");
    //check file type
    if (in_array($filetypelower, $allowfiletype)) {
        //new PDF name to store in server 
        $newpdfname = uniqid("pdf-", true) . '.' . $filetypelower;
        $img_upload_path = "../uploads/" . $newpdfname;
        move_uploaded_file($img_tempname, $img_upload_path);
        insertIdea($id, $categories, $date, $description, $newpdfname, $conn, $title);
        //save db 
        //header("location:../submit.php?status=success");
    } else {
        //header("location:../submit.php?error=wrongfiletype");
        exit();
    }
}
function insertIdea($id, $categories, $date, $description, $newpdfname, $conn, $title)
{

    $sql = "INSERT INTO idea (document_url,categories_id,submitDate,user_id,description,title) VALUES (?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        //header("location:../submit.php?error=stmterror2");
        exit(); //stop
    }


    mysqli_stmt_bind_param($stmt, "ssssss", $newpdfname, $categories, $date, $id, $description, $title);
    mysqli_stmt_execute($stmt);
    //mysqli_stmt_close($stmt);
    //header("location:../submit.php?error=none");
    //exit();
}


function departmenttaken($conn, $department)
{

    $sql = "SELECT * FROM department WHERE department=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:../admin/adddepartment.php?error=stmterror1");
        exit(); //stop
    }
    mysqli_stmt_bind_param($stmt, "s", $department);
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

function createdepartment($conn, $department)
{
    $lowerDepartment = strtolower($department);


    $sql = "INSERT INTO department (department) VALUES (?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:../admin/adddepartment.php?error=stmterror2");
        exit(); //stop
    }
    mysqli_stmt_bind_param($stmt, "s", $lowerDepartment);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location:../admin/adddepartment.php?error=none");
    exit();
}


function deletedepartment($conn, $id)
{
    $sql = "DELETE FROM department WHERE department_id=$id";

    if (!mysqli_query($conn, $sql)) {
        header("Location:../admin/adddepartment.php?error=deletefail");
    } else {
        header("location:../admin/adddepartment.php?error=none");
    }
}
