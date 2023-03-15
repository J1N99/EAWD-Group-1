<?php
if (isset($_POST['submit'])) {
    $categories=$_POST['did'];
    $description=$_POST['description'];
    $title=$_POST['title'];
    
    $img_name = $_FILES['uploadDocument']['name'];
    $img_size = $_FILES['uploadDocument']['size'];
    $img_tempname = $_FILES['uploadDocument']['tmp_name'];
    $error = $_FILES['uploadDocument']['error'];
    $id=$_POST['id'];

  

    require_once("dbConnection.inc.php");
    require_once("functions.inc.php");


    if($_FILES['uploadDocument']['size'] == 0) {
      $newpdfname="";
      $date=date("Y/m/d");
      insertIdea($id,$categories,$date,$description,$newpdfname,$conn,$title);
    }
    else{
    filevalidationpdf($img_name, $img_tempname, $conn,$categories,$description,$id,$title);
    }
  
}
