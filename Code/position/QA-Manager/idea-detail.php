<?php
include("../../header.php");
include("../../includes/dbConnection.inc.php");
include("../../includes/authLogin.inc.php");
?>

<?php
    session_reset()
?>

<link rel="stylesheet" href="../../style.css">

<div class="d-flex" id="wrapper">

    <!--sidebar-->
    <?php 
            include("../../nav.php");
        ?>  

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

          ?>

        <!-- filter function-->
        <div class="btn-toolbar justify-content-between">
            <div class="btn-group">
                <select class="btn btn-secondary mt-4 select" style="margin-left:0.9rem!important"
                    aria-label="Default select example"
                    onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                    <option default>Select Filter</option>
                    <option value="idea-detail.php?comment=true&id=<?php echo $id ?>">Latest Comment</option>
                </select>
            </div>
        </div>
        <!--end of filter-->

        <div class="container-fluid">
            <?php

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

                if ($t_up == NULL) {
                    $t_up = 0; 
                }

                if ($t_down == NULL) {
                    $t_down = 0;                  
                }                                              
          ?>
            <input type="hidden" value=<?php echo $view ?> data-item-id="<?php echo $_GET['id'] ?>" class="view">

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
                <span style="font-size:0.85rem;">Views <?php echo $view;?></span>
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
                        id="like-button"  value="Like" disabled
                        data-item-id="<?php echo $_GET['id'] ?>"
                        data-id="<?php echo $_SESSION['id'] ?>">
                          <i class="far fa-thumbs-up me-2">                            
                            <span class="ms-1 like"><?php echo $t_up ?></span>
                          </i>
                      </button>

                      <?php
                        } else {
                      ?>

                    <div class="d-flex justify-content-between align-items-center">
                    <!-- button group start -->
                    <div class="btn-group ma-0">
                      <button type="button" class="btn btn-sm btn-outline-secondary"
                        id="like-button"  value="Liked" disabled
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
                        id="dislike-button" value="Dislike" disabled
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
                        id="dislike-button" value="Disliked" disabled
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
                      <!-- this is diffult like and dislike -->
                      <div class="d-flex justify-content-between align-items-center">
                        <!-- button group start -->
                        <div class="btn-group ma-0">
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                          id="like-button"  value="Like" disabled
                          data-item-id="<?php echo $_GET['id'] ?>"
                          data-id="<?php echo $_SESSION['id'] ?>" value="Like">
                            <i class="far fa-thumbs-up me-2">                            
                              <span class="ms-1 like"><?php echo $t_up ?></span>
                            </i>
                        </button>

                        <button type="button" class="btn btn-sm btn-outline-secondary"
                          id="dislike-button" value="Dislike" disabled
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
                        <span class="ms-1">Download</span>
                        </i>                        
                      </button>

                      <?php
                        } else {       
                          echo "";
                        }
                      ?>


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

            <!--reply content-->
            
            <?php
            if (isset($_GET['comment'])){
                
                    $comment=$_GET['comment'];
                    if($comment=="true")
                    {
                    $sql2="SELECT comment.comment_id, comment.user_id, comment.a_status, comment.commentDate, comment.idea_id, comment.comment,
                    user.name FROM comment
                    LEFT JOIN user ON comment.user_id= user.user_id
                    WHERE idea_id=$id
                    ORDER BY comment.commentDate DESC";
                    }
            }
            else
            {   $sql2 = "SELECT comment.comment_id, comment.user_id, comment.a_status, comment.commentDate, comment.idea_id, comment.comment,
                user.name FROM comment
                LEFT JOIN user ON comment.user_id= user.user_id
                WHERE idea_id=$id";}
               
           
               $result2 = mysqli_query($conn, $sql2);
               $resultCheck2 = mysqli_num_rows($result2);
           
               if ($resultCheck2 > 0) {
           
                   $sqlCheckLike = "SELECT * FROM likepost WHERE idea_id=$id AND user_id=$_SESSION[id]";
                   $resultClike = mysqli_query($conn, $sqlCheckLike);
                   $resultCheckLike = mysqli_num_rows($resultClike);
                   $rowCheckLike = mysqli_fetch_assoc($resultClike);          
           
                   while ($row2 = mysqli_fetch_assoc($result2)) {
                       $comment = $row2['comment'];
                       $commentDate = $row2['commentDate'];
                       $commentName = $row2['name'];
                       $commentAnn = $row2['a_status'];
            ?>

            <div class="d-flex flex-start mt-4">
              <div class="flex-grow-1 flex-shrink-1">
                <div>
                  <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-1">
                      <?php
                        if ($commentAnn == 1) {
                            echo "Anonymous"; ?><span class="small"> - <?php echo $commentDate ?></span>
                      <?php
                        } else {
                            echo $commentName; ?> - <?php echo $commentDate ?></span>
                      <?php
                        }
                      ?>                      
                    </p>
                  </div>
                  <p class="card-text mb-0">
                    <?php echo $comment ?>
                  </p>
                </div>                      
              </div>
            </div>
            <hr class="hr hr-blurry" />

            <?php
                  }
              }
            ?>
            <!-- reply content end -->
          </div>
          <!-- container fluid end -->


        </div>
        <!-- navbar end -->

                 

        <!--modal dialog-->
        <form action="">
          <div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="replyModalLabel">New message</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">              
                  <div class="mb-3">
                    <label for="message-text" class="col-form-label">Message:</label>
                    <textarea class="form-control comment" id="message-text"></textarea>
                    <label class="form-check-label" for="anonymousBox">Anonymous</label>
                    <input class="form-check-input ms-2 me-2 checkann" type="checkbox" id="anonymousBox" />                                 
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary submit-comment"
                    data-item-id="<?php echo $_GET['id'] ?>"
                    data-id="<?php echo $_SESSION['id'] ?>" value="submit comment">
                      Send message
                  </button>
                </div>
              </div>
            </div>
          </div> 
        </form>

    </div>

    <!-- view function-->
    <script>
      $(document).ready(function() {
          $(window).on('load', function() {
              // Increment view count
              var currentCount = parseInt($('.view').val());
              var item_id = $('.view').data('item-id');

              // Send AJAX request to server to update view count in database
              $.ajax({
                  // Change to your own path if the function failed to run
                  url: '../../includes/viewcount.inc.php',
                  method: 'POST',
                  data: {
                      item_id: item_id,
                      view_count: currentCount + 1
                  },
                  success: function(response) {
                      console.log(response);
                  },
                  error: function(jqXHR, textStatus, errorThrown) {
                      console.log('Error updating view count: ' + errorThrown);
                  }
              });
          });
      });
    </script>

    <!-- comment function-->
    <script>
    var checkbox = 0;
    $('.submit-comment').click(function() {
        if ($('.checkann').prop('checked')) {
            checkbox = 1;
        } else {
            checkbox = 0;
        }

        
        var comment = $(".comment").val();
        var item_id = $(this).data('item-id');
        var id = $(this).data('id');

        if (comment.trim() === "") {
          alert("Cannot be empty");
        } else {
          console.log(checkbox)
            $.ajax({
              // Change to your own path if the function failed to run
              url: '../../includes/comment.inc.php',
              type: 'POST',
              data: {
                  item_id: item_id,
                  id: id,
                  comment: comment,
                  checkbox: checkbox
              },
              success: function(response) {
                location.reload();
              },
              error: function(jqXHR, textStatus, errorThrown) {
                  console.log('Error: ' + textStatus + ' - ' + errorThrown);
              }
          })
        }
        

    });
    </script>

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
                    $("#dislike-button").val("Disliked");
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