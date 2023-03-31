<?php
include("../../header.php");
include("../../includes/dbConnection.inc.php");
?>

<link rel="stylesheet" href="../../style.css">
<link rel="stylesheet" href="css/encourage-mail.css">

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

                <a href="./ideas.php?overview=true" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">                    
                    <i class="fas fa-sharp fa-solid fa-lightbulb me-2"></i>Ideas
                </a>
                
                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold active">                    
                    <i class="fas fa-sharp fa-solid fa-lightbulb me-2"></i>Encourage Mail
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
                    <h2 class="fs-2 m-0">Encourage Mail</h2>
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
                                <i class="fas fa-user me-2"></i>QA-Coordinator Name
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

            <!-- content start -->

            <?php
                $sql = "SELECT * FROM categories";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
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