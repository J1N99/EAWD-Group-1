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
        header("location:../position/admin/account.php?error=stmterror1");
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
        header("location:../position/admin/account.php?error=stmterror2");
        exit(); //stop
    }

    //suffer password
    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
    $position = 1;

    mysqli_stmt_bind_param($stmt, "ssiss", $position, $name, $department, $email, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location:../position/admin/account.php?error=createSucess");
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
            // If the user is a QA Manager/Position ID is 1  	
            if ($_SESSION['position'] == 1)
            {
                header("location:../position/QA-Manager/dashboard.php");
            } 
            else // If the user is a QA Coordinator/Position ID is 2  
            if($_SESSION['position'] == 2)
            {
                header("location:../position/QA-Coordinator/dashboard.php");
            }
            else // If the user is an Admin/Position ID is 3
            if($_SESSION['position'] == 3)
            {
                header("location:../position/admin/dashboard.php");
            }
            else // If the user is a Staff/Position ID is 4  
            if($_SESSION['position'] == 4)
            {
                header("location:../position/Staff/dashboard.php");
            }
         // if ($_SESSION['position'] == 1) {
         //     // if position is  QA manager redirect to admin pages;
         //     header("location:../position/QA-Manager/dashboard.php");
         // } else {
         //     header("location:../index.php");
         // }
         exit();
    }
}

function categoriestaken($conn, $categories)
{

    $sql = "SELECT * FROM categories WHERE categories=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:../position/QA-Manager/category.php?error=stmterror1");
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
        header("location:../position/QA-Manager/category.php?error=stmterror2");
        exit(); //stop
    }
    mysqli_stmt_bind_param($stmt, "s", $lowerCategories);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location:../position/QA-Manager/category.php?error=addedSucess");
    exit();
}

function deleteCategories($conn, $id)
{    
    
    $sql = "DELETE FROM categories WHERE categories_id=$id";

    // Check if there is any records in the database
    $query1 = mysqli_query($conn, "select * from idea where categories_id = '$id'");
    if (mysqli_num_rows($query1) > 0) {
        // echo "<script>
        // window.location.href='../position/QA-Manager/category.php?error=categoryUsed';</script>";
        // exit();
        header("Location:../position/QA-Manager/category.php?error=categoryUsed");
        exit();
    }
    else
    if (!mysqli_query($conn, $sql)) {
        header("Location:../position/QA-Manager/category.php?error=deletefail");
    } else {
        header("location:../position/QA-Manager/category.php?error=deletedSucess");
    }
}


function filevalidationpdf($img_name, $img_tempname, $conn, $categories, $description, $id, $title,$astatus,$title_id)
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
        insertIdea($id, $categories, $date, $description, $newpdfname, $conn, $title,$astatus,$title_id);
        //save db 
        header("location:../submit.php?status=success");
    } else {
        header("location:../submit.php?error=wrongfiletype");
        exit();
    }
}
function insertIdea($id, $categories, $date, $description, $newpdfname, $conn, $title, $astatus, $title_id)
{

    $sql = "INSERT INTO idea (document_url,categories_id,submitDate,user_id,description,title,a_status,title_id) VALUES (?,?,?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        // header("location:../submit.php?error=stmterror2");
        // exit(); //stop
    }


    mysqli_stmt_bind_param($stmt, "ssssssss", $newpdfname, $categories, $date, $id, $description, $title,$astatus, $title_id);
    mysqli_stmt_execute($stmt);
    // mysqli_stmt_close($stmt);
    // header("location:../submit.php?error=none");
    // exit();
}


function departmenttaken($conn, $department)
{

    $sql = "SELECT * FROM department WHERE department=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:../position/admin/department.php?error=stmterror1");
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
        header("location:../position/admin/department.php?error=stmterror2");        
        exit(); //stop
    }
    mysqli_stmt_bind_param($stmt, "s", $lowerDepartment);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);    
    header("location:../position/admin/department.php?error=addedSucess");
    exit();
}


function deletedepartment($conn, $id)
{
    $sql = "DELETE FROM department WHERE department_id=$id";


    // Check if there is any records in the database
    $query1 = mysqli_query($conn, "select * from user where department = '$id'");
    if (mysqli_num_rows($query1) > 0) {
        // echo "<script>
        // window.location.href='../position/admin/department.php?error=departmentUsed';</script>";
        header("Location:../position/admin/department.php?error=departmentUsed");
        exit();
    }
    
    if (!mysqli_query($conn, $sql)) {
        header("Location:../position/admin/department.php?error=deletefail");
    } else {

        header("location:../position/admin/department.php?error=deletedSucess");
    }
}

function createTitle($conn, $title, $closeDate, $FinalCloseDate)
{
    $today = date('Y-m-d');

    if (strtotime($closeDate) < strtotime($today)) {
        header("Location:../position/admin/title.php?error=closeDateBiggerThanCurrent");
        exit();
    }

    if (strtotime($FinalCloseDate) < strtotime($today)) {
        header("Location:../position/admin/title.php?error=finalCloseDateBiggerThanCurrent");
        exit();
    }

    if (strtotime($closeDate) > strtotime($FinalCloseDate)) {
        header("Location:../position/admin/title.php?error=closeDateBiggerThanFinal");
        exit();
    } 



    $sql = "INSERT INTO title (title,closeDate,finalCloseDate) VALUES (?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:../position/admin/title.php?error=stmterror2");
        exit(); //stop
    }
    mysqli_stmt_bind_param($stmt, "sss", $title, $closeDate, $FinalCloseDate);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);        
    header("location:../position/admin/title.php?error=none");
    exit();
}