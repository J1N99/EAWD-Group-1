<?php
include("header.php");
include("includes/dbConnection.inc.php");
$sql = "SELECT * FROM department";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
?>

<form action="includes/signup.inc.php" method="post">



    <div class="form-floating mb-3 align-middle">
        <label>Full Name</label>
        <input type="text" name="name" placeholder="Name">
    </div>
    <div>
        <label>Email</label>
        <input type="email" name="email" placeholder="Email">
    </div>

    <!--start of department-->

    <?php
    if ($resultCheck > 0) {
    ?>
        <label>Department:</label>
        <select name="did">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row["department_id"];
            ?>
                <option value="<?php echo $id ?>"><?php echo $row['department'] ?></option>
            <?php
            }

            ?>
        </select>
    <?php
    } ?>
    <div>
        <label>Password</label>
        <input type="password" name="password" placeholder="Password">

    </div>

    <div>
        <label>Repeat Password</label>
        <input type="password" name="repassword" placeholder="Repeat Password">

    </div>

    <div>

        <button type="submit" name="submit">Sign Up</button>



    </div>
    <!-- horizontal Line-->
    <hr class="my-4">
    <!--end SECTION-->
    <div class="d-grid mb-2">
        <a href="index.php" style="color:#724b26;">
            Back to home page</a>
    </div>

</form>
<?php
include("footer.php");
?>