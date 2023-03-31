<?php
include("../header.php");
include("../includes/dbConnection.inc.php");
?>

<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle ms-5" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    Select Filter
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <li><a class="dropdown-item" href="../admin/overviewStatus.php?overview=true">Overview</a></li>
        <li><a class="dropdown-item" href="../admin/overviewStatus.php?pending=true">Pending</a></li>
        <li><a class="dropdown-item" href="../admin/overviewStatus.php?completed=true">Completed</a></li>
    </ul>
</div>

<div id = "myContent">
<p class = "title">Overview Status</p>
    <table>
        <tr><div class = "header">
            <th>No.</th>
            <th>Title</th>
            <th>Closure Date</th>
            <th>Final Closure Date</th>
            <th>Status</th>
    </div>
        </tr>

    <?php
    // Setting the index of table
    $i = 1;
    // Display the content in different order based on the drop down list
    if(isset($_GET['overview']))
    {
        $query1 = mysqli_query($conn, "SELECT * FROM title");
    }
    else
    if(isset($_GET['pending']))
    {
        $query1 = mysqli_query($conn, "SELECT * FROM title ORDER BY finalCloseDate DESC");
    }
    else
    if(isset($_GET['completed']))
    {
        $query1 = mysqli_query($conn, "SELECT * FROM title ORDER BY finalCloseDate ASC");
    }

    $status1 = "In Progress";
    $status2 = "Completed";
    // Getting today's date
    $today = date('Y-m-d');
        if(mysqli_num_rows($query1)>0){
            while($row1 = mysqli_fetch_assoc($query1)){ 
            ?>
            <tr>
                <td><div id = "c1"><?php echo $i++."."; ?></div></td>
                <td><div id = "c1"><?php echo $row1['title']; ?></div></td>
                <td><div id = "c1"><?php echo $row1['closeDate']; ?></div></td>
                <td><div id = "c1"><?php echo $row1['finalCloseDate']; ?></div></td>
                <td><div id = "c1">
                <?php 
                if($row1['finalCloseDate'] >= $today)
                {
                    echo $status1;
                }
                else
                if($row1['finalCloseDate'] < $today)
                {
                    echo $status2;
                }
                ?></div></td>
            </tr>
        <?php }
    } ?>
</table>
</div>

<?php
include("../footer.php");
?>