<?php
include("../header.php");
?>
<h2>
    <?php
    echo $_SESSION['id'];
    echo  $_SESSION['position'];
    echo   $_SESSION['name'];
    echo   $_SESSION['department'];
    echo  $_SESSION['email'];
    ?>
    <a href="addcategories.php">Add categories</a>
</h2>


<?php
include("../footer.php");
?>