<?php
include("connect.php");
include("function.php");
$error="";
$success_msg="";
if(logged_in()){
      if(isset($_POST['Submit'])){
            #variable_initialization
            $New_Password=$_POST['New_password'];
            $Confirm_NewPassword=$_POST['Confirm_new_password'];
            #$Fetiching_Old_Password=mysqli_query($connection,"SELECT Password FROM registered_user WHERE Email='" . $_SESSION['email'] . "'");
            #$RetrievedPassword=mysqli_fetch_assoc($Fetiching_Old_Password);
            if(strlen($New_Password)>=7){
                  if($New_Password==$Confirm_NewPassword){
                              $new_hashed_password=md5($New_Password);
                              if(mysqli_query($connection," UPDATE registered_user SET Password='$new_hashed_password' WHERE Email='" . $_SESSION['email'] . "'")){
                                include("Signout.php");
                                #echo ("<script LANGUAGE='JavaScript'>window.alert('Succesfully Updated');window.location.href='signin.php';</script>");
                                $success_msg="Success";
                              }
                              else{
                                $error="failed";
                              }
                             #closing the session as email is saved to session email

                          }
                         else{
                            $error="New password doesnot match";
                         }
            }
            else{
               $error="Password length minimum is: 7";
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
              <a class="nav-link" href="index.php ">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="aboutus.php ">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="browse.php ">Browse Books</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="faq.php ">FAQ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contactus.php ">Contact Us</a>
            </li>

          </ul>
          <ul class="nav-item navbar-nav navbar-right">
            <li><a class="nav-link active" href="signup.php ">Register</a></li>
            <li><a class="nav-link active" href="signin.php">Sign In</a></li>
          </ul>

        </div>
      </div>
    </nav>

    <main class="form-signin text-center">
      <?php
          if(strlen($error)>0){ ?>
            <div id="error"> <?php echo $error ?>  </div>
      <?php }?>
        <form method="post" action="ResetPassword.php" enctype="multipart/form-data">
          <img class="mb-4" src="Images/swap.png" alt="" width="72" height="72">
          <h1 class="h3 mb-3 fw-normal">Reset password?</h1>

          <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="New_password">
            <label for="floatingPassword">New Password</label>
          </div>
          <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="Confirm_new_password">
            <label for="floatingPassword">Confirm New Password</label>
          </div>
<br/>
          <!-- <button class="w-100 btn btn-lg btn-primary" type="submit" >Sign in</button> -->
          <div class="form-floating">
                <input type="submit" name="Submit" style="background-image: url('Images/submit.png'); border:none; background-repeat:no-repeat; width:200px;height:50px;" value="Submit" /><br/>
          </div>


        </form>
      </main>


  <footer class="footer bg-dark mt-auto py-3 bg-light fixed-bottom">
    <div class="container">
        <p class="text-light">copyright © 2021 bookxchange.ca</p>
    </div>
</footer>
<script src="Assets/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
} else {
    echo ("<script LANGUAGE='JavaScript'>window.alert('Login to your account');window.location.href='signin.php';</script>");
}
?>
