<?php
require_once("dbConnection.inc.php");
require_once("functions.inc.php");
$userid = $_POST['id'];
$id = $_POST['item_id'];
$comment = $_POST['comment'];
$date = date("Y/m/d");
$checkbox = $_POST['checkbox'];

$sql = "INSERT INTO comment (user_id,a_status,commentDate,idea_id,comment) VALUES (?,?,?,?,?);";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location:../listdetails.php?id=$id&commenterror=stmterror2");
    exit(); //stop
}
mysqli_stmt_bind_param($stmt, "sisss", $userid, $checkbox, $date, $id, $comment);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
header("location:../listdetails.php?id=$id&commentstatus=success");
exit();
?>

<?php
    // Try Email - Start here
    // Get the details of the user who submit the comment
    $userid = $_POST['id'];
    $id = $_POST['item_id'];
    $comment = $_POST['comment'];
    $date = date("Y/m/d");

    // Queries
    // Retrieve the user id of the author towards that particular post
    $query1 = mysqli_query($conn, "select user_id from idea where idea_id = '$id'");
    if (mysqli_num_rows($query1) > 0) {
        while ($row1 = mysqli_fetch_assoc($query1)) {
            $idAuthor = $row1['user_id'];
        }
    }

    // Retrieve the email address of the author towards that particular post
    $query2 = mysqli_query($conn, "select * from user where user_id = '$idAuthor'");
    if (mysqli_num_rows($query2) > 0) {
        while ($row2 = mysqli_fetch_assoc($query2)) {
            $nameAuthor = $row2['name'];
            $emailAuthor = $row2['email'];
        }
    }

    // Retrieve the details of the sender towards that particular post
    $query3 = mysqli_query($conn, "select * from user where user_id = '$id'");
    if (mysqli_num_rows($query3) > 0) {
        while ($row3 = mysqli_fetch_assoc($query3)) {
            $nameSender = $row3['name'];
            $emailSender = $row3['email'];
        }
    }

    $to = $emailAuthor;
    $subject = "A new comment on your idea!";
    $message = "<div style='font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2;border:1px solid black'>
                    <div style='margin:50px auto;width:70%;padding:20px 0'>
                    <div style='border-bottom:1px solid #eee'>
                        <a href='' style='font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600'>Tempus</a>
                    </div>
                    <p style='font-size:1.1em'>Hi,</p>
                    <p>There is a new comment posted under your post.[" . $date . "]</p><br>
                    <p>" . $comment . "</p><br>
                    <p>By: " . $nameSender . "</p>
                    <h2 style='background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;' id = 'otp1'>" . $msg . "</h2>
                    <p style='font-size:0.9em;'>Regards,<br />Tempus</p>
                    <hr style='border:none;border-top:1px solid #eee' />
                    <div style='float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300'>
                        <p>Footer Pending...</p>
                    </div>
                    </div>
                </div>";
    $headers = "Content-type: text/html\r\n";

    if (mail($to, $subject, $message, $headers)) {
        echo "<script>alert('try email done');</script>";
    } else {
        echo "There are some errors in sending the email. Please try again";
    }
    // Try Email - End here
?>