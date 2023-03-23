<?php
include("header.php");
include("includes/dbConnection.inc.php");
if (!isset($_GET['id'])) {
    header("location:index.php");
} else if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT idea.idea_id, idea.document_url, idea.submitDate, idea.title, sum(t_up), sum(t_down), idea.description, idea.views, idea.a_status,idea.user_id
    FROM idea 
    LEFT JOIN likepost ON idea.idea_id = likepost.idea_id 
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
    $astatus = $row['a_status'];
    $user_id = $row['user_id'];

    //call author details
    $sqluser = "SELECT * FROM user WHERE user_id=$user_id";
    $resultuser = mysqli_query($conn, $sqluser);
    $resultCheckUser = mysqli_num_rows($resultuser);
    $rowUser = mysqli_fetch_assoc($resultuser);
    $author = $rowUser['name'];

    if ($t_up == null) {
        $t_up = 0;
    }
    if ($t_down == null) {
        $t_down = 0;
    }


?>
<input type="hidden" value=<?php echo $view ?> data-item-id="<?php echo $_GET['id'] ?>" class="view">
<?php echo $title ?>
<pre>
    <?php echo $description ?>
</pre>
<p> This is like:<span class="like"><?php echo $t_up ?></span></p>
<p>This is dislike:<span class="dislike-value"><?php echo $t_down ?></span></p>
<p>Author:<?php
                if ($astatus == 0) {
                    echo $author;
                } else if ($astatus == 1) {
                    echo "Anonymous";
                } ?></p>
<p>Submit by<?php echo $submitDate ?></p>
<a href="uploads/<?php echo $url ?>">This is attachment of document:</a>

<br />
<?php
    $sqlCheckLike = "SELECT * FROM likepost WHERE idea_id=$id AND user_id=$_SESSION[id]";
    $resultClike = mysqli_query($conn, $sqlCheckLike);
    $resultCheckLike = mysqli_num_rows($resultClike);
    $rowCheckLike = mysqli_fetch_assoc($resultClike);
    if ($resultCheckLike > 0) {
        if ($rowCheckLike['t_up'] == 0) {
    ?>
<input type="button" class="like-button" data-item-id="<?php echo $_GET['id'] ?>"
    data-id="<?php echo $_SESSION['id'] ?>" value="Like" />
<?php
        } else {
        ?>
<input type="button" class="like-button" data-item-id="<?php echo $_GET['id'] ?>"
    data-id="<?php echo $_SESSION['id'] ?>" value="Liked" />
<?php
        }

        if ($rowCheckLike['t_down'] == 0) {
        ?>
<input type="button" class="dislike-button" data-item-id="<?php echo $_GET['id'] ?>"
    data-id="<?php echo $_SESSION['id'] ?>" value="Dislike" />
<?php
        } else {
        ?>

<input type="button" class="dislike-button" data-item-id="<?php echo $_GET['id'] ?>"
    data-id="<?php echo $_SESSION['id'] ?>" value="Disliked" />
<?php

        }
    } else {
        ?>
<input type="button" class="like-button" data-item-id="<?php echo $_GET['id'] ?>"
    data-id="<?php echo $_SESSION['id'] ?>" value="Like" />
<input type="button" class="dislike-button" data-item-id="<?php echo $_GET['id'] ?>"
    data-id="<?php echo $_SESSION['id'] ?>" value="Dislike" />
<?php
    }
    ?>




<?php
}


$sql2 = "SELECT comment.comment_id, comment.user_id, comment.a_status, comment.commentDate, comment.idea_id, comment.comment,
user.name FROM comment
LEFT JOIN user ON comment.user_id= user.user_id
WHERE idea_id=$id";

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
<p>This is comment <?php echo $comment ?></p>
<p>This is comment Date <?php echo $commentDate ?></p>
<p>Author:
    <?php
            if ($commentAnn == 1) {
                echo "Anonymous";
            } else {
                echo $commentName;
            }
            ?>
