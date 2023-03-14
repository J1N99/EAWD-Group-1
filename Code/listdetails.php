<?php
include("header.php");
include("includes/dbConnection.inc.php");
if(!isset($_GET['id']))
{
    header("location:index.php");
}
else if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $sql="SELECT idea.idea_id, idea.document_url,idea.submitDate,idea.title,sum(t_up),sum(t_down),idea.description FROM idea
    LEFT JOIN likepost ON idea.idea_id= likepost.idea_id 
    group by idea.idea_id ORDER BY views DESC";

}
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
$row=mysqli_fetch_assoc($result);
if ($resultCheck > 0) {
    
        //$id=$row['idea_id'];
        $url = $row['document_url'];
        $submitDate=$row['submitDate'];
        $title=$row['title'];
        $t_up=$row['sum(t_up)'];
        $t_down=$row['sum(t_down)'];
        $description=$row['description'];
       /*
        $a_status=$row['a_status'];
        $user_id=$row['user_id'];
        $commentDate=$row['commentDate'];
        $comment=$row['comment'];
        */
            
?>

<h1>
    <? echo $title?>
</h1>
<pre>
    <?echo $description?>
</pre>
<p> This is like:<?php echo $t_up ?></p>
<p>This is dislike:<?php echo $t_down?></p>
<p>Submit by<?php echo $submitDate ?></p>
<a href="uploads/<?php echo $url ?>">This is attachment of document:</a>

<?php
}


$sql2="SELECT comment.comment_id, comment.user_id, comment.a_status, comment.commentDate, comment.idea_id, comment.comment,
user.name FROM comment
LEFT JOIN user ON comment.user_id= user.user_id
WHERE idea_id=$id";

$result2 = mysqli_query($conn, $sql2);
$resultCheck2 = mysqli_num_rows($result2);

if ($resultCheck2 > 0) {
    while ($row2 = mysqli_fetch_assoc($result2)) {
        $comment=$row2['comment'];
        $commentDate=$row2['commentDate'];
        $commentName=$row2['name'];

        ?>
<p>This is comment <?php echo $comment ?></p>
<p>This is comment Date <?php echo $commentDate?></p>
<p>Author: <?php echo $commentName?></p>
<input type="button" class="like-button" data-item-id="<?php echo $_GET['id']?>" data-id="<?php echo $_SESSION['id']?>"
    value="Like" />

<?php
    }
}
?>

<script>
$('.like-button').click(function() {
    // Get the ID of the item being liked
    var item_id = $(this).data('item-id');
    var id = $(this).data('id');
    console.log(item_id);
    console.log(id);
    // Send an HTTP request to the server
    $.ajax({
        url: '/Web%20Developement/code/includes/like.inc.php',
        type: 'POST',
        data: {
            item_id: item_id,
            id: id
        },
        success: function(response) {
            $('.like-button').val('Liked!');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('Error: ' + textStatus + ' - ' + errorThrown);
        }
    });


});
</script>
<?php
include("footer.php");
?>