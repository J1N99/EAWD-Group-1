<?php
include("../../header.php");
include("../../includes/dbConnection.inc.php");
include("../../includes/authLogin.inc.php");
?>

<link rel="stylesheet" href="../../style.css">
<link rel="stylesheet" href="css/encourage-mail.css">

    <div class="d-flex" id="wrapper">

        <!--sidebar-->
        <?php 
            include("../../nav.php");
        ?>
            <!-- content start -->

            <?php
                $sql = "SELECT * FROM categories";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
            ?>

            <?php
                if(isset($_GET['status'])) {
                    $status_msg = $_GET['status'];

                    if($status_msg == "success") {
                        ?>
                            <div class="d-flex justify-content-center mt-4 fade-out alert-box" role="alert">
                                <div class="alert alert-success">
                                    Sent Successful
                                </div>
                            </div>
                        <?php
                    }
                }

            ?>

            <div class="container">
                <div class="d-flex align-items-center justify-content-center mail-form">
                    <div class="mx-auto col-10 col-md-8 col-lg-6">
                        <form action="../../includes/encourageEmail.inc.php" method="post" enctype="multipart/form-data">
                            <!-- Name input -->
                            <div class="form-group form-outline mb-4">
                                <label class="form-label">Title</label>
                                <input class="form-control" type="text" 
                                    name="nTitle" placeholder="Title" 
                                    title="The title for your email." required><br/>
                            </div>

                            <!-- Message input -->
                            <div class="form-group form-outline mb-4">                    
                                <label class="form-label" for="form4Example3">Message</label>
                                <textarea class="form-control cMessage" name="nMessage"
                                    placehoder="Content of Email" 
                                    title="The content/message of the email." rows="4" required >
                                </textarea>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" name="send" class="btn btn-secondary btn-block mb-4">Send</button>
                        </form>
                    </div>
                </div>
            </div>

            


        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>    
    <script src="./javascript/overview.js" type="text/javascript"></script>
    <script src="../../script.js"></script>

<?php
include("../../footer.php");
?>