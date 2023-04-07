<?php
include("../../header.php");
include("../../includes/dbConnection.inc.php");
?>

<link rel="stylesheet" href="../../style.css">
<link rel="stylesheet" href="css/title.css">

    <div class="d-flex" id="wrapper">

        <!--sidebar-->
        <?php 
            include("../../nav.php");
        ?>
        

            <!--Content-->
            <div class="container-fluid px-4">

                <!-- add title -->
                <div class="container">
                <?php
                    if (isset($_GET['error'])) { 
                        $error_msg = $_GET['error']; 
                        if ($error_msg == "none") {
                            ?>
                            <div class="d-flex justify-content-center mt-4 fade-out alert-box" role="alert">
                                <div class="alert alert-success">
                                    Uploaded Success
                                </div>
                            </div>
                            <?php
                        } else if ($error_msg == "closeDateBigger") {
                            ?>
                            <div class="d-flex justify-content-center mt-4 fade-out alert-box" role="alert">
                                <div class="alert alert-danger">
                                    Your final close date cannot early than close date
                                </div>
                            </div>
                            <?php
                        }    

                    }
                ?>
                    <div class="d-flex align-items-center justify-content-center mail-form">
                        <div class="mx-auto col-10 col-md-8 col-lg-6">
                            <form action="../../includes/addtitle.inc.php" method="post" enctype="multipart/form-data">
                                
                                <div class="form-group form-outline mb-4">
                                    <label class="form-label">Title</label>
                                    <input class="form-control" type="text" 
                                        name="title" placeholder="Title" 
                                        title="The title for your email." required><br/>
                                </div>

                                <div class="form-group form-outline mb-4">
                                    <label class="form-label">Closure Date</label>
                                    <input class="form-control" type="date" 
                                        name="closeDate" required><br/>
                                </div>

                                <div class="form-group form-outline mb-4">
                                    <label class="form-label">Final Closure Date</label>
                                    <input class="form-control" type="date" 
                                        name="finalCloseDate" required><br/>
                                </div>

                                <!-- Submit button -->
                                <button type="submit" name="submit" class="btn btn-secondary btn-block mb-4">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- add title end -->    

                
                
            </div>
            <!-- content-end -->

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>    
    <script src="./javascript/overview.js" type="text/javascript"></script>
    <script src="../../script.js"></script>    

<?php
include("../../footer.php");
?>