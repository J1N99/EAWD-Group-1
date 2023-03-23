<?php
include("../header.php");
include("../includes/dbConnection.inc.php");

?>

<!-- add department-->
<form action="../includes/addtitle.inc.php" method="post" enctype="multipart/form-data">
    <div class="">

        <label>Title</label>
        <input type="text" name="title" placeholder="title" required><br />
        <label>Closure Date</label>
        <input type="date" name="closeDate" required><br />
        <label>Final Closure Date</label>
        <input type="date" name="FinalCloseDate" required><br />
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </div>
</form>





<?php
include("../footer.php");
?>