<?php
include("../../header.php");
?>

<link rel="stylesheet" href="../../style.css">

    <div class="d-flex" id="wrapper">

        <!--sidebar-->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
                <i class="fas fa-user-secret me-2"></i>Test
            </div>

            <div class="list-group list-group-flush my-3">

                <a href="#" class="list-group-item list-group-item-action second-text fw-bold active">                    
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
                    
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card mb-5 shadow-sm">                                
                                <div class="card-body">
                                    <div class="card-title">
                                        <h2>Title Post</h2>
                                    </div>
                                    <div class="card-text">
                                        <p>How to increase the reputation?</p>
                                        <p>Posted Date: xx/xx/xxxx</p>
                                        <p>Closure Date: xx/xx/xxxx</p>
                                        <p>Final Closure Date: xx/xx/xxxx</p>
                                        <a href="./list-idea.php" class="btn btn-outline-primary d-inline-flex rounded-0">Read More</a>
                                    </div>                                                                                                       
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card mb-5 shadow-sm">                                
                                <div class="card-body">
                                    <div class="card-title">
                                        <h2>Title Post</h2>
                                    </div>
                                    <div class="card-text">
                                        <p>How to increase the reputation?</p>
                                        <p>Posted Date: xx/xx/xxxx</p>
                                        <p>Closure Date: xx/xx/xxxx</p>
                                        <p>Final Closure Date: xx/xx/xxxx</p>
                                        <a href="./list-idea.php" class="btn btn-outline-primary d-inline-flex rounded-0">Read More</a>
                                    </div>                                                                                                       
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card mb-5 shadow-sm">                                
                                <div class="card-body">
                                    <div class="card-title">
                                        <h2>Title Post</h2>
                                    </div>
                                    <div class="card-text">
                                        <p>How to increase the reputation?</p>
                                        <p>Posted Date: xx/xx/xxxx</p>
                                        <p>Closure Date: xx/xx/xxxx</p>
                                        <p>Final Closure Date: xx/xx/xxxx</p>
                                        <a href="./list-idea.php" class="btn btn-outline-primary d-inline-flex rounded-0">Read More</a>
                                    </div>                                                                                                       
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

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