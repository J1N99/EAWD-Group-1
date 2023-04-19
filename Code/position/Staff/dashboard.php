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
            <div class="container-fluid px-4">
                
                <div class="container">
                    <div class="text-center my-5">
                        <h1>All Title</h1> <hr/>
                    </div>
                    
                    
                </div>
                <!-- end container -->

                <!-- card container -->
                <div class="container">
                    <?php
                        $today = date('Y-m-d');
                        $sql = "SELECT * FROM title WHERE finalCloseDate >= '$today'";
                        $result = mysqli_query($conn, $sql);
                        $resultCheck = mysqli_num_rows($result);

                        if ($resultCheck > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['title_id'];
                                $title = $row['title'];
                                $closeDate = $row['closeDate'];
                                $finalCloseDate = $row['finalCloseDate'];
                                

                    ?>
                        
                    <div class="container mb-4">
                        <div class="align-items-center justify-content-center my-2">
                            <div class="card ">
                                <div class="p-4">                                    
                                    <div class="mb-4">
                                        <h5 class="card-title mb-0 pb-4"><?php echo $title?></h5>
                                    </div>
                                    <div class="row align-items-center mb-2 d-flex" style="font-size:0.85rem">
                                        <div class="col-11">
                                            <p class="d-flex align-self-start mb-0">
                                                Closure Date: <?php echo $closeDate ?>
                                            </p>
                                        </div> 
                                        <div class="col-11">
                                            <p class="d-flex align-self-start mb-0 ">
                                                Final Closure Date: <?php echo $finalCloseDate ?>
                                            </p>
                                        </div>    
                                        <div class="col align-self-end">
                                        <a href="./list-idea.php?id=<?php echo $id?>" class="btn btn-outline-secondary d-inline-flex rounded-0">Read More</a>
                                        </div>     
                                        
                                                                            
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>                    

                    <?php
                            }
                        }
                    ?>
                </div>
                <!-- card container end -->
            </div>
            <!-- content end -->

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="../../script.js"></script>
    

<?php
include("../../footer.php");
?>