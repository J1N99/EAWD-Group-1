<!--sidebar-->
<div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
            <img src="../../image/cat.png" class="me-2" style="width:24px;height:24px;"/>Confession
            </div>

            <div class="list-group list-group-flush my-3">
            <?php if($_SESSION['position']==2){?>

             <!-- QA CO-->
                <a href="./dashboard.php" id="dashboard" class="list-group-item list-group-item-action bg-transparent second-text  fw-bold">
                    <i class="fas fa-tachometer-alt me-2"></i>DashBoard
                </a>

                <a href="./ideas.php?overview=true" id="ideas" class="list-group-item list-group-item-action second-text fw-bold ">                    
                    <i class="fas fa-sharp fa-solid fa-lightbulb me-2"></i>Ideas
                </a>

                <a href="./encourage-mail.php" id="encourage" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">                    
                    <i class="fas fa-sharp fa-solid fa-lightbulb me-2"></i>Encourage Mail
                </a>
                <a href="../../includes/signOut.php" class="list-group-item list-group-item-action second-text fw-bold">                    
                    <i class="fas fa-sharp fa-regular fa-right-from-bracket me-2"></i>LogOut
                </a>
                <?php
            }
            ?>
            

            <?php if($_SESSION['position']==1){?>
            <!--QA-Manager-->
                <a href="./dashboard.php" id="dashboard" class="list-group-item list-group-item-action bg-transparent second-text ">
                    <i class="fas fa-tachometer-alt me-2"></i>DashBoard
                </a>

                <a href="./ideas.php" id="ideas" class="list-group-item list-group-item-action second-text fw-bold">                    
                    <i class="fas fa-sharp fa-solid fa-lightbulb me-2"></i>Ideas
                </a>

                <a href="./category.php" id="categories" class="list-group-item list-group-item-action second-text fw-bold">                    
                    <i class="fas fa-solid fa-list me-2"></i>Categories
                </a>

                <a href="./overview.php?overview=true" id="overview" class="list-group-item list-group-item-action second-text fw-bold">                    
                    <i class="fas fa-solid fa-globe me-2"></i>Overview
                </a>

                <a href="./visualisation.php" id="visualisation" class="list-group-item list-group-item-action second-text fw-bold">                    
                    <i class="fas fa-regular fa-chart-line me-2"></i>Visualisation
                </a>

                <a href="../../includes/signOut.php" class="list-group-item list-group-item-action second-text fw-bold">                    
                    <i class="fas fa-sharp fa-regular fa-right-from-bracket me-2"></i>LogOut
                </a>

                <?php
            }
            ?>
             
            <?php if($_SESSION['position']==4){?>
            <!--Staff-->
                <a href="./dashboard.php" id="ideas" class="list-group-item list-group-item-action second-text fw-bold ">                    
                <i class="fas fa-sharp fa-solid fa-lightbulb me-2"></i>Ideas
            </a>

            <a href="../../includes/signOut.php" class="list-group-item list-group-item-action second-text fw-bold">                    
                <i class="fas fa-sharp fa-regular fa-right-from-bracket me-2"></i>LogOut
            </a>

                <?php
            }
            ?>
                
            <?php if($_SESSION['position']==3){?>
            <!--Admin-->

            <a href="./dashboard.php" id="dashboard" class="list-group-item list-group-item-action bg-transparent second-text fw-bold ">
                    <i class="fas fa-tachometer-alt me-2"></i>DashBoard
                </a>

                <a href="./account.php" id="account" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">                    
                    <i class="fas fa-sharp fa-solid fa-lightbulb me-2"></i>Account
                </a>
                
                <a href="./department.php" id="department" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">                    
                    <i class="fas fa-sharp fa-solid fa-lightbulb me-2"></i>Department
                </a> 

                <a href="./title.php" id="title" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">                    
                    <i class="fas fa-sharp fa-solid fa-lightbulb me-2"></i>Title
                </a> 

                <a href="../../includes/signOut.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">                    
                    <i class="fas fa-sharp fa-regular fa-right-from-bracket me-2"></i>LogOut
                </a>


            <?php
            }
            ?>


            </div>
        </div>

        <!--navbar header-->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 id="overviewTitle" class="fs-2 m-0">Ideas</h2>
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
                                <i class="fas fa-user me-2"></i>
                                <?php if($_SESSION['position']==4)
                                {
                                    //echo "Staff Name";
                                    $user_id = $_SESSION['id'];
                            
                                    $sql = mysqli_query($conn, "SELECT name FROM user WHERE user_id = $user_id");
                                    
                                    if(mysqli_num_rows($sql)>0){
                                        $row = mysqli_fetch_assoc($sql);
                                        $user_name = $row['name'];
                                        echo $user_name;
                                    }
                                }
                                    else if($_SESSION['position']==3)
                                {
                                    // echo "Admin Name";
                                    $user_id = $_SESSION['id'];
                            
                                    $sql = mysqli_query($conn, "SELECT name FROM user WHERE user_id = $user_id");
                                    
                                    if(mysqli_num_rows($sql)>0){
                                        $row = mysqli_fetch_assoc($sql);
                                        $user_name = $row['name'];
                                        echo $user_name;
                                    }
                                }
                                else if($_SESSION['position']==2)
                                {
                                    // echo "QA Coordinator Name";
                                    $user_id = $_SESSION['id'];
                            
                                    $sql = mysqli_query($conn, "SELECT name FROM user WHERE user_id = $user_id");
                                    
                                    if(mysqli_num_rows($sql)>0){
                                        $row = mysqli_fetch_assoc($sql);
                                        $user_name = $row['name'];
                                        echo $user_name;
                                    }
                                }
                                else if($_SESSION['position']==1)
                                {
                                    //echo "QA Manager Name";
                                    $user_id = $_SESSION['id'];
                            
                                    $sql = mysqli_query($conn, "SELECT name FROM user WHERE user_id = $user_id");
                                    
                                    if(mysqli_num_rows($sql)>0){
                                        $row = mysqli_fetch_assoc($sql);
                                        $user_name = $row['name'];
                                        echo $user_name;
                                    }
                                }
                                ?>
                            
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                              <li><a class="dropdown-item" href="#">Profile</a></li>
                              <li><a class="dropdown-item" href="../../includes/signOut.php">LogOut</a></li>
                            </ul>
                        </li>
                    </ul> 
                </div>
            </nav>
            <script>
 // Get the current URL
