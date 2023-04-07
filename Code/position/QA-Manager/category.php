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
                                An error create a new category
                            </div>
                        </div>
                        <?php
                    } else if ($error_msg == "categoriestaken") {
                        ?>
                        <div class="d-flex justify-content-center mt-4 fade-out alert-box" role="alert">
                            <div class="alert alert-danger">
                                This category has been added
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
                    } else if ($error_msg == "categoryUsed") {
                        ?>
                        <div class="d-flex justify-content-center mt-4 fade-out alert-box" role="alert">
                            <div class="alert alert-danger">
                                Unable Deleted because you're using
                            </div>
                        </div>
                        <?php
                    }       

                }
            ?>


            <form action="../../includes/addcategories.inc.php" method="post" enctype="multipart/form-data">
                <div class="input-group flex-row-reverse my-4">                    
                    <button type="submit" name="submit" class="btn btn-secondary me-4">Add Category</button>
                    <input type="text" name="categories" id="category" placeholder="categories" required>
                </div>
            </form>

            <?php
                include("../../includes/dbConnection.inc.php");
                $sql = "SELECT * FROM categories";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
            ?>

            <form action="../../includes/deletecategories.inc.php" method="post">
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
                                                $id= $row["categories_id"];
                            ?>
                            <tr>
                                <td>
                                    <?php                                    
                                                echo $id;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                                echo $row['categories'];                                        
                                    ?>
                                </td>
                                <td>
                                    <button type="submit" name="submit" onchange="deleteCategory(this)" class="border-0 btn-transition btn btn-outline-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <input type="hidden" name="category_id" value="<?php echo $id; ?>">                                    
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

    <script>
        let addNewCategory = () => {
            let table = document.getElementById('categoryTable');
            let categoryValue = document.getElementById('category').value;
            
            let row = table.insertRow(-1);
            const cell1 = row.insertCell(0);
            const cell2 = row.insertCell(1);
            
            cell1.outerHTML = `<td>${categoryValue}</td>`;

            cell2.outerHTML =   '<td>' +
                                    '<button type="submit" name="submit" onchange="deleteCategory(this)"'+
                                        'class="border-0 btn-transition btn btn-outline-danger">' +
                                        '<i class="fa fa-trash"></i>' +
                                    '</button>' +
                                '</td>';
        }

        let deleteCategory = (index) => {                
            const i = index.parentNode.parentNode.rowIndex;
            document.getElementById("categoryTable").deleteRow(i);    
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="../../script.js"></script>
    <script src="./javascript/category.js"></script>



<?php
include("../../footer.php");
?>