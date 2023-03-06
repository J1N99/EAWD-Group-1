<?php  
include("header.php");
include("includes/dbConnection.inc.php");
// call for categories
$sql = "SELECT * FROM categories";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

?>

<form action="includes/addidea.inc.php" method="post" enctype="multipart/form-data">
    <div>
        <label>Categories:</label>



        <?php
                if ($resultCheck > 0) {
                    ?>
        <select name="did">
            <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id= $row["categories_id"];
                ?>
            <option value="<?php echo $id ?>"><?php echo $row['categories'] ?></option>
            <?php
                    }
                    ?>
        </select>

        <?php
                }
         ?>


        <br />
        <label>Idea Title:</label><br />
        <input type="text" name="title" required />
        <br />
        <label>Idea Description:</label><br />
        <textarea name="description" style="width:300px;height:100px;" required></textarea>

        <br />


        <label>Upload file:</label><br />
        <label style="color:red">Please upload the file in PDF(Not necessary to upload document)</label>
        <input type="file" name="uploadDocument" />
        <br />
        <label>Please read the term and condition and check the box:</label>
        <br />
        <input type="checkbox" name="checkbox" required />
        <a href="term.php">Term and condition</a>
        <input name="id" type="hidden" value="<?php echo $_SESSION['id']?>" />
        <br />

        <button type="submit" name="submit">Submit</button>

    </div>


</form>
<?php include("footer.php")?>