var currentURL = window.location.href;

// Split the URL by '?' character to separate the query parameters
var urlSegments = currentURL.split('?');

// Get the first segment, which should be the path without query parameters
var path = urlSegments[0];

// Split the path by '/' character to create an array
var pathArray = path.split('/');

// Get the last element of the array, which should be the filename
var filename = pathArray[pathArray.length - 1];

// Output the filename to the console for testing
console.log(filename); // should output the filename without any query parameters
            if (filename==="dashboard.php")
            {
                console.log('work')
                $("#dashboard").addClass('active');
                $("#overviewTitle").text("Dashboard");
            }
            else if(filename==="ideas.php")
            {
                console.log(filename)
                $("#ideas").addClass('active');
                $("#overviewTitle").text("Ideas");
            } 
            else if(filename==="encourage-mail.php")
            {
                console.log('work')
                $("#encourage").addClass('active');
                $("#overviewTitle").text("Encourage");
            } 
            else if(filename==="category.php")
            {
                console.log('work')
                $("#categories").addClass('active');
                $("#overviewTitle").text("Category");
            }
            else if(filename==="overview.php")
            {
                console.log('work')
                $("#overview").addClass('active');
                $("#overviewTitle").text("Overview");
            }
            else if(filename==="visualisation.php")
            {
                console.log('work')
                $("#visualisation").addClass('active');
                $("#overviewTitle").text("Visualisation");
            }
            else if(filename==="account.php")
            {
                console.log('work')
                $("#account").addClass('active');
                $("#overviewTitle").text("Account");
            }
            else if(filename==="department.php")
            {
                console.log('work')
                $("#department").addClass('active');
                $("#overviewTitle").text("Department Setting");
            }
            else if(filename==="title.php")
            {
                console.log('work')
                $("#title").addClass('active');
                $("#overviewTitle").text("Title");
            }              
            </script>