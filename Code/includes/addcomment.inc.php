<?php
	//start session
	session_start();
	
	//reference to the database connection file
	include('dbConnection.inc.php');
?>

<?php
      // Try Email - Start here
      // Query (nid to wait for db design)
      $query1 = mysqli_query($conn, "select user_id from idea where idea_id = ?");
      if(mysqli_num_rows($query1)>0){
        while($row1 = mysqli_fetch_assoc($query1)){ 
            $emailAuthor = $row1['email'];
        }
      }

      $email = $emailAuthor;

      $msg = "Try";

      $to = $email;
      $subject = "A new comment on your idea!";
      $message = "<div style='font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2;border:1px solid black'>
                  <div style='margin:50px auto;width:70%;padding:20px 0'>
                  <div style='border-bottom:1px solid #eee'>
                      <a href='' style='font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600'>Tempus</a>
                  </div>
                  <p style='font-size:1.1em'>Hi,</p>
                  <p>There is a new comment posted under your post.</p>
                  <h2 style='background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;' id = 'otp1'>".$msg."</h2>
                  <p style='font-size:0.9em;'>Regards,<br />Tempus</p>
                  <hr style='border:none;border-top:1px solid #eee' />
                  <div style='float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300'>
                      <p>Tempus Sdn. Bhd</p>
                      <p>14000 Bukit Mertajam</p>
                      <p>Pulau Pinang</p>
                  </div>
                  </div>
              </div>";
      $headers = "Content-type: text/html\r\n";
      
      if(mail($to, $subject, $message, $headers))
      {
          echo "<script>alert('try email done');</script>";
      }
      else
      {
          echo "There are some errors in sending the email. Please try again";
      }
      // Try Email - End here
?>