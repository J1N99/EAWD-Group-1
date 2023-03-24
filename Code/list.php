<?php
include("header.php");
include("includes/dbConnection.inc.php");
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

<label>Filter View:</label>
<select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
    <option default>Please select:</option>
    <option value="list.php?view=true">
        Most view
    </option>
</select>

<label>Filter Thumb-up and Thumb-dowm</label>
<select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
    <option default>Please select:</option>
    <option value="list.php?tup=true">
        Thump-up
    </option>
    <option value="list.php?tup=false">
        Thump-down
    </option>
</select>



<label>Filter latest ideas</label>
<select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
    <option default>Please select:</option>
    <option value="list.php?idea=true">
        Latest Idea
    </option>
</select>
<label>Filter lastest</label>
<select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
    <option default>Please latest comment:</option>
    <option value="list.php?comment=true">
        Lastest comment
    </option>
</select>

<?php
if ($resultCheck > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['idea_id'];
        $url = $row['document_url'];
        $submitDate = $row['submitDate'];
        $title = $row['title'];
        $t_up = $row['sum(t_up)'];
        $t_down = $row['sum(t_down)'];

?>
        <br />
        <a href="listdetails.php?id=<?php echo $id ?>"><?php echo $title ?></a>
        <br />
        <h1>Like
            <?php
            if ($t_up == null) {
                $t_up = 0;
            }
            echo $t_up;
            ?>
        </h1>
        <h1>Dislike <?php
                    if ($t_down == null) {
                        $t_down = 0;
                    }
                    echo $t_down ?></h1>
        <?php
        if ($url !== "") {
        ?>
            <a href=" uploads/<?php echo $url ?>">Document</a>
        <?php
        } else {
            echo "NO DOCUMENT!";
        }

        ?>
        <h3><?php echo $submitDate ?></h3>
        <h3><?php echo $title ?></h3>

<?php
    }
}
?>

<?php
include("footer.php");
?>