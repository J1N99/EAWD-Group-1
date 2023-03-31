<?php
include("../../header.php");
include("../../includes/dbConnection.inc.php");
?>

<link rel="stylesheet" href="../../style.css">

    <div class="d-flex" id="wrapper">

        <!--sidebar-->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
                <i class="fas fa-user-secret me-2"></i>Test
            </div>

            <div class="list-group list-group-flush my-3">

                <a href="./dashboard.php" class="list-group-item list-group-item-action second-text fw-bold active">                    
                    <i class="fas fa-sharp fa-solid fa-lightbulb me-2"></i>Ideas
                </a>

                <a href="../login.html" class="list-group-item list-group-item-action second-text fw-bold">                    
                    <i class="fas fa-sharp fa-regular fa-right-from-bracket me-2"></i>LogOut
                </a>

            </div>
        </div>

        <!--navbar header-->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Ideas</h2>
                </div>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle primary-text fw-bold" href="#" id="navbarDropdownMenuLink" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i>Staff Name
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
                
                <div class="container">
                    <div class="text-center my-5">
                        <h1>All Title</h1> <hr/>
                    </div>
                    
                    
                </div>
                <!-- end container -->

                <!-- card container -->
                <div class="container row">
                    <?php

                        $sql = "SELECT * FROM title";
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
                                        <div class="col-10">
                                            <p class="d-flex align-items-center mb-0">
                                                Closure Date: <?php echo $closeDate ?>
                                            </p>
                                        </div> 
                                        <div class="col-10">
                                            <p class="d-flex align-items-center mb-0">
                                                Final Closure Date: <?php echo $finalCloseDate ?>
                                            </p>
                                        </div>    
                                        <div class="col-2">
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