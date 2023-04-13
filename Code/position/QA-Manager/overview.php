<?php
include("../../header.php");
include("../../includes/dbConnection.inc.php");
include("../../includes/authLogin.inc.php");
?>

<link rel="stylesheet" href="../../style.css">

    <div class="d-flex" id="wrapper">

        <!--sidebar-->
        <?php 
            include("../../nav.php");
        ?>

            <!--Content-->
            <div class="dropdown mt-4">
                <button class="btn btn-secondary dropdown-toggle ms-4" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  Select Filter
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <li><a class="dropdown-item" href="./overview.php?overview=true">Overview</a></li>
                  <li><a class="dropdown-item" href="./overview.php?pending=true"">Pending</a></li>
                  <li><a class="dropdown-item" href="./overview.php?completed=true"">Completed</a></li>
                </ul>
            </div>

            <!-- table overview -->
            <div class="table-responsive m-4">
                <table class="table table-bordered table-secondary table-striped align-middle">
                    <tr>
                        <div class = "header">
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

                    // Getting today's date
                    $today = date('Y-m-d');

                    // Display the content in different order based on the drop down list
                    if(isset($_GET['overview']))
                    {
                        $query1 = mysqli_query($conn, "SELECT * FROM title");
                    }
                    else
                    if(isset($_GET['pending']))
                    {
                        //$query1 = mysqli_query($conn, "SELECT * FROM title ORDER BY finalCloseDate DESC");
                        $query1 = mysqli_query($conn, "SELECT * FROM title WHERE finalCloseDate >= '$today'");
                    }
                    else
                    if(isset($_GET['completed']))
                    {
                        $query1 = mysqli_query($conn, "SELECT * FROM title WHERE finalCloseDate < '$today'");
                    }

                    $status1 = "Pending";
                    $status1 = "Completed";

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
                                    echo "In Progress";
                                }
                                else
                                if($row1['finalCloseDate'] < $today)
                                {
                                    echo "Completed";
                                }
                                ?></div></td>
                            </tr>
                        <?php }
                    } ?>
                </table>
            </div>


        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>    
    <script src="./javascript/overview.js" type="text/javascript"></script>
    <script src="../../script.js"></script>

<?php
include("../../footer.php");
?>