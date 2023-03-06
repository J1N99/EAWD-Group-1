<?php
include("header.php");
include("includes/dbConnection.inc.php");
if(isset($_GET['view']))
{
    $sql="SELECT * FROM idea ORDER BY views DESC";
   
}
else if(isset($_GET['tup']))
{
    $sql="SELECT idea.idea_id, sum(t_up) FROM idea 
    LEFT JOIN likepost ON idea.idea_id= likepost.idea_id 
    group by idea.idea_id ORDER BY t_up DESC";
   
}
else
{
 $sql="SELECT * FROM idea";
}
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
?>

<label>Filter View:</label>
<select
    onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
    <option default>Please select:</option>
    <option value="list.php?view=true">
        Most view
    </option>
</select>

<label>Filter Thumb-up and Thumb-dowm</label>
<select
    onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
    <option default>Please select:</option>
    <option value="list.php?tup=true">
        Thump-up
    </option>
    <option value="list.php?tup=false">
        Thump-down
    </option>
</select>



<label>Filter lastest ideas</label>
<select
    onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
    <option default>Please select:</option>
    <option value="list.php?idea=true">
        Lastest Idea
    </option>
</select>
<label>Filter lastest</label>
<select
    onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
    <option default>Please lastest comment:</option>
    <option value="list.php?comment=true">
        Lastest comment
    </option>
</select>

<?php
                if ($resultCheck > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                        $url = $row['document_url'];
                        $submitDate=$row['submitDate'];
                        $title=$row['title'];
                        if ($url!=="")
                        {
                            ?>
<a href="uploads/<?php echo $url?>">Document</a>
<?php
                        }
                              else{
                                echo "NO DOCUMENT!";
                              }
                       
                ?>
<h3><?php echo $submitDate?></h3>
<h3><?php echo $title ?></h3>

<?php
        }
}
?>

<?php
include("footer.php");
?>