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
                <a href="./dashboard.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-tachometer-alt me-2"></i>DashBoard
                </a>

                <a href="./account.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">                    
                    <i class="fas fa-sharp fa-solid fa-lightbulb me-2"></i>Account
                </a>
                
                <a href="./department.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold active">                    
                    <i class="fas fa-sharp fa-solid fa-lightbulb me-2"></i>Department
                </a> 

                <a href="./title.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">                    
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
                    <h2 class="fs-2 m-0">Department</h2>
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
                
                <?php
                    $sql = "SELECT * FROM department";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
                ?>

                <?php
                    if (isset($_GET['error'])) { 
                        $error_msg = $_GET['error']; 
                        if ($error_msg == "addedSucess") {
                            ?>
                            <div class="d-flex justify-content-center mt-4 fade-out alert-box" role="alert">
                                <div class="alert alert-success">
                                    Added Successful
                                </div>
                            </div>
                            <?php
                        } else if ($error_msg == "stmterror2") {
                            ?>
                            <div class="d-flex justify-content-center mt-4 fade-out alert-box" role="alert">
                                <div class="alert alert-danger">
                                    An error create a new department
                                </div>
                            </div>
                            <?php
                        } else if ($error_msg == "departmenttaken") {
                            ?>
                            <div class="d-flex justify-content-center mt-4 fade-out alert-box" role="alert">
                                <div class="alert alert-danger">
                                    This department has been added
                                </div>
                            </div>
                            <?php
                        } else if ($error_msg == "deletefail") {
                            ?>
                            <div class="d-flex justify-content-center mt-4 fade-out alert-box" role="alert">
                                <div class="alert alert-danger">
                                    You're unable to delete
                                </div>
                            </div>
                            <?php
                        } else if ($error_msg == "deletedSucess") {
                            ?>
                            <div class="d-flex justify-content-center mt-4 fade-out alert-box" role="alert">
                                <div class="alert alert-danger">
                                    Deleted Successful
                                </div>
                            </div>
                            <?php
                        }       

                    }
                ?>

                <form action="../../includes/adddepartment.inc.php" method="post" enctype="multipart/form-data">
                    <div class="input-group flex-row-reverse my-4">                    
                        <button type="submit" name="submit" class="btn btn-secondary me-4">Add Department</button>
                        <input type="text" name="department" id="category" placeholder="categories" required>
                    </div>
                </form>

                <form action="../../includes/deletedepartment.inc.php" method="post">
                    <div class="table-responsive m-4">
                        <table class="table table-bordered table-secondary table-striped align-middle" id="categoryTable">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if ($resultCheck > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $id= $row["department_id"];
                                ?>
                                <tr>
                                    <td>
                                        <?php                                    
                                            echo $id;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            echo $row['department'];                                        
                                        ?>
                                    </td>
                                    <td>
                                        <button type="submit" name="submit" onchange="deleteCategory(this)" 
                                            class="border-0 btn-transition btn btn-outline-danger">
                                                <i class="fa fa-trash"></i>
                                        </button>
                                        <input type="hidden" name="department_id" value="<?php echo $id; ?>">                                    
                                        <?php
                                                }                                
                                            } else {
                                                echo "This is no data on the option";
                                            }                                
                                        ?>                                    
                                    </td> 
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
                    
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>    
    <script src="./javascript/overview.js" type="text/javascript"></script>
    <script src="../../script.js"></script>

<?php
include("../../footer.php");
?>