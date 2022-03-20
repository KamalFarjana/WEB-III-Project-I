<?php
include("connect.php");
include("function.php");
$error="";
$success_msg="";
if(isset($_POST['Submit'])){
      #variable_initialization
      $email=$_POST['email'];
      $Confirm_email=$_POST['ConEmail'];
      if($email==$Confirm_email){
        if(email_exists($email, $connection)){
            $_SESSION['email']=$email;
            header("location: ResetPassword.php");
        }
        else{
          $error="Email doesnot exists";
        }
      }
      else{
          $error="Email doesnot match";
      }
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="Assets/bootstrap.css">
    <link rel="stylesheet" href="Assets/style.css">

    <title>Forgot Password? | Book Xchange</title>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Book Xchange</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="aboutus.php">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="browse.php">Browse Books</a>
            </li>
            <?php if(logged_in()){ ?>
            <li class="nav-item">
                <a class="nav-link" href="addbook.php">Add Book</a>
            </li>
           <?php } ?>
            <li class="nav-item">
              <a class="nav-link" href="faq.php">FAQ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contactus.php">Contact Us</a>
            </li>

          </ul>
          <ul class="nav-item navbar-nav navbar-right">
          <li><a class="nav-link" href="signup.php">Register</a></li>
          <li><a class="nav-link" href="signin.php">Sign In</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <main class="form-signin text-center">
      <?php
          if(strlen($error)>0){ ?>
            <div id="error"> <?php echo $error ?>  </div>
      <?php }?>
        <form method="post" action="forgotpassword.php" enctype="multipart/form-data">
          <img class="mb-4" src="Images/swap.png" alt="" width="72" height="72">
          <h1 class="h3 mb-3 fw-normal">Forgot password?</h1>

          <div class="form-floating">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
            <label for="floatingInput">Enter your email</label>
          </div>
          <div class="form-floating">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="ConEmail">
            <label for="floatingInput">Confirm your email</label>
          </div>
          <br/>
          <!-- <button class="w-100 btn btn-lg btn-primary" type="submit" >Sign in</button> -->
          <div class="form-floating">
                <input type="submit" name="Submit" style="background-image: url('Images/submit.png'); border:none; background-repeat:no-repeat; width:200px;height:50px;" value="Submit" /><br/>
          </div>

          <div class="nav-item navbar-nav">
          <p class="mt-5 mb-3">Not registered yet?
              <a class="nav-link belowformlink" href="signup.php">Sign Up</a>
              <br><br>

          </div>
        </form>
      </main>

  <footer class="footer bg-dark mt-auto py-3 bg-light fixed-bottom">
    <div class="container">
        <p class="text-light">copyright © 2022 bookxchange.ca</p>
    </div>
</footer>
<script src="Assets/bootstrap.bundle.min.js"></script>
</body>
</html>
