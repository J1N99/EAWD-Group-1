<?php
include("header.php");
?>
<?php
// redirected
if(!isset($_SESSION['id']))
{
  header("Location:login.php");
}
if (isset($_SESSION['position']))
{
    if($_SESSION['position']==1)
    {
        header("Location:position/QA-Manager/dashboard.php");
        exit();
    }
    if($_SESSION['position']==2)
    {
        header("Location:position/QA-Coordinator/dashboard.php");
        exit();
    }
    if($_SESSION['position']==3)
    {
        header("Location:position/admin/dashboard.php");
        exit();
    }
    if($_SESSION['position']==4)
    {
        header("Location:position/Staff/dashboard.php");
        exit();
    }
}
?>



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