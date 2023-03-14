<?php
include("header.php");
include("includes/dbConnection.inc.php");
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




<input type="button" class="like-button" data-item-id="1" data-id="<?php echo $_SESSION['id']?>" value="Like" />
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