<?php
include("../../header.php");
include("../../includes/dbConnection.inc.php");
?>
                
<?php
    if (isset($_GET['id']) && isset($_GET['status']) && isset($_GET['ori'])) {

        //check manager
        $sqlCheckManager = "SELECT * FROM user WHERE position=1";
        $resultManager = mysqli_query($conn, $sqlCheckManager);
        $resultCheckManager = mysqli_num_rows($resultManager);

        //check department
        $sqlCheckDepartment = "SELECT * FROM department";
        $resultDepartment = mysqli_query($conn, $sqlCheckDepartment);
        $resultCheckDepartment = mysqli_num_rows($resultDepartment);

        //check coordinator
        $sqlCheckCoordinator = "SELECT * FROM user WHERE position=2";
        $resultCoordinator = mysqli_query($conn, $sqlCheckCoordinator);
        $resultCheckCoordinator = mysqli_num_rows($resultCoordinator);


        $status = $_GET['status'];
        $id = $_GET['id'];

        if ($resultCheckDepartment == $resultCheckCoordinator) {
            if ($status == 2) {
                header("Location: account.php?update=failure&coordinator=bigthandepartment");
                exit();
            }
        }


        if ($resultCheckManager == 1 || 0) {
            if ($status == 1) {
                $query = "UPDATE user SET position=? WHERE user_id=?";


                $stmt = mysqli_prepare($conn, $query);


                mysqli_stmt_bind_param($stmt, "ii", $status, $id);


                $query_run = mysqli_stmt_execute($stmt);

                if ($query_run) {
                    header("Location: account.php?update=success");
                } else {
                    header("Location: account.php?update=failure");
                }
            } else {
                header("Location: account.php?update=failure&manager=bigthanone");
                exit();
            }
        }


        if ($_SESSION['id'] == $id) {
            header("Location: account.php?update=failure");
            exit();
        }

        
        // if ($_GET['ori'] == 1) {
        //     header("Location: account.php?update=failure");
        //     exit();
        // }
        $query = "UPDATE user SET position=? WHERE user_id=?";

            
        $stmt = mysqli_prepare($conn, $query);


        mysqli_stmt_bind_param($stmt, "ii", $status, $id);


        $query_run = mysqli_stmt_execute($stmt);

        if ($query_run) {
            header("Location: account.php?update=success");
        } else {
            header("Location: account.php?update=failure");
        }
    }

    $sql = "SELECT user.user_id,user.position,user.name,user.email,department.department 
    FROM user
    LEFT JOIN department ON user.department= department.department_id 
    ";

    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    $no = 0;
?>  

