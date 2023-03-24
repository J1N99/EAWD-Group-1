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

            <a href="./dashboard.php" class="list-group-item list-group-item-action second-text fw-bold active">                    
                <i class="fas fa-sharp fa-solid fa-lightbulb me-2"></i>Ideas
            </a>

            <a href="../login.php" class="list-group-item list-group-item-action second-text fw-bold">                    
                <i class="fas fa-sharp fa-regular fa-right-from-bracket me-2"></i>LogOut
            </a>

        </div>
      </div>
        <!-- sidebar end -->

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

            <div class="collapse navbar-collapse " id="navbarSupportedContent">
              <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                  <a class="dropdown-toggle primary-text fw-bold" href="#" id="navbarDropdownMenuLink" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-user me-2"></i>Staff Name
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

          
          <!-- content start-->        
          <?php
            if (!isset($_GET['id'])) {
              header("location:index.php");
            } else if (isset($_GET['id'])) {
              $id = $_GET['id'];
              $sql = "SELECT idea.idea_id, idea.document_url, idea.submitDate, idea.title, user.name, idea.a_status, sum(t_up), sum(t_down), idea.description, idea.views 
              FROM idea 
              LEFT JOIN likepost ON idea.idea_id = likepost.idea_id
              LEFT JOIN user ON idea.user_id = user.user_id 
              WHERE idea.idea_id = $id 
              GROUP BY idea.idea_id 
              ORDER BY views DESC";
            }

            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            $row = mysqli_fetch_assoc($result);

            if ($resultCheck > 0) {
          
              //$id=$row['idea_id'];
              $url = $row['document_url'];
              $submitDate = $row['submitDate'];
              $title = $row['title'];
              $t_up = $row['sum(t_up)'];
              $t_down = $row['sum(t_down)'];
              $description = $row['description'];
              $view = $row['views'];
              $userName = $row['name'];
              $astatus = $row['a_status'];

              if ($t_up == null) {
                  $t_up = 0;
              }
              if ($t_down == null) {
                  $t_down = 0;
              }                              
          ?>

          <div class="container-fluid">
            <!-- post card start -->
            <div class="card my-3">

              <!-- card header start -->
              <div class="card-header border-0 bg-transparent">
                <h5 class="card-title text-start"><?php echo "Posted by: ";
                  if ($astatus == 0) {
                      echo $userName;
                  } else if ($astatus == 1) {
                      echo "Anonymous";
                  } ?>
                  <span class="fs-6 text-start fw-light fst-italic"> - <?php echo $submitDate ?></span>
                </h5>
              </div>
              <!-- card header end -->

              <!-- card body start -->
              <div class="card-body">
                <p class="card-text"><?php echo $description ?></p>

                  <!-- This is like and dislike checked   -->
                  <?php
                    $sqlCheckLike = "SELECT * FROM likepost WHERE idea_id=$id AND user_id=$_SESSION[id]";
                    $resultClike = mysqli_query($conn, $sqlCheckLike);
                    $resultCheckLike = mysqli_num_rows($resultClike);
                    $rowCheckLike = mysqli_fetch_assoc($resultClike);

                    if ($resultCheckLike > 0) {
                      if ($rowCheckLike['t_up'] == 0) {
                  ?>

                  <div class="d-flex justify-content-between align-items-center">
                    <!-- button group start -->
                    <div class="btn-group ma-0">
                      <button type="button" class="btn btn-sm btn-outline-secondary" 
                        id="like-button"  value="Like"
                        data-item-id="<?php echo $_GET['id'] ?>"
                        data-id="<?php echo $_SESSION['id'] ?>">
                          <i class="far fa-thumbs-up me-2">                            
                            <span class="ms-1 like"><?php echo $t_up ?></span>
                          </i>
                      </button>

                      <?php
                        } else {
                      ?>

                      <button type="button" class="btn btn-sm btn-outline-secondary"
                        id="like-button"  value="Liked"
                        data-item-id="<?php echo $_GET['id'] ?>"
                        data-id="<?php echo $_SESSION['id'] ?>">
                          <i class="far fa-thumbs-up me-2">                            
                            <span class="ms-1 like"><?php echo $t_up ?></span>
                          </i>
                      </button>

                      <?php
                        }
                          if ($rowCheckLike['t_down'] == 0) {
                      ?>

                      <button type="button" class="btn btn-sm btn-outline-secondary"
                        id="dislike-button" value="Dislike"
                        data-item-id="<?php echo $_GET['id'] ?>"
                        data-id="<?php echo $_SESSION['id'] ?>">
                          <i class="far fa-thumbs-down me-2">
                            <span class="ms-1  dislike-value"><?php echo $t_down ?></span>
                          </i>
                      </button> 

                      <?php
                        } else {
                      ?>

                      <button type="button" class="btn btn-sm btn-outline-secondary"
                        id="dislike-button" value="Disliked" 
                        data-item-id="<?php echo $_GET['id'] ?>"
                        data-id="<?php echo $_SESSION['id'] ?>">
                          <i class="far fa-thumbs-down me-2">
                            <span class="ms-1 dislike-value"><?php echo $t_down ?></span>
                          </i>
                      </button>

                      <?php
                          }
                        } else {
                      ?>
                      
                      <button type="button" class="btn btn-sm btn-outline-secondary"
                        id="like-button"  value="Like"
                        data-item-id="<?php echo $_GET['id'] ?>"
                        data-id="<?php echo $_SESSION['id'] ?>" value="Like">
                          <i class="far fa-thumbs-up me-2">                            
                            <span class="ms-1 like"><?php echo $t_up ?></span>
                          </i>
                      </button>

                      <button type="button" class="btn btn-sm btn-outline-secondary"
                        id="dislike-button" value="Dislike" 
                        data-item-id="<?php echo $_GET['id'] ?>"
                        data-id="<?php echo $_SESSION['id'] ?>" value="Dislike">
                          <i class="far fa-thumbs-down me-2">
                            <span class="ms-1  dislike-value"><?php echo $t_down ?></span>
                          </i>
                      </button> 

                      <?php
                        }
                      ?>

                      <?php
                        if ($url!=="") {
                      ?>

                      <button type="button" class="btn btn-sm btn-outline-secondary"
                        onclick="window.location.href='../../uploads/<?php echo $url?>'">
                        <i class="far fa-file">
                        <span class="ms-1  dislike-value">Download</span>
                        </i>                        
                      </button>

                      <?php
                        } else {       
                          echo "";
                        }
                      ?>

                      <button type="button" class="btn btn-sm btn-outline-secondary" 
                        data-bs-toggle="modal" data-bs-whatever="idea post person" data-bs-target="#replyModal" id="replyBtn">Reply
                      </button>

                    </div>
                    <!-- button group end -->
                  </div>
                  <?php
                    }
                  ?>
              </div>
              <!-- card body end -->
            </div>
            <!-- post card end -->
          </div>

           <!--reply content-->          
          <div class="d-flex flex-start mt-4">
            <div class="flex-grow-1 flex-shrink-1">
              <div>
                <div class="d-flex justify-content-between align-items-center">
                  <p class="mb-1">
                    Simona Disa <span class="small">- 3 hours ago</span>
                  </p>
                </div>
                <p class="card-text mb-0">
                  letters, as opposed to using 'Content here, content here',
                  making it look like readable English.
                </p>
              </div>                      
            </div>
          </div>

          <hr class="hr hr-blurry" />
          <div class="d-flex flex-start mt-4">
            <div class="flex-grow-1 flex-shrink-1">
              <div>
                <div class="d-flex justify-content-between align-items-center">
                  <p class="mb-1">
                    Simona Disa <span class="small">- 3 hours ago</span>
                  </p>
                </div>
                <p class="card-text mb-0">
                  letters, as opposed to using 'Content here, content here',
                  making it look like readable English.
                </p>
              </div>                      
            </div>
          </div>
          <!-- reply content end -->
          
        </div>
        <!-- navbar end -->

                 

        <!--modal dialog-->
        <div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="replyModalLabel">New message</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form>
                  <div class="mb-3">
                    <label for="message-text" class="col-form-label">Message:</label>
                    <textarea class="form-control" id="message-text"></textarea>
                    <label class="form-check-label" for="anonymousBox">Anonymous</label>
                    <input class="form-check-input ms-2 me-2" type="checkbox" value="" id="anonymousBox" />                                 
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send message</button>
              </div>
            </div>
          </div>
        </div> 



    </div>

    <script>
    $('#like-button').click(function() {
        // Get the ID of the item being liked

        var item_id = $(this).data('item-id');
        var id = $(this).data('id');

        // Send an HTTP request to the server
        $.ajax({
            // Change to your own path if the function failed to run
            url: '../../includes/like.inc.php',
            type: 'POST',
            data: {
                item_id: item_id,
                id: id
            },
            success: function(response) {
                var likevalue = parseInt($(".like").text());
                console.log(likevalue);

                if ($("#like-button").val() === 'Liked') {


                    console.log("This is remove like");
                    var newlike = likevalue - 1;

                    $(".like").text(newlike);

                    $('#like-button').val('Like');

                } else if ($("#like-button").val() === 'Like') {
                    console.log("This is add like");
                    var newlike = likevalue + 1;

                    $(".like").text(newlike);

                    $('#like-button').val('Liked');
                }

                if ($("#dislike-button").val() === "Disliked") {

                    var dislikevalue = parseInt($(".dislike-value").text());
                    console.log(dislikevalue)
                    var newdislike = dislikevalue - 1;
                    console.log(newdislike)
                    $(".dislike-value").text(newdislike);
                    $("#dislike-button").val("Dislike");
                    $('#like-button').val('Liked');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Error: ' + textStatus + ' - ' + errorThrown);
            }
        });


    });


    // start dislike function
    $('#dislike-button').click(function() {
        // Get the ID of the item being liked
        var item_id = $(this).data('item-id');
        var id = $(this).data('id');

        // Send an HTTP request to the server
        $.ajax({
            // Change to your own path if the function failed to run
            url: '../../includes/dislike.inc.php',
            type: 'POST',
            data: {
                item_id: item_id,
                id: id
            },
            success: function(response) {

                var dislikevalue = parseInt($(".dislike-value").text());
                console.log("value: "+ dislikevalue);


                if ($("#dislike-button").val() === 'Disliked') {


                    var newdislike = dislikevalue - 1;

                    $(".dislike-value").text(newdislike);

                    $('#dislike-button').val('Dislike');

                } else if ($("#dislike-button").val() === 'Dislike') {

                    console.log("This is add dislike");

                    var newdislike = dislikevalue + 1;

                    $(".dislike-value").text(newdislike);

                    $('#dislike-button').val('Disliked');
                }


                if ($("#like-button").val() === "Liked") {

                    var likevalue = parseInt($(".like").text());

                    var newlike = likevalue - 1;

                    $(".like").text(newlike);
                    $(".dislike-button").val("Disliked");
                    $('#like-button').val('Like');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Error: ' + textStatus + ' - ' + errorThrown);
            }
        });
        var newdislike = <?php echo $t_down ?> + 1;
        $(".dislike").text(newdislike);

    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="../../script.js"></script>
    <script src="./js/idea-detail.js"></script>
    

<?php
include("../../footer.php");
?>