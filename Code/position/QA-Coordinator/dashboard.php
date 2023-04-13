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

            <?php 
                // Execute the query
                $result1 = mysqli_query($conn, "SELECT * FROM title");
                $result2 = mysqli_query($conn, "SELECT * FROM idea");
                $result3 = mysqli_query($conn, "SELECT * FROM comment");
                $result4 = mysqli_query($conn, "SELECT * FROM idea WHERE document_url IS NOT NULL AND document_url <> ''");

                // Get the total number of records
                $total_title = mysqli_num_rows($result1);
                $total_records = mysqli_num_rows($result2);
                $total_comments = mysqli_num_rows($result3);
                $total_pdf = mysqli_num_rows($result4);
            ?>

            <!--Content-->
            <div class="container-fluid px-4">
                
                <div class="row g-3 my-2">
                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?php echo $total_title ?></h3>
                                <p class="fs-5">Titles</p>
                            </div>
                            <i class="fas fa-truck fs-1 border rounded-full icon-background p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?php echo $total_records ?></h3>
                                <p class="fs-5">Ideas</p>
                            </div>
                            <i class="fas fa-truck fs-1 border rounded-full icon-background p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?php echo $total_comments ?></h3>
                                <p class="fs-5">Comments</p>
                            </div>
                            <i class="fas fa-truck fs-1 border rounded-full icon-background p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?php echo $total_pdf ?></h3>
                                <p class="fs-5">PDF Uploaded</p>
                            </div>
                            <i class="fas fa-truck fs-1 border rounded-full icon-background p-3"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="../../script.js"></script>


<?php
include("../../footer.php");
?>