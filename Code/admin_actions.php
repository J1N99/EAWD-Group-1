<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Closure Date</title>
</head>
<body>

<?php

    $con = new mysqli('localhost:3307','root','','feedbackdb');
  $query = $con->query("
  SELECT date FROM closuredate order by id DESC LIMIT 1
  ");

  if (mysqli_num_rows($query) == 0) {
    echo "No closure date was set";
} else {
    while($rowData = mysqli_fetch_array($query)){
        echo "Current closure date is ".$rowData["date"].'<br>';
  }
}

$dateErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["date"])) {
      $dateErr = "Closure Date is required";
    } else {
        $date = $_POST["date"];
      $query3 = $con->query("INSERT INTO closuredate(date) VALUES ('$date')");
      header('location:' . $_SERVER['REQUEST_URI']);
    }
}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Closure Date: <input type="date" name="date" value="<?php echo $date;?>">
  <span class="error">* <?php echo $dateErr;?></span>
  
  <input type="submit" name="submit" value="Set">  
</form>

</body>
</html>
