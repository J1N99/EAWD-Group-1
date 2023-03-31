<?php
require_once("dbConnection.inc.php");
require_once("functions.inc.php");

if (isset($_POST['submit'])) {
    $categories = $_POST['did'];
    $description = $_POST['description'];
    $title = $_POST['title'];


    if(isset($_POST['my_checkbox'])){
      $astatus = 1;
    }else{
      $astatus = 0;
    }

    $img_name = $_FILES['uploadDocument']['name'];
    $img_size = $_FILES['uploadDocument']['size'];
    $img_tempname = $_FILES['uploadDocument']['tmp_name'];
    $error = $_FILES['uploadDocument']['error'];
    $id = $_POST['id'];
    $title_id = $_POST['titleid'];
  

    if ($_FILES['uploadDocument']['size'] == 0) {
        $newpdfname = "";
        $date = date("Y/m/d");
        insertIdea($id, $categories, $date, $description, $newpdfname, $conn, $title, $astatus, $title_id);
    } else {
        filevalidationpdf($img_name, $img_tempname, $conn, $categories, $description, $id, $title, $astatus, $title_id);
    }


  // Email function for Quality Assurance (QA) Coordinator - Start here
  // Queries
  $query1 = mysqli_query($conn, "select * from user where user_id = '$id'");
  if (mysqli_num_rows($query1) > 0) {
      while ($row1 = mysqli_fetch_assoc($query1)) {
          $nameAuthor = $row1['name'];
      }
  }

  // Retrieve all the email address of Quality Assurance (QA) Coordinator
  $posQAC = 2;
  $query2 = mysqli_query($conn, 'select * from user where position = "2"');
  if (mysqli_num_rows($query2) > 0) {
      while ($row2 = mysqli_fetch_assoc($query2)) {
          // Assign the value of email to a variable
          $emailQAC = $row2['email'];
          $nameQAC = $row2['name'];

            // Contents of Email
            $subjectQAC = "A new idea has been posted";
            if($astatus == 1)
            {
              $messageQAC = "<div style='font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2;border:1px solid black'>
              <div style='margin:50px auto;width:70%;padding:20px 0'>
              <div style='border-bottom:1px solid #eee'>
                  <a href='' style='font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600'>GGIT</a>
              </div>
              <p style='font-size:1.1em'>Hi, " . $nameQAC . ",</p>
              <p>Date: " . $date . "</p><br>
              <p>A new idea with title <b>[" . $title . "]</b> has been posted:-</p><br>
              <h2 style='background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;' id = 'otp1'>" . $description . "</h2>
              <p>Posted By: Anonymous</p>
              <p style='font-size:0.9em;'>Regards,<br />GGIT</p>
              <hr style='border:none;border-top:1px solid #eee' />
              <div style='float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300'>
                  <p>GGIT</p>
                  <p>14000 Bukit Mertajam</p>
                  <p>Pulau Pinang</p>
              </div>
              </div>
              </div>";
            }
            else
            if($astatus == 0)
            {
              $messageQAC = "<div style='font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2;border:1px solid black'>
              <div style='margin:50px auto;width:70%;padding:20px 0'>
              <div style='border-bottom:1px solid #eee'>
                  <a href='' style='font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600'>GGIT</a>
              </div>
              <p style='font-size:1.1em'>Hi, [" . $nameQAC . "],</p>
              <p>Date: " . $date . "</p><br>
              <p>A new idea with title <b>[" . $title . "]</b> has been posted:-</p><br>
              <h2 style='background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;' id = 'otp1'>" . $description . "</h2>
              <p>Posted By: " . $nameAuthor . "</p>
              <p style='font-size:0.9em;'>Regards,<br />GGIT</p>
              <hr style='border:none;border-top:1px solid #eee' />
              <div style='float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300'>
                  <p>GGIT</p>
                  <p>14000 Bukit Mertajam</p>
                  <p>Pulau Pinang</p>
              </div>
              </div>
              </div>";
            }


            $headers = "Content-type: text/html\r\n";

          if(mail($emailQAC, $subjectQAC, $messageQAC, $headers)) {
            echo "<script>alert('Email has been sent.');</script>";
            //header("location:../listdetails.php?id=$id&emailstatus=success");
        } else {
            echo "<script>alert('There are some errors in sending the email. Please try again');</script>";
        }
      }
  }
  // Email function for Quality Assurance (QA) Coordinator - End here
  header("location:../position/Staff/list-idea.php?status=success&id=$title_id");
}