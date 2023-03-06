<?php  include("header.php")?>

<form action="includes/addidea.inc.php" method="post" enctype="multipart/form-data">
    <div>


        <label>Product Name:</label><br />
        <input type="text" class="pname" name="pname" placeholder="Name" required><br />

        <label>Product Description:</label><br />
        <textarea class="pdescription" name="pdescription" style="width:80%;height:100px;" required></textarea><br />

        <label>Price:</label><br />
        <input type="number" class="price" name="price" placeholder="Price" min="0.00" max="10000.00" step="0.01"
            required /><br />

        <label>Product Category:</label><br />
        <select class="category" name="category">
            <option value="coffee">Coffee</option>
            <option value="merchandise">Merchandise</option>
        </select>
        <br />


        <!--come back file later-->
        <label>Product Image:<a class="imagelink" href="">View Orginal Image</a></label><br />
        <label style="color:red;font-size:12px;">If update image please upload image else don't upload image <br />Image
            size must below 0.1MB<br />Recommendation size 900px width and height</label>

        <input type="file" name="productimage" />
        <input type="hidden" class="pid" name="pid">
        <br />



    </div>
    <div class="modal-footer">


        <!--close modal example-->

        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->

        <!--End close modal-->

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </div>

</form>
<?php include("footer.php")?>