<?php
include("../header.php");
include("../includes/dbConnection.inc.php");
?>

<?php
$sql = "SELECT * FROM categories";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
?>

<form action="../includes/encourageEmail.inc.php" method="post" enctype="multipart/form-data">
    <div class="">
        <label>Title</label>
        <input type="text" name="nTitle" placeholder="Title" required title="The title for your email."><br/>
        <label>Message</label><br/>
        <textarea name = "nMessage" class="cMessage" style="width:350px;height:100px" placehoder="Content of Email" required title="The content/message of the email."></textarea><br/>
        <button type="submit" name="send">Send</button>
    </div>
</form>

<?php
include("../footer.php");
?>