<?php
include("header.php");
?>

<marquee>SEND HELP!!</marquee>
<h2>
    <?php
    echo $_SESSION['id'];
    echo  $_SESSION['position'];
    echo   $_SESSION['name'];
    echo   $_SESSION['department'];
    echo  $_SESSION['email'];
    ?>

</h2>
<?php include("footer.php");
