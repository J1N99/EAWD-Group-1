<?php
include("../header.php");
include("../includes/dbConnection.inc.php");
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
            header("Location: updateposition.php?update=failure&coordinator=bigthandepartment");
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
                header("Location: updateposition.php?update=success");
            } else {
                header("Location: updateposition.php?update=failure");
            }
        } else {
            header("Location: updateposition.php?update=failure&manager=bigthanone");
            exit();
        }
    }


    if ($_SESSION['id'] == $id) {
        header("Location: updateposition.php?update=failure");
        exit();
    }

    
    // if ($_GET['ori'] == 1) {
    //     header("Location: updateposition.php?update=failure");
    //     exit();
    // }
    $query = "UPDATE user SET position=? WHERE user_id=?";


    $stmt = mysqli_prepare($conn, $query);


    mysqli_stmt_bind_param($stmt, "ii", $status, $id);


    $query_run = mysqli_stmt_execute($stmt);

    if ($query_run) {
        header("Location: updateposition.php?update=success");
    } else {
        header("Location: updateposition.php?update=failure");
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


<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block">User</h3>
    </div>
    <div class="content-header-right col-md-6 col-12">
        <div class="btn-group float-md-right">
        </div>
    </div>
</div>



<div style="margin:20px"></div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">User List</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">

                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped table-bordered table-sm text-center  "
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
                                            onchange="if (this.value) window.location.href='updateposition.php?id=<?php echo $row['user_id'] ?>&ori=<?php echo $row['position'] ?>&status='+this.value">
                                            <option class="btn-light" value="1" selected>QA Manager</option>
                                            <option class="btn-light" value="2">QA Coordinator</option>
                                            <!-- <option class="btn-light" value="3">Admin</option> -->
                                            <option class="btn-light" value="4">Staff</option>
                                        </select>
                                        <?php
                                                } else if ($row['position'] == 2) {
                                                ?>
                                        <select class="btn-light"
                                            onchange="if (this.value) window.location.href='updateposition.php?id=<?php echo $row['user_id'] ?>&ori=<?php echo $row['position'] ?>&status='+this.value">
                                            <option class="btn-light" value="1">QA Manager</option>
                                            <option class="btn-light" value="2" selected>QA Coordinator</option>
                                            <!-- <option class="btn-light" value="3">Admin</option> -->
                                            <option class="btn-light" value="4">Staff</option>
                                        </select>
                                        <?php
                                                } else if ($row['position'] == 3) {
                                                ?>
                                        <select class="btn-light"
                                            onchange="if (this.value) window.location.href='updateposition.php?id=<?php echo $row['user_id'] ?>&ori=<?php echo $row['position'] ?>&status='+this.value"
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
                                            onchange="if (this.value) window.location.href='updateposition.php?id=<?php echo  $row['user_id'] ?>&ori=<?php echo $row['position'] ?>&status='+this.value">
                                            <option class="btn-light" value="1">QA Manager</option>
                                            <option class="btn-light" value="2">QA Coordinator</option>
                                            <!-- <option class="btn-light" value="3">Admin</option> -->
                                            <option class="btn-light" value="4" selected>Staff</option>
                                        </select>
                                        <?php } ?>


                                    </td>

                                </tr>
                                <?php

                                    }
                                }


                                ?>







                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<?php
include("../footer.php");
?>