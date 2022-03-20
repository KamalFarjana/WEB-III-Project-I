<?php
include("connect.php");
include("function.php");
$error="";
$success_msg="";
if(isset($_POST['Submit'])){
      #variable_initialization
      $FirstName=$_POST['FirstName'];
      $LastName=$_POST['LastName'];
      $email=$_POST['Email'];
      $username=$_POST['UserName'];
      $password=$_POST['Password'];
      $passwordConfirm=$_POST['Conpassword'];
      $Address=$_POST['Address'];
      $PostCode=$_POST['Postal'];
      $Phonenumber=$_POST['PhoneNumber'];
      #$date=date("F, d Y");
      $image=$_FILES['Image']['name'];
      $tmp_image=$_FILES['Image']['tmp_name'];
      $extension_verification = pathinfo($image,PATHINFO_EXTENSION);
      #expression for validating Canadian postal code
      $expression = '/^([a-zA-Z]\d[a-zA-Z])\ {0,1}(\d[a-zA-Z]\d)$/';
      $imagesize=$_FILES['Image']['size'];
      #User name Validation
      if(strlen($FirstName)<3||strlen($LastName)<3)
      {
        $error= "First name or Last name is too short";
      }
      #Not allowing the letters and white space
      elseif(!preg_match("/^[a-zA-Z-' ]*$/",$FirstName) || !preg_match("/^[a-zA-Z-' ]*$/",$LastName)){
        $error="Only letters and white space allowed";
      }
      #User Email Validation and Verification
      elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
      {
        $error="$email is not a valid email address";
      }
      #geting_email_address_from_DB
      elseif(email_exists($email,$connection)>0)
      {
        $error="Email address is already exists!";
      }
      #Validate the username
      elseif( username_exists($username,$connection)>0)
      {
        $error="Username is already exists!";
      }
      #User password Validation and Verification
      elseif(strlen($password)<7)
      {
        $error="Password must be more than 7 characters!!!";
      }
      elseif($password!=$passwordConfirm){
        $error="Passwords doesnot match!!!";
      }
      #checking the validation of the postal code
      elseif(!(bool)preg_match($expression, $PostCode))
      {
        $error="Invalid Postal code. The format should be like  A1A 1A1";
      }
      #format of the canadian phone numbers without country code
      elseif(!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/",  $Phonenumber)){
        $error="Phone number should 000-000-0000 format";
      }
      #image type validation
      else if ($extension_verification != 'jpg' && $extension_verification != 'png' && $extension_verification != 'jpeg'){
          $error = "Only JPG, PNG and JPEG  files are allowed!";
      }
      elseif($imagesize>1048576)
      {
        $error="Image size should not be more than 1MB!";
      }
      else
      {
        #hashing the password
        $Hashed_password=md5($password);
        #unique image name
        $unique_image_name=$email.time().".".$extension_verification;
        #Query to insert the user data into the DataBase
        $insertQuery = "INSERT INTO registered_user(UserName,FirstName,LastName,email,PhoneNumber,Address,PostalCode,Image,Password) VALUES ( '$username','$FirstName','$LastName','$email','$Phonenumber','$Address','$PostCode','$unique_image_name','$Hashed_password')";
        if(mysqli_query($connection, $insertQuery))
          {
          if(move_uploaded_file($tmp_image,"Images/profile/$unique_image_name")){
                #rename("Images/$image", "Images/profile/$unique_image_name");
                $success_msg="You are successfully registered";
                  #header("location: signin.php");
          }
          }
        else
          {
            $error="The attempt was unsuccessful.";
          }
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

    <title>Sign Up | Book Xchange</title>
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
          <li><a class="nav-link active" href="signup.php">Register</a></li>
          <li><a class="nav-link" href="signin.php">Sign In</a></li>
        </ul>
      </div>
    </div>
  </nav>
    <main class="signupform text-center">
        <?php
            if(strlen($error)>0){ ?>
              <div id="error"> <?php echo $error ?>  </div>
        <?php } else {?>
              <div id="success"> <?php echo $success_msg ?></div>
        <?php } ?>
        <form method="post" action="signup.php" enctype="multipart/form-data" style="max-width: 800px;">
          <img class="mb-4" src="Images/swap.png" alt="" width="72" height="72">
          <h1 class="h3 mb-3 fw-normal">Sign up here</h1>
          <div class="row">
              <div class="col-md-6">
                <div class="form-floating">
                  <input type="text" class="form-control" id="floatingInput" placeholder="fName" name="FirstName">
                  <label for="floatingInput">First Name</label>
                </div><br>

                <div class="form-floating">
                  <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com"  name="Email">
                  <label for="floatingInput">Email address</label>
                </div>
                <br>

                <div class="form-floating">
                  <input type="password" class="form-control" id="floatingPassword" placeholder="Password"  name="Password">
                  <label for="floatingPassword">Password</label>
                </div>
                <br>
                <div class="form-floating">
                  <input type="text" class="form-control" id="floatingInput" placeholder="Address Line"  name="Address">
                  <label for="floatingInput">Address</label>
                </div>
                <br>
                <div class="form-floating">
                  <input type="text" class="form-control" id="floatingInput" placeholder="Phone Number" name="PhoneNumber">
                  <label for="floatingInput">Phone Number (000-000-0000)</label>
                </div><br>
              </div>

              <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingInput" placeholder="LName" name="LastName">
                    <label for="floatingInput">Last Name</label>
                  </div><br>
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingInput" placeholder="username"  name="UserName">
                    <label for="floatingInput">Username</label>
                  </div>
                  <br>
                  <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Confirm Password" name="Conpassword">
                    <label for="floatingPassword">Confirm password</label>
                  </div>
                  <br>
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingInput" placeholder="Postal Code" name="Postal">
                    <label for="floatingInput">Postal Code (A1A 1A1)</label>
                  </div><br>

                  <div class="form-floating">
                    <input type="file" class="form-control" id="floatingInput" placeholder="Browse Image" name="Image">
                    <label for="floatingInput">Upload Image</label>
                  </div><br>
              </div>
        </div>
          <!-- <button class="w-100 btn btn-lg btn-primary" type="submit" >Sign in</button> -->
          <!--<a href="signin.php" name="Submit"><img src="Images/signup.png" alt="SignUpButton" style="width:200px;height:50px;"></a> -->
        <input type="submit" name="Submit" style="background: url('Images/signup.png'); border:none; background-repeat:no-repeat; width:200px;height:50px;" value="Sign Up" /><br/>
          <div class="nav-item navbar-nav">
          <p class="mt-5 mb-3">Already registered?
              <a class="nav-link belowformlink" href="signin.php">Sign In</a>

          </div>
        </form>
      </main>

      <footer class="footer bg-dark mt-auto py-3 bg-light">
        <div class="container">
            <p class="text-light">copyright © 2022 bookxchange.ca</p>
        </div>
    </footer>
    <script src="Assets/bootstrap.bundle.min.js"></script>
</body>
</html>
