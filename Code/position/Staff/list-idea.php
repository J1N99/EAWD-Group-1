<?php
include("../../header.php");
include("../../includes/dbConnection.inc.php");
include("../../includes/authLogin.inc.php");
if(isset($_GET['id']))
{
    $titleId=$_GET['id'];
    
}
$limit = 5;  
if (isset($_GET["page"])) {
    $page  = $_GET["page"]; 
    } 
    else{ 
    $page=1;
    };  
$start_from = ($page-1) * $limit;
?>



<link rel="stylesheet" href="../../style.css">

<div class="d-flex" id="wrapper">

    <!--sidebar-->
    <?php 
        include("../../nav.php");
    ?>       

        <!--Content-->

        <?php
        if (isset($_GET['view'])) {
            $sql = "SELECT idea.idea_id, idea.document_url,idea.submitDate,idea.title,idea.description,sum(t_up),sum(t_down),categories.categories,department.department,idea.a_status,user.name FROM idea
                    LEFT JOIN likepost ON idea.idea_id= likepost.idea_id 
                    LEFT JOIN categories ON idea.categories_id= categories.categories_id 
                    LEFT JOIN user ON idea.user_id= user.user_id
                    LEFT JOIN department ON user.department= department.department_id
                    WHERE title_id=$titleId
                    group by idea.idea_id ORDER BY views DESC LIMIT $start_from, $limit";
        } else if (isset($_GET['tup'])) {
            $sql = "SELECT idea.idea_id, idea.document_url,idea.submitDate,idea.title,idea.description,sum(t_up),sum(t_down),categories.categories,department.department,idea.a_status,user.name FROM idea 
                    LEFT JOIN likepost ON idea.idea_id= likepost.idea_id 
                    LEFT JOIN categories ON idea.categories_id= categories.categories_id 
                    LEFT JOIN user ON idea.user_id= user.user_id
                    LEFT JOIN department ON user.department= department.department_id
                    WHERE title_id=$titleId
                    group by idea.idea_id ORDER BY t_up DESC LIMIT $start_from, $limit";
        } else if (isset($_GET['tdown'])) {
            $sql = "SELECT idea.idea_id, idea.document_url,idea.submitDate,idea.title,idea.description,sum(t_up),sum(t_down),categories.categories,department.department,idea.a_status,user.name FROM idea 
                      LEFT JOIN likepost ON idea.idea_id= likepost.idea_id 
                    LEFT JOIN categories ON idea.categories_id= categories.categories_id 
                    LEFT JOIN user ON idea.user_id= user.user_id
                    LEFT JOIN department ON user.department= department.department_id
                    WHERE title_id=$titleId
                    group by idea.idea_id ORDER BY t_down DESC LIMIT $start_from, $limit";
        } else if (isset($_GET['idea'])) {
            $sql = "SELECT idea.idea_id, idea.document_url,idea.submitDate,idea.title,idea.description,sum(t_up),sum(t_down),categories.categories,department.department,idea.a_status,user.name FROM idea 
                      LEFT JOIN likepost ON idea.idea_id= likepost.idea_id 
                    LEFT JOIN categories ON idea.categories_id= categories.categories_id 
                    LEFT JOIN user ON idea.user_id= user.user_id
                    LEFT JOIN department ON user.department= department.department_id
                    WHERE title_id=$titleId
                    group by idea.idea_id ORDER BY submitDate DESC LIMIT $start_from, $limit";
        } else {
            $sql = "SELECT idea.idea_id, idea.document_url, idea.submitDate, idea.title, idea.description, sum(t_up),sum(t_down), categories.categories,department.department,idea.a_status,user.name FROM idea
                    LEFT JOIN likepost ON idea.idea_id= likepost.idea_id 
                    LEFT JOIN categories ON idea.categories_id= categories.categories_id 
                    LEFT JOIN user ON idea.user_id= user.user_id
                    LEFT JOIN department ON user.department= department.department_id
                    WHERE title_id=$titleId
                    group by idea.idea_id LIMIT $start_from, $limit";
        }
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        ?>

        <div class="btn-toolbar justify-content-between">
            <div class="btn-group">
                <select class="btn btn-secondary ms-5 mt-4 select" aria-label="Default select example" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                    <option default>Select Filter</option>
                    <option value="list-idea.php?view=true&id=<?php echo $titleId ?>">Most View</option>
                    <option value="list-idea.php?tup=true&id=<?php echo $titleId ?>">Most Like</option>
                    <option value="list-idea.php?tup=false&id=<?php echo $titleId ?>">Most Dislike</option>
                    <option value="list-idea.php?idea=true&id=<?php echo $titleId ?>">Latest Ideas</option>
                </select>

                <?php
                $sqlcategory = "SELECT * FROM categories";
                $resultcategory = mysqli_query($conn, $sqlcategory);
                $resultCheckcategory = mysqli_num_rows($resultcategory);
                $submit = "";
                $currentDate = date('Y-m-d');

                $sql2 = "SELECT * FROM title WHERE closeDate>='$currentDate'";
                $resultTitle = mysqli_query($conn, $sql2);
                $resultCheckTitle = mysqli_num_rows($resultTitle);
                ?>
            </div>

            <div class="btn-group me-5">
                    <!-- Button trigger modal -->

                    <?php

                        $today = date('Y-m-d');
                        $sqlgetDate = "SELECT * FROM title WHERE closeDate >= '$today' AND title_id = '$titleId'";
                        $resultFilter = mysqli_query($conn, $sqlgetDate);
                        $resultCheckFilter = mysqli_num_rows($resultFilter);

                        if ($resultCheckFilter > 0) {
                    ?>

                    <button type="button" class="btn btn-secondary ms-2 mt-4 btn-block" 
                        data-bs-toggle="modal" data-bs-target="#exampleModal">Post
                    </button>

                        <?php
                            }
                        else {
                        ?>
                        <button type="button" class="btn btn-secondary ms-2 mt-4 btn-block" 
                            data-bs-toggle="modal" data-bs-target="#exampleModal" hidden>Post
                        </button>
                <?php
                    }
                ?>



                <!-- Modal -->
                <form action="../../includes/addidea.inc.php" method="post" enctype="multipart/form-data">
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">New Post</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="title" class="form-label" required>Idea Title</label>
                                        <input type="text" class="form-control" id="post-title" name="title" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="post-category" class="form-label">Category</label>
                                        <?php
                                        if ($resultCheckcategory > 0) {
                                        ?>
                                            <select name="did" class="select">
                                                <?php
                                                while ($rowCategory = mysqli_fetch_assoc($resultcategory)) {
                                                    $id = $rowCategory["categories_id"];
                                                ?>
                                                    <option value="<?php echo $id ?>"><?php echo $rowCategory['categories'] ?>
                                                    </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="mb-3">
                                        <label for="post-comment" class="form-label" id="description">Post
                                            Description</label>
                                        <textarea class="form-control" id="post-comment" name="description" rows="3" required></textarea>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="anonymous-check" name="checkann" value="1">
                                        <label class="form-check-label" for="checkann">Post Anonymously</label>
                                    </div>
                                    <div class="mb-3">
                                        <label for="uploadDocument" class="form-label">Upload Document</label>
                                        <input type="file" class="form-control" id="post-document" name="uploadDocument">
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" name="checkbox" id="terms-check" required>
                                        <a href="../../term.php" class="form-check-label" target="_blank" for="terms-check">I agree to the terms and
                                            conditions</a>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <input name="id" type="hidden" value="<?php echo $_SESSION['id'] ?>" />
                                    <input name="titleid" type="hidden" value="<?php echo $titleId ?>" />
                                    <button type="submit" class="btn btn-primary" name="submit">Post</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="container-fluid px-5 mt-4">

            <?php
            if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['idea_id'];
                    $url = $row['document_url'];
                    $submitDate = $row['submitDate'];
                    $title = $row['title'];
                    $t_up = $row['sum(t_up)'];
                    $t_down = $row['sum(t_down)'];
                    $description = $row['description'];
                    $astatus = $row['a_status'];
                    $categories = $row['categories'];
                    $department = $row['department'];
                    $name = $row['name'];


            ?>
                    <div class="card mt-4">
                        <h5 class="card-header"><?php echo $title ?></h5>
                        <div class="card-body">
                            <h5 class="card-text"><?php echo $description ?></h5>
                            <p class="card-text fs-6"><?php echo "Posted by:";
                                                        if ($astatus == 0) {
                                                            echo $name;
                                                        } else if ($astatus == 1) {
                                                            echo "Anonymous";
                                                        } ?>
                                <br><?php echo "Category:" . $categories ?>
                                <br><?php echo "Department:" . $department ?>
                            </p>
                            <a href="./idea-detail.php?id=<?php echo $id ?>" class="btn btn-secondary">Read More</a>
                        </div>
                    </div>
            <?php
                }
            }

            if(!isset($_GET["id"]))
            {
                $totalidea = mysqli_query($conn, "select * from idea");
            }
            else
            {
                $currentid = $_GET["id"];
                $sql = "SELECT * FROM idea WHERE title_id = '$currentid'";
                $totalidea = mysqli_query($conn, $sql);
            }
            $total_records = mysqli_num_rows($totalidea);

            $total_pages = ceil($total_records / $limit);

            $pageLink = "<ul class='pagination'>";  
            for ($i=1; $i<=$total_pages; $i++) {
                        $pageLink .= "<li class='page-item'><a class='page-link my-4' href='list-idea.php?page=".$i."&id=".$titleId."'>".$i."</a></li>";	
            }
            echo $pageLink . "</ul>";  
            ?>

        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>
<script src="../../script.js"></script>


<?php
include("../../footer.php");
?>