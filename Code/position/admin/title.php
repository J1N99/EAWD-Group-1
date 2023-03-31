<?php
include("../../header.php");
include("../../includes/dbConnection.inc.php");
?>

<link rel="stylesheet" href="../../style.css">
<link rel="stylesheet" href="css/title.css">

    <div class="d-flex" id="wrapper">

        <!--sidebar-->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
                <i class="fas fa-user-secret me-2"></i>Test
            </div>

            <div class="list-group list-group-flush my-3">
                <a href="./dashboard.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-tachometer-alt me-2"></i>DashBoard
                </a>

                <a href="./account.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">                    
                    <i class="fas fa-sharp fa-solid fa-lightbulb me-2"></i>Account
                </a>
                
                <a href="./department.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">                    
                    <i class="fas fa-sharp fa-solid fa-lightbulb me-2"></i>Department
                </a> 

                <a href="./title.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold active">                    
                    <i class="fas fa-sharp fa-solid fa-lightbulb me-2"></i>Title
                </a> 

                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">                    
                    <i class="fas fa-sharp fa-regular fa-right-from-bracket me-2"></i>LogOut
                </a>
            </div>
        </div>

        <!--navbar header-->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Title</h2>
                </div>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle primary-text fw-bold" href="#" id="navbarDropdownMenuLink" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i>Admin Name
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                              <li><a class="dropdown-item" href="#">Profile</a></li>
                              <li><a class="dropdown-item" href="#">Settings</a></li>
                              <li><a class="dropdown-item" href="#">LogOut</a></li>
                            </ul>
                        </li>
                    </ul> 
                </div>
            </nav>

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