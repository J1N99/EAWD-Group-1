<?php
include("header.php");
?>

<form action="includes/login.inc.php" method="post">
    <div>
        <label>Email</label>
        <input type="text" name="email" placeholder="Email">

    </div>
    <div>
        <label>Password</label>
        <input type="password" name="password" placeholder="Password">

    </div>

    <div class="d-grid">

        <button type="submit" name="submit">Log in</button>
        <button type="submit" name="signup">Sign Up</button>



    </div>



    <!--end SECTION-->
    <div>
        <a href="index.php">
            Back to home page</a>
    </div>

</form>

<?php
include("footer.php");
?>