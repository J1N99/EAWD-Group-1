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
                        } else if ($error_msg == "departmentUsed") {
                            ?>
                            <div class="d-flex justify-content-center mt-4 fade-out alert-box" role="alert">
                                <div class="alert alert-danger">
                                    Department has been used
                                </div>
                            </div>
                            <?php
                        }       

                    }
                ?>

                <form action="../../includes/adddepartment.inc.php" method="post" enctype="multipart/form-data">
                    <div class="input-group flex-row-reverse my-4">                    
                        <button type="submit" name="submit" class="btn btn-secondary me-4">Add Department</button>
                        <input type="text" name="department" id="department" placeholder="Departments" required>
                    </div>
                </form>


              
                    <div class="table-responsive m-4">
                        <table class="table table-bordered table-secondary table-striped align-middle" id="categoryTable">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Department Name</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if ($resultCheck > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                         
                                            <?php
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
                                        
                                        <input type="hidden" name="department_id" value="<?php echo $id; ?>"> 
                                        <button type="submit" name="submit" 
                                            onclick="window.location.href='../../includes/deletedepartment.inc.php?id=<?php echo $id?>'" 
                                            class="border-0 btn-transition btn btn-outline-danger">
                                            <input type="hidden" name="department_id" value="<?php echo $id; ?>">
                                                <i class="fa fa-trash"></i>
                                        </button>
<<<<<<< HEAD
                                                                            
=======
                                                                       
>>>>>>> d04e8ffd9d4174a6a6c1ceea89f75fa4695ae20d
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
               
                    
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>    
    <script src="./js/script.js" type="text/javascript"></script>
    <script src="../../script.js"></script>

<?php
include("../../footer.php");
?>