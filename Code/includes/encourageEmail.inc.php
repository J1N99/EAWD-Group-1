<?php
    session_start();
    require_once("dbConnection.inc.php");

    if (isset($_POST['send']))
    {
    // Email function - Start here
    // Get the details of the Email
    $title = $_POST['nTitle'];
    $content = $_POST['nMessage'];
    $date = date("Y/m/d");

    // Get the details of Sender (QAC)
    $emailAuthor = $_SESSION["email"];

    // Retrieve the details of the author
    $query1 = mysqli_query($conn, "select * from user where email = '$emailAuthor'");
    if (mysqli_num_rows($query1) > 0) {
        while ($row1 = mysqli_fetch_assoc($query1)) {
            $idAuthor = $row1['user_id'];
            $nameAuthor = $row1['name'];
        }
    }

    // Loop through each user and sending the encouragement message to all of them
    $query2 = mysqli_query($conn, 'select * from user where position = "3" or position = "4"');
    if (mysqli_num_rows($query2) > 0) {
        while ($row2 = mysqli_fetch_assoc($query2)) {
            // Assign the value of email to a variable
            $emailStaff = $row2['email'];
            $nameStaff = $row2['name'];
  
              // Contents of Email
              $subject = $title;

              $message = "<div style='font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2;border:1px solid black'>
              <div style='margin:50px auto;width:70%;padding:20px 0'>
              <div style='border-bottom:1px solid #eee'>
                  <a href='' style='font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600'>GGIT</a>
              </div>
              <p style='font-size:1.1em'>Hi, " . $nameStaff . ",</p>
              <p>A new message from the Senior Leadership.</p><br>
              <h2 style='background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;' id = 'otp1'>" . trim($content) . "</h2>
              <p>Posted By: " . $nameAuthor . "</p><br>
              <p>Date: " . $date . "</p><br>
              <p style='font-size:0.9em;'>Regards,<br />GGIT</p>
              <hr style='border:none;border-top:1px solid #eee' />
              <div style='float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300'>
                  <p>GGIT</p>
                  <p>14000 Bukit Mertajam</p>
                  <p>Pulau Pinang</p>
              </div>
              </div>
              </div>";
  
  
              $headers = "Content-type: text/html\r\n";
  
            if(mail($emailStaff, $subject, $message, $headers)) {
              echo "<script>
              window.location.href='../position/QA-Coordinator/encourage-mail.php?status=success';</script>";
              //header("location:../listdetails.php?id=$id&emailstatus=success");
            } else {
                echo "<script>alert('There are some errors in sending the email. Please try again');</script>";
            }
        }
    }

    //header("location:../position/QA-Coordinator/encourage-mail.php?status=success");



    }
?>