</p>


<?php
    }
}
?>

<br />
<textarea class="comment" style="width:350px;height:100px">
</textarea>


<!--comment btn-->
<?php
$sqlDate = "SELECT * FROM title";
$resultDate = mysqli_query($conn, $sqlDate);
$resultCheckDate = mysqli_num_rows($resultDate);
$rowDate = mysqli_fetch_assoc($resultDate);
$currentDate = date("Y-m-d");

$finalCloseDate = $rowDate['finalCloseDate'];
if (strtotime($currentDate) > strtotime($finalCloseDate)) {
?>
<input type="button" class="submit-comment" data-item-id="<?php echo $_GET['id'] ?>"
    data-id="<?php echo $_SESSION['id'] ?>" value="submit comment" disabled />
<?php
} else {
?>
<input type="button" class="submit-comment" data-item-id="<?php echo $_GET['id'] ?>"
    data-id="<?php echo $_SESSION['id'] ?>" value="submit comment" />
<?php
} 
?>


<input type="checkbox" class="checkann"> Do you want to comment in annoymous
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
            url: '/Web%20Developement/Code/includes/viewcount.inc.php',
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
    $.ajax({
        // Change to your own path if the function failed to run
        url: '/Web%20Developement/Code/includes/comment.inc.php',
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
});
</script>

<!-- start like function-->
<script>
$('.like-button').click(function() {
    // Get the ID of the item being liked

    var item_id = $(this).data('item-id');
    var id = $(this).data('id');

    // Send an HTTP request to the server
    $.ajax({
        // Change to your own path if the function failed to run
        url: '/Web%20Developement/Code/includes/like.inc.php',
        type: 'POST',
        data: {
            item_id: item_id,
            id: id
        },
        success: function(response) {
            var likevalue = parseInt($(".like").text());
            console.log(likevalue);

            if ($(".like-button").val() === 'Liked') {


                console.log("This is remove like");
                var newlike = likevalue - 1;

                $(".like").text(newlike);

                $('.like-button').val('Like');

            } else if ($(".like-button").val() === 'Like') {
                console.log("This is add like");
                var newlike = likevalue + 1;

                $(".like").text(newlike);

                $('.like-button').val('Liked');
            }

            if ($(".dislike-button").val() === "Disliked") {

                var dislikevalue = parseInt($(".dislike-value").text());
                console.log(dislikevalue)
                var newdislike = dislikevalue - 1;
                console.log(newdislike)
                $(".dislike-value").text(newdislike);
                $(".dislike-button").val("Dislike");
                $('.like-button').val('Liked');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('Error: ' + textStatus + ' - ' + errorThrown);
        }
    });


});


// start dislike function
$('.dislike-button').click(function() {
    // Get the ID of the item being liked
    var item_id = $(this).data('item-id');
    var id = $(this).data('id');

    // Send an HTTP request to the server
    $.ajax({
        // Change to your own path if the function failed to run
        url: '/Web%20Developement/Code/includes/dislike.inc.php',
        type: 'POST',
        data: {
            item_id: item_id,
            id: id
        },
        success: function(response) {

            var dislikevalue = parseInt($(".dislike-value").text());
            console.log(dislikevalue);


            if ($(".dislike-button").val() === 'Disliked') {


                var newdislike = dislikevalue - 1;

                $(".dislike-value").text(newdislike);

                $('.dislike-button').val('Dislike');

            } else if ($(".dislike-button").val() === 'Dislike') {

                console.log("This is add dislike");

                var newdislike = dislikevalue + 1;

                $(".dislike-value").text(newdislike);

                $('.dislike-button').val('Disliked');
            }


            if ($(".like-button").val() === "Liked") {

                var likevalue = parseInt($(".like").text());

                var newlike = likevalue - 1;

                $(".like").text(newlike);
                $(".dislike-button").val("Disliked");
                $('.like-button').val('Like');
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
<?php
include("footer.php");
?>