<?php
include("header.php");
?>
<link rel="stylesheet" href="css/login.css">


<form class="container-fluid" action="includes/login.inc.php" method="post">

<?php
    if (isset($_GET['error'])) { 
        $error_msg = $_GET['error']; 
        if ($error_msg == "emptyinput") {
            ?>
            <div class="d-flex justify-content-center mt-4 fade-out alert-box" role="alert">
                <div class="alert alert-danger">
                    Please fill in the email and password
                </div>
            </div>
            <?php
        } else if ($error_msg == "wronglogin") {
          ?>
          <div class="d-flex justify-content-center mt-4 fade-out alert-box" role="alert">
              <div class="alert alert-danger">
                  Email or password incorrect
              </div>
          </div>
          <?php
      } 
    }
  ?>
  <div class="text-center">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-light fs-5">Sign In</h5>

            <div class="form-floating mb-3">
              <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
              <label for="email">Email address</label>
            </div>
            <div class="form-floating mb-3">
              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
              <label for="password">Password</label>
            </div>

            <div class="d-grid">
              <input class="btn btn-primary btn-login text-uppercase fw-bold" name="submit" type="submit" value="Login">
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</form>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<?php
include("footer.php");
?>