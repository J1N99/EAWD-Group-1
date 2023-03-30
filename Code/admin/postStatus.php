<?php
include("../header.php");
include("../includes/dbConnection.inc.php");
?>



<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle ms-5" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    Select Filter
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <li><a class="dropdown-item" href="../admin/postStatus.inc.php?desc=true">Posted</a></li>
        <li><a class="dropdown-item" href="../admin/postStatus.inc.php?asc=true">No Posted</a></li>
    </ul>
</div>

<div id = "myContent">
<p class = "title">Overview Status</p>
    <table>
        <tr><div class = "header">
            <th>No.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Numbers of Ideas</th>
    </div>
        </tr>


    <?php
    $i = 1;
        $query1 = mysqli_query($conn, "select * from user");
        //$query1 = mysqli_query($conn, "select user.user_id, user.name, user.email, idea.user_id from user
        //left join idea on user.user_id = idea.user_id
        //group by idea.user_id desc");
        if(mysqli_num_rows($query1)>0){
            while($row1 = mysqli_fetch_assoc($query1)){ 
            $idStaff = $row1['user_id'];
            //$query2 = mysqli_query($conn, "select * from idea where user_id = '$idStaff'");
            $query2 = mysqli_query($conn, "select * from idea where user_id = '$idStaff'");
            ?>
            <tr>
                <td><div id = "c1"><?php echo $i++."."; ?></div></td>
                <td><div id = "c1"><?php echo $row1['name']; ?></div></td>
                <td><div id = "c1"><?php echo $row1['email']; ?></div></td>
                <td><div id = "c1"><?php echo mysqli_num_rows($query2); ?></div></td>
            </tr>
        <?php }
    } ?>
</table>
</div>

<?php
include("../footer.php");
?>