<link rel="stylesheet" href="../../style.css">

    <div class="d-flex" id="wrapper">

        <!--sidebar-->
        <?php 
            include("../../nav.php");
        ?>
            <!--Content-->
            <div class="container-fluid px-4">
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary ms-4 mt-4" data-bs-toggle="modal" data-bs-target="#Modal">
                        Create Account
                    </button>
                    <button type="button" class="btn btn-secondary ms-4 mt-4" onclick="tableHideShow()">
                        Update Position
                    </button>
                </div>

                <?php
                    $sqlDepartment = "SELECT * FROM department";
                    $resultDepartment = mysqli_query($conn, $sqlDepartment);
                    $resultGetDepartment = mysqli_num_rows($resultDepartment);
                ?>
                
                <!-- modal start -->
                <form action="../../includes/signup.inc.php" method="post">
                    <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog">                        
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ModalLabel">Create New Position</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" required>
                                    </div>

                                    <?php
                                        if ($resultGetDepartment > 0) {
                                    ?>
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Department</label>
                                        <select class="form-select" id="category" name="did">
                                            <option value="" disabled>Select Department</option>
                                            <?php
                                                while ($rowDepartment = mysqli_fetch_assoc($resultDepartment)) {
                                                    $departmentId = $rowDepartment["department_id"];
                                            ?>
                                            <option value="<?php echo $departmentId ?>"><?php echo $rowDepartment['department'] ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <?php
                                        }
                                    ?>
                                    <div class="mb-3">
                                        <label for="item-name" class="form-label">Password</label>
                                        <input type="password" class="form-control" 
                                            placeholder="Password" id="item-name" name="password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="item-name" class="form-label">Repeat Password</label>
                                        <input type="password" class="form-control" 
                                            placeholder="Repeat Password" id="item-name" name="repassword" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="submit" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- modal end -->

                <?php
                    if (isset($_GET['error'])) { 
                        $error_msg = $_GET['error'];        
                        if($error_msg == "stmterror2") {
                            ?>
                            <div class="d-flex justify-content-center mt-4 fade-out" role="alert">
                                <div class="alert alert-danger">
                                    Create Unsuccessful
                                </div>
                            </div>
                            <?php
                        } else if($error_msg == "createSucess") {
                            ?>
                            <div class="d-flex justify-content-center mt-4 fade-out" role="alert">
                                <div class="alert alert-danger">
                                    Added Account
                                </div>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="d-flex justify-content-center mt-4 fade-out" role="alert">
                                <div class="alert alert-danger">
                                    <?php echo $error_msg; ?>
                                </div>
                            </div>
                            <?php
                        }
                    } 
                ?>

                <div class="container mt-4" id="position-table" style="display:none;">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">User List</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        </div>
                        <!-- card content -->
                        <div class="card-content collapse show">
                            <!-- card body -->
                            <div class="card-body">
                                <!-- table responsive -->
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-striped table-bordered table-sm align-middle"
                                        cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="th-sm">No </th>
                                                <th class="th-sm">Name</th>
                                                <th class="th-sm">Email
                                                </th>
                                                <th class="th-sm">Department
                                                </th>
                                                <th class="th-sm">position
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($resultCheck > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $no++;
                                            ?>
                                            <tr>
                                                <td><?php echo $no ?></td>
                                                <td><?php echo $row['name'] ?></td>
                                                <td><?php echo $row['email'] ?></td>
                                                <td><?php echo $row['department'] ?></td>
                                                <td><?php if ($row['position'] == 1) {
                                                    ?>
                                                    <select class="btn-light"
                                                        onchange="if (this.value) window.location.href='account.php?id=<?php echo $row['user_id'] ?>&ori=<?php echo $row['position'] ?>&status='+this.value">
                                                        <option class="btn-light" value="1" selected>QA Manager</option>
                                                        <option class="btn-light" value="2">QA Coordinator</option>
                                                        <!-- <option class="btn-light" value="3">Admin</option> -->
                                                        <option class="btn-light" value="4">Staff</option>
                                                    </select>
                                                    <?php
                                                        } else if ($row['position'] == 2) {
                                                    ?>
                                                    <select class="btn-light"
                                                        onchange="if (this.value) window.location.href='account.php?id=<?php echo $row['user_id'] ?>&ori=<?php echo $row['position'] ?>&status='+this.value">
                                                        <option class="btn-light" value="1">QA Manager</option>
                                                        <option class="btn-light" value="2" selected>QA Coordinator</option>
                                                        <!-- <option class="btn-light" value="3">Admin</option> -->
                                                        <option class="btn-light" value="4">Staff</option>
                                                    </select>
                                                    <?php
                                                        } else if ($row['position'] == 3) {
                                                    ?>
                                                    <select class="btn-light"
                                                        onchange="if (this.value) window.location.href='account.php?id=<?php echo $row['user_id'] ?>&ori=<?php echo $row['position'] ?>&status='+this.value"
                                                        disabled>
                                                        <option class="btn-light" value="1">QA Manager</option>
                                                        <option class="btn-light" value="2">QA Coordinator</option>
                                                        <option class="btn-light" value="3" selected>Admin</option>
                                                        <option class="btn-light" value="4">Staff</option>
                                                    </select>
                                                    <?php
                                                        } else if ($row['position'] == 4) {
                                                    ?>
                                                    <select class="btn-light"
                                                        onchange="if (this.value) window.location.href='account.php?id=<?php echo  $row['user_id'] ?>&ori=<?php echo $row['position'] ?>&status='+this.value">
                                                        <option class="btn-light" value="1">QA Manager</option>
                                                        <option class="btn-light" value="2">QA Coordinator</option>
                                                        <!-- <option class="btn-light" value="3">Admin</option> -->
                                                        <option class="btn-light" value="4" selected>Staff</option>
                                                    </select>
                                                    <?php 
                                                        } 
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php

                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- table responsive end -->
                            </div>
                            <!-- card body end -->
                        </div>
                        <!-- card content end -->
                    </div>
                </div>                    

            </div>
            <!-- container end -->

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>    
    <script src="./javascript/overview.js" type="text/javascript"></script>
    <script src="../../script.js"></script>
    <script src="js/script.js"></script>

<?php
include("../../footer.php");
?>