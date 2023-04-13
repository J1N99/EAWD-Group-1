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


    <?php
    function download_csv() {
        // Connect to the database
        $conn = mysqli_connect('localhost', 'root', '', 'feedbackdb');

        // Check for connection errors
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Define the query to retrieve the data from the table
        $sql = "SELECT * FROM idea";

        // Execute the query
        $result = mysqli_query($conn, $sql);

        // Set headers for the CSV file
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=file.csv");
        header("Pragma: no-cache");
        header("Expires: 0");

        ob_end_clean();
        // Open a file pointer for output
        $fp = fopen('php://output', 'w');

        // Write the column headers to the file pointer as CSV
        $headers = array("idea_id", "document_url", "a_status", "categories_id", "views", "submitDate", "user_id", "description", "title", "title_id");
        fputcsv($fp, $headers);

        // Write the data to the file pointer as CSV
        while ($row = mysqli_fetch_assoc($result)) {
            $data = array($row['idea_id'], $row['document_url'], $row['a_status'], $row['categories_id'], $row['views'], $row['submitDate'], $row['user_id'], $row['description'], $row['title'], $row['title_id']);
            fputcsv($fp, $data);
        }

        // Close the file pointer
        fclose($fp);

        // Download the file
        //readfile('file.csv');

        // Close the database connection
        mysqli_close($conn);
    }

    // Check if the download button was clicked
    if (isset($_POST['download_btn'])) {
        // Call the download_csv() function to generate and download the CSV file
        download_csv();
        exit();
    }


    function download_zip(){
        // Define the folder to be zipped and the output ZIP file name
    $folder_path = 'uploads/';
    $zip_name = 'files.zip';

    // Create a new ZIP archive
    $zip = new ZipArchive();

    // Open the archive for writing
    if ($zip->open($zip_name, ZipArchive::CREATE) !== TRUE) {
        die("Unable to create ZIP archive");
    }

    // Create a recursive directory iterator to loop through all files and directories inside the folder
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($folder_path));

    // Loop through the files and add them to the ZIP archive
    foreach ($iterator as $file) {
        // Check if the file is a directory
        if ($file->isDir()) {
            continue;
        }

        // Get the file path and name relative to the folder path
        $file_pathname = $file->getPathname();
        $file_relative_path = substr($file_pathname, strlen($folder_path));

        // Add the file to the ZIP archive using the relative path as the file name
        $zip->addFile($file_pathname, $file_relative_path);
    }

    // Close the ZIP archive
    $zip->close();

    // Download the ZIP archive
    header("Content-type: application/zip");
    header("Content-Disposition: attachment; filename=$zip_name");
    header("Pragma: no-cache");
    header("Expires: 0");
    readfile($zip_name);

    // Delete the ZIP archive
    unlink($zip_name);
    }

    if (isset($_POST['download_zip'])) {
        // Call the download_csv() function to generate and download the CSV file
        download_zip();
    }
    ?>

    <div class="d-flex" id="wrapper">

        <!--sidebar-->
        <?php 
            include("../../nav.php");
        ?>
        
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
                if (isset($_GET['overview'])) {
                    $sql = "SELECT idea.idea_id, idea.document_url, idea.submitDate, idea.title, idea.views, total_likes.total_likes, 
                    total_dislikes.total_dislikes, categories.categories_id, categories.categories, comment.commentDate 
                    FROM idea 
                    LEFT JOIN likepost ON idea.idea_id = likepost.idea_id 
                    LEFT JOIN categories ON idea.categories_id = categories.categories_id 
                    LEFT JOIN comment ON idea.idea_id = comment.idea_id 
                    LEFT JOIN (
                        SELECT idea_id, SUM(t_up) AS total_likes
                        FROM likepost
                        GROUP BY idea_id
                    ) AS total_likes ON idea.idea_id = total_likes.idea_id
                    LEFT JOIN (
                        SELECT idea_id, SUM(t_down) AS total_dislikes
                        FROM likepost
                        GROUP BY idea_id
                    ) AS total_dislikes ON idea.idea_id = total_dislikes.idea_id
                    GROUP BY idea.idea_id DESC LIMIT $start_from, $limit";
                    
                }else if (isset($_GET['view'])) {
                    $sql = "SELECT idea.idea_id, idea.document_url, idea.submitDate, idea.title, idea.views, total_likes.total_likes, 
                            total_dislikes.total_dislikes, categories.categories_id, categories.categories, comment.commentDate 
                            FROM idea
                            LEFT JOIN likepost ON idea.idea_id= likepost.idea_id 
                            LEFT JOIN categories ON idea.categories_id = categories.categories_id
                            LEFT JOIN comment ON idea.idea_id = comment.idea_id
                            LEFT JOIN (
                                        SELECT idea_id, SUM(t_up) AS total_likes
                                        FROM likepost
                                        GROUP BY idea_id
                                    ) AS total_likes ON idea.idea_id = total_likes.idea_id
                                    LEFT JOIN (
                                        SELECT idea_id, SUM(t_down) AS total_dislikes
                                        FROM likepost
                                        GROUP BY idea_id
                                    ) AS total_dislikes ON idea.idea_id = total_dislikes.idea_id
                            group by idea.idea_id ORDER BY views DESC LIMIT $start_from, $limit";
                } else if (isset($_GET['tup'])) {
                    $sql = "SELECT idea.idea_id, idea.document_url, idea.submitDate, idea.title, idea.views, total_likes.total_likes, 
                    total_dislikes.total_dislikes, categories.categories_id, categories.categories, comment.commentDate 
                    FROM idea
                    LEFT JOIN likepost ON idea.idea_id= likepost.idea_id 
                    LEFT JOIN categories ON idea.categories_id = categories.categories_id                 
                    LEFT JOIN comment ON idea.idea_id = comment.idea_id  
                    LEFT JOIN (
                                    SELECT idea_id, SUM(t_up) AS total_likes
                                    FROM likepost
                                    GROUP BY idea_id
                                ) AS total_likes ON idea.idea_id = total_likes.idea_id
                                LEFT JOIN (
                                    SELECT idea_id, SUM(t_down) AS total_dislikes
                                    FROM likepost
                                    GROUP BY idea_id
                                ) AS total_dislikes ON idea.idea_id = total_dislikes.idea_id 
                    group by idea.idea_id ORDER BY total_likes DESC LIMIT $start_from, $limit";
                } else if (isset($_GET['tdown'])) {
                    $sql = "SELECT idea.idea_id, idea.document_url, idea.submitDate, idea.title, idea.views, total_likes.total_likes, 
                    total_dislikes.total_dislikes, categories.categories_id, categories.categories, comment.commentDate 
                    FROM idea
                    LEFT JOIN likepost ON idea.idea_id= likepost.idea_id 
                    LEFT JOIN categories ON idea.categories_id = categories.categories_id                 
                    LEFT JOIN comment ON idea.idea_id = comment.idea_id
                    LEFT JOIN (
                                    SELECT idea_id, SUM(t_up) AS total_likes
                                    FROM likepost
                                    GROUP BY idea_id
                                ) AS total_likes ON idea.idea_id = total_likes.idea_id
                                LEFT JOIN (
                                    SELECT idea_id, SUM(t_down) AS total_dislikes
                                    FROM likepost
                                    GROUP BY idea_id
                                ) AS total_dislikes ON idea.idea_id = total_dislikes.idea_id
                    group by idea.idea_id ORDER BY total_dislikes DESC LIMIT $start_from, $limit";
                } else if (isset($_GET['idea'])) {
                    $sql = "SELECT idea.idea_id, idea.document_url, idea.submitDate, idea.title, idea.views, total_likes.total_likes, 
                    total_dislikes.total_dislikes, categories.categories_id, categories.categories, comment.commentDate 
                    FROM idea
                    LEFT JOIN likepost ON idea.idea_id= likepost.idea_id 
                    LEFT JOIN categories ON idea.categories_id = categories.categories_id                 
                    LEFT JOIN comment ON idea.idea_id = comment.idea_id
                    LEFT JOIN (
                                    SELECT idea_id, SUM(t_up) AS total_likes
                                    FROM likepost
                                    GROUP BY idea_id
                                ) AS total_likes ON idea.idea_id = total_likes.idea_id
                                LEFT JOIN (
                                    SELECT idea_id, SUM(t_down) AS total_dislikes
                                    FROM likepost
                                    GROUP BY idea_id
                                ) AS total_dislikes ON idea.idea_id = total_dislikes.idea_id
                    group by idea.idea_id ORDER BY submitDate DESC LIMIT $start_from, $limit";
                } else if (isset($_GET["comment"])) {
                    // pending comment
                    $sql = "SELECT idea.idea_id, idea.document_url, idea.submitDate, idea.title, idea.views, total_likes.total_likes, 
                            total_dislikes.total_dislikes, categories.categories_id, categories.categories, comment.commentDate 
                            FROM idea
                            LEFT JOIN likepost ON idea.idea_id= likepost.idea_id 
                            LEFT JOIN categories ON idea.categories_id = categories.categories_id                 
                            LEFT JOIN comment ON idea.idea_id=comment.idea_id
                            LEFT JOIN (
                                        SELECT idea_id, SUM(t_up) AS total_likes
                                        FROM likepost
                                        GROUP BY idea_id
                                    ) AS total_likes ON idea.idea_id = total_likes.idea_id
                                    LEFT JOIN (
                                        SELECT idea_id, SUM(t_down) AS total_dislikes
                                        FROM likepost
                                        GROUP BY idea_id
                                    ) AS total_dislikes ON idea.idea_id = total_dislikes.idea_id
                            group by idea.idea_id ORDER BY comment.commentDate DESC LIMIT $start_from, $limit";
                } else {
                    
                    $sql = "SELECT idea.idea_id, idea.document_url, idea.submitDate, idea.title, idea.views, total_likes.total_likes, 
                            total_dislikes.total_dislikes, categories.categories_id, categories.categories, comment.commentDate 
                            FROM idea 
                            LEFT JOIN likepost ON idea.idea_id = likepost.idea_id 
                            LEFT JOIN categories ON idea.categories_id = categories.categories_id 
                            LEFT JOIN comment ON idea.idea_id = comment.idea_id 
                            LEFT JOIN (
                                SELECT idea_id, SUM(t_up) AS total_likes
                                FROM likepost
                                GROUP BY idea_id
                            ) AS total_likes ON idea.idea_id = total_likes.idea_id
                            LEFT JOIN (
                                SELECT idea_id, SUM(t_down) AS total_dislikes
                                FROM likepost
                                GROUP BY idea_id
                            ) AS total_dislikes ON idea.idea_id = total_dislikes.idea_id
                            GROUP BY idea.idea_id DESC LIMIT $start_from, $limit";
                }
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
            ?>

        
            
            <div class="d-flex justify-content-between">
                <select class="btn btn-secondary ms-4 mt-4 select" aria-label="Default select example"
                onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">                
                    <option>Select Filter</option>
                    <option value="ideas.php?overview=true">Overview</option>
                    <option value="ideas.php?view=true">Most View</option>
                    <option value="ideas.php?tup=true">Most Like</option>
                    <option value="ideas.php?tdown=false">Most Dislike</option>
                    <option value="ideas.php?idea=true">Latest Ideas</option>
                    <option value="ideas.php?comment=true">Latest Comment</option>
                </select>
                <div class="btn-group mt-4 me-4">
                    <form method="post">
                        <button type="submit" class="btn btn-secondary" name="download_btn">Download CSV</button>
                        <button type="submit" class="btn btn-secondary" name="download_zip">Download ZIP</button>
                    </form>
                </div>
            </div>

             <div class="table-responsive m-4">
                <table class="table table-bordered table-secondary table-striped align-middle" id="categoryTable">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Categories</th>
                            <th scope="col">Views</th>
                            <th scope="col">Like</th>
                            <th scope="col">Dislike</th>
                            <th scope="col">Document</th>
                            <th scope="col">Submit Date</th>
                            <th scope="col">Latest Comment Date</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                            if ($resultCheck > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id=$row['idea_id'];
                                    $categoryID = $row['categories_id'];
                                    $view=$row['views'];
                                    $url = $row['document_url'];
                                    $submitDate=$row['submitDate'];
                                    $title=$row['title'];                                    
                                    $t_up=$row['total_likes'];
                                    $t_down=$row['total_dislikes'];       

                                    $queryLatestDate = mysqli_query($conn, "select DISTINCT * from comment where idea_id = '$id' order by commentDate DESC");
                                    if (mysqli_num_rows($queryLatestDate) > 0) {
                                        
                                        $latestCommentDate = $row['commentDate'];                             
                                        
                                    }else {
                                        $latestCommentDate = "No comment";
                                    }
                                    
                        ?>
                        <tr>
                            <td><a href="./idea-detail.php?id=<?php echo $id?>"><?php echo $title?></td>
                            <td>
                                <?php
                                    $query1 = mysqli_query($conn, "select * from categories where categories_id = '$categoryID'");
                                    if (mysqli_num_rows($query1) > 0) {
                                        while ($row = mysqli_fetch_assoc($query1)) {
                                            $categoryName = $row['categories'];
                                        }
                                    } 
                                    echo $categoryName;
                                ?>
                            </td>
                            <td><?php echo $view?></td>
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
                                     <a href=" ../../uploads/<?php echo $url?>">Document</a>
                                    
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
                                    echo $latestCommentDate 
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
            
            <?php

                
                $totalidea = mysqli_query($conn, "select * from idea");
                
                $total_records = mysqli_num_rows($totalidea);

                $total_pages = ceil($total_records / $limit);

                $pageLink = "<ul class='pagination ms-4'>";  
                for ($i=1; $i<=$total_pages; $i++) {
                            $pageLink .= "<li class='page-item'><a class='page-link' href='ideas.php?page=".$i."'>".$i."</a></li>";	
                }
                echo $pageLink . "</ul>";  
            ?>
                    
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="../../script.js"></script>    

<?php
include("../../footer.php");
?>