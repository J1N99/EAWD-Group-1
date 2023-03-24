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
                <a href="./dashboard.php" class="list-group-item list-group-item-action bg-transparent second-text">
                    <i class="fas fa-tachometer-alt me-2"></i>DashBoard
                </a>

                <a href="#" class="list-group-item list-group-item-action second-text fw-bold active">                    
                    <i class="fas fa-sharp fa-solid fa-lightbulb me-2"></i>Ideas
                </a>

                <a href="./category.php" class="list-group-item list-group-item-action second-text fw-bold">                    
                    <i class="fas fa-solid fa-list me-2"></i>Categories
                </a>

                <a href="./overview.php" class="list-group-item list-group-item-action second-text fw-bold">                    
                    <i class="fas fa-solid fa-globe me-2"></i>Overview
                </a>

                <a href="./visualisation.php" class="list-group-item list-group-item-action second-text fw-bold">                    
                    <i class="fas fa-regular fa-chart-line me-2"></i>Visualisation
                </a>

                <a href="../login.php" class="list-group-item list-group-item-action second-text fw-bold">                    
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
                                <i class="fas fa-user me-2"></i>QA-Manager Name
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
            <!-- <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle ms-5 mt-4" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  Select Filter
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <li><a class="dropdown-item" href="#">Most View</a></li>
                  <li><a class="dropdown-item" href="#">Most Like</a></li>
                  <li><a class="dropdown-item" href="#">Most Dislike</a></li>
                  <li><a class="dropdown-item" href="#">Latest Ideas</a></li>
                  <li><a class="dropdown-item" href="#">Oldest Ideas</a></li>
                </ul>
            </div> -->

            <?php
                if (isset($_GET['view'])) {
                    $sql = "SELECT idea.idea_id, idea.document_url,idea.submitDate,idea.title,sum(t_up),sum(t_down) FROM idea
                    LEFT JOIN likepost ON idea.idea_id= likepost.idea_id 
                    group by idea.idea_id ORDER BY views DESC";
                } else if (isset($_GET['tup'])) {
                    $sql = "SELECT idea.idea_id, idea.document_url,idea.submitDate,idea.title,sum(t_up),sum(t_down) FROM idea 
                    LEFT JOIN likepost ON idea.idea_id= likepost.idea_id 
                    group by idea.idea_id ORDER BY t_up DESC";
                } else if (isset($_GET['tdown'])) {
                    $sql = "SELECT idea.idea_id, idea.document_url,idea.submitDate,idea.title,sum(t_up),sum(t_down) FROM idea 
                    LEFT JOIN likepost ON idea.idea_id= likepost.idea_id 
                    group by idea.idea_id ORDER BY t_down DESC";
                } else if (isset($_GET['idea'])) {
                    $sql = "SELECT idea.idea_id, idea.document_url,idea.submitDate,idea.title,sum(t_up),sum(t_down) FROM idea 
                    LEFT JOIN likepost ON idea.idea_id= likepost.idea_id 
                    group by idea.idea_id ORDER BY submitDate DESC";
                } else if (isset($_GET["comment"])) {
                    // pending comment
                    $sql = "SELECT idea.idea_id, idea.document_url,idea.submitDate,idea.title,sum(t_up),sum(t_down) FROM idea 
                    LEFT JOIN likepost ON idea.idea_id= likepost.idea_id 
                    LEFT JOIN comment ON idea.idea_id=comment.idea_id
                    group by idea.idea_id ORDER BY comment.commentDate DESC";
                } else {
                    $sql = "SELECT idea.idea_id, idea.document_url,idea.submitDate,idea.title,sum(t_up),sum(t_down) FROM idea
                LEFT JOIN likepost ON idea.idea_id= likepost.idea_id 
                group by idea.idea_id";
                }
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
            ?>

            <select class="btn btn-secondary ms-5 mt-4 select" aria-label="Default select example"
            onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">                
                <option default>Select Filter</option>
                <option value="ideas.php?view=true">Most View</option>
                <option value="ideas.php?tup=true">Most Like</option>
                <option value="ideas.php?tup=false">Most Dislike</option>
                <option value="ideas.php?idea=true">Latest Ideas</option>
                <option value="ideas.php?comment=true">Latest Comment</option>
            </select>
        
<!-- 
                <th scope="row">1</th>
                <td>Mark</td>
                <td>
                <button onclick="deleteCategory(this)" class="border-0 btn-transition btn btn-outline-danger">
                    <i class="fa fa-trash"></i>                        
                </button>   
                </td> -->

             <div class="table-responsive m-4">
                <table class="table table-bordered table-secondary table-striped align-middle" id="categoryTable">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Like</th>
                            <th scope="col">Dislike</th>
                            <th scope="col">Document</th>
                            <th scope="col">Submit Date</th>
                            <th scope="col">Table ID</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                            if ($resultCheck > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id=$row['idea_id'];
                                    $url = $row['document_url'];
                                    $submitDate=$row['submitDate'];
                                    $title=$row['title'];
                                    $t_up=$row['sum(t_up)'];
                                    $t_down=$row['sum(t_down)'];                                    
                        ?>
                        <tr>
                            <td><a href="listdetails.php?id=<?php echo $id?>"><?php echo $title?></td>
                            <td>
                                <?php
                                    if ($t_up==null) {
                                        $t_up=0;
                                    }
                                    echo $t_up;
                                ?>
                            </td>
                            <td>
                                <?php
                                    if ($t_down==null) {
                                        $t_down=0;
                                    }
                                    echo $t_down;
                                ?>
                            </td>
                            <td>
                                <?php
                                    if ($url!=="") {
                                ?>
                                     <a href=" uploads/<?php echo $url?>">Document</a>
                                    
                                <?php
                                    } else {
                                        
                                        echo "No Document";
                                    }
                                ?>
                            </td>
                            <td>
                                <?php 
                                    echo $submitDate 
                                ?>
                            </td>
                            <td>
                                <?php 
                                    echo $title 
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
            <br />         

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="../../script.js"></script>    

<?php
include("../../footer.php");
?>