<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="Assets/bootstrap.css">
    <link rel="stylesheet" href="Assets/style.css">

    <title>Edit Profile | Book Xchange</title>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.html">Book Xchange</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="index.html">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="aboutus.html">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="browse.html">Browse Books</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="addbook.html">Add Book</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="faq.html">FAQ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contactus.html">Contact Us</a>
            </li>
          </ul>

          <ul class="navbar-nav navbar-right">
            <li><a class="nav-link">Last Login <b>March 31, 2021</b>.</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-bs-toggle="dropdown" aria-expanded="false">dwarfplanet</a>
                <ul class="dropdown-menu" aria-labelledby="dropdown04">
                    <li><a class="dropdown-item" href="myprofile.html">My Profile</a></li>
                    <li><a class="dropdown-item" href="myinventory.html">My Inventory</a></li>
                    <li><a class="dropdown-item" href="index.html">Sign Out</a></li>
                </ul>
            </li>
      </ul>
        </div>
      </div>
    </nav>

<<<<<<< Updated upstream
    <main class="flex-shrink-0">
      <div class="container">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h2>Edit Profile</h2>
=======
  <?php
   include('session.php');
   function logged_in(){
     if(isset($_SESSION['email'])){
       return true;
     }
     else{
       return false;
     }
   }
    $query=mysqli_query($connection,"SELECT * FROM registered_user where Email='$user_check'")or die(mysqli_error());

  $sql="SELECT * FROM registered_user WHERE Email='$user_check'";
  $result=mysqli_query($connection,$sql);
  $results=mysqli_query($connection,$sql);
  $responses = [];
  $rows=mysqli_fetch_array($result);
  $roww=mysqli_fetch_object($results);
  if(isset($_POST['update'])){

    $Fname =    $_POST['fname'];
    $lname =   $_POST['lname'];
    $add   =   $_POST['address'];
    $pc    =   $_POST['postalcode'];
    $ph    =   $_POST['phone'];
    $old   =   $_POST['old'];
    $new   =   $_POST['new'];
    $retype=   $_POST['confirm'];
    $delimg=  $_POST['oldimage'];
    $image =   $_FILES ['userImage'] ['name'];
    $tmp_image=$_FILES ['userImage'] ['tmp_name'];
    $extension_verification = pathinfo($image,PATHINFO_EXTENSION);
    $imagesize=$_FILES['userImage']['size'];
      $expression = '/^([a-zA-Z]\d[a-zA-Z])\ {0,1}(\d[a-zA-Z]\d)$/';

    if(strlen($Fname)<3||strlen($lname)<3)
    {
            $responses[]='First name or Last name is too short';
          }
    if(!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/",  $ph)){

              $responses[]='Phone Number should be 10 or less in number';}


    if(!(bool)preg_match($expression, $pc))
      {
              $responses[]="Invalid Postal code. The format should be like  A1A 1A1";
            }



    if(!$responses)
    {
      if(!empty($Fname)|| !empty($lname) || !empty($add)|| !empty($pc) ||!empty($ph) || $image != '')
    {
        if(!empty($old)){
          if((md5($old)==$roww->Password)){

        //check if new password match retype
          if($new == $retype && strlen($new)>7)
             {
  //hash our password
            $password = md5($new);
            if(  $imagesize== 0){
              $sql = "UPDATE registered_user SET Password='$password',FirstName = '$Fname',  LastName='$lname',PhoneNumber='$ph',Address='$add',PostalCode='$pc'
              WHERE Email= '$user_check'";
              include("Signout.php");
              echo ("<script LANGUAGE='JavaScript'>window.alert('Succesfully Updated');window.location.href='signin.php';</script>");

            }

          #unique image name
          else{
            $unique_image_name=$user_check.time().".".$extension_verification;

          $sql = "UPDATE registered_user SET Password='$password',FirstName = '$Fname',  LastName='$lname',PhoneNumber='$ph',Address='$add',PostalCode='$pc',Image='$unique_image_name'
          WHERE Email= '$user_check'";
          if(mysqli_query($connection, $sql))
          {
            //if(move_uploaded_file($tmp_image,"Images/profile".$image)){
              if(move_uploaded_file($tmp_image,"Images/profile/$unique_image_name")){
              // rename("Images/profile".$image, "Images/profile".$unique_image_name);
                unlink("Images/profile/$delimg");
               include("Signout.php");
                 echo "<script>alert('Successfully Updated'); window.location.href='signin.php';</script>";
            }
          }
          #unique image name
        }}
        else{
          if($new != $retype){

                  $responses[]='New and Confirm Password does not match!!!';
                }
                elseif(strlen($new)<7){
                    $responses[]='Password must contain more than 7 characters!!!';
                }
        }
      }
      else{
          $responses[]="Current Password is incorrect!!!";

      }
    }
    else{
      if(!empty($new)||!empty($confirm))
      {
          $responses[]="Please enter current password";
      }
      else{
      if($_FILES['userImage']['size'] == 0 ){

        $sql = "UPDATE registered_user SET FirstName = '$Fname',  LastName='$lname',PhoneNumber='$ph', Address='$add',PostalCode='$pc'
        WHERE Email= '$user_check'";
        header('location: myprofile.php?message="Updated"');
      }
    else{
      $unique_image_name=$user_check.time().".".$extension_verification;


    $sql = "UPDATE registered_user SET FirstName = '$Fname',  LastName='$lname',PhoneNumber='$ph',Address='$add',PostalCode='$pc',Image='$unique_image_name'
    WHERE Email= '$user_check'";
    if(mysqli_query($connection, $sql))
    {
      if(move_uploaded_file($tmp_image,"Images/profile/$unique_image_name")){
        //rename("Images/profile".$image, "Images/profile".$unique_image_name);
          unlink("Images/profile/$delimg");
        $success_msg="You are successfully updated";
        header('location: myprofile.php?message="Updated successfully"');

    }

  }
  }
  }
  }
  }
  else{
  $sql = "UPDATE registered_user SET FirstName = '$Fname',  LastName='$lname',PhoneNumber='$ph',Address='$add',PostalCode='$pc'
  WHERE Email= '$user_check'";
  header('location: myprofile.php?message="Updated"');
  }
  }
  }
  ?>
<?php if(logged_in()){ ?>
  <?php
  $result=mysqli_query($connection,$sql);
  while($rows=mysqli_fetch_array($result)){


  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <link rel="stylesheet" href="Assets/bootstrap.css">
      <link rel="stylesheet" href="Assets/style.css">

      <title>Edit Profile | Book Xchange</title>
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
                <a class="nav-link" aria-current="page" href="index.php">Home</a>
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

            <ul class="navbar-nav navbar-right">
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $rows['UserName']; ?></a>
                  <ul class="dropdown-menu" aria-labelledby="dropdown04">
                      <li><a class="dropdown-item" href="myprofile.php">My Profile</a></li>
                      <li><a class="dropdown-item" href="myinventory.php">My Inventory</a></li>
                      <li><a class="dropdown-item" href="Signout.php">Sign Out</a></li>
                  </ul>
              </li>
        </ul>

          </div>
>>>>>>> Stashed changes
        </div>
      <div class="row">
          <!-- left column -->
          <div class="col-md-3">
            <div class="text-center">
              <img src="Images/avatar.png" class="avatar img-circle" alt="avatar" height="120px" width="120px">
              <h6>Upload a different photo...</h6>
              
              <input type="file" class="form-control">
            </div>
          </div>
          
          <!-- edit form column -->
          <div class="col-md-9 personal-info ">
            <form class="form-horizontal">
            
              <div class="panel panel-default">
                <div class="panel-heading">
                <h4 class="panel-title">Personal info</h4>
                </div>

              <div class="col-md-9 personal-info ">
                <form class="form-horizontal">
              <table  class="table table-sm profileborder">

                  <tr>  
                    <td><label class="col-sm-7 control-label" style="text-align: left;">Username</label></td>
                    <td><input type="text" class="form-control" disabled="true" value="dwarfplanet"></td>
                  </tr>
                  <tr>
                    <td><label class="col-sm-7 control-label" style="text-align: left;">First name</label></td>
                    <td><input type="text" class="form-control" value="Jay"></td>
                  </tr>
                  <tr>
                    <td><label class="col-sm-7 control-label" style="text-align: left;">Last name</label></td>
                    <td><input type="text" class="form-control" value="Patel"></td>
                  </tr>
                    <tr>
                    <td><label class="col-sm-7 control-label" style="text-align: left;">Birthdate</label></td>
                    <td><input type="date" class="form-control" value="07-09-1995"></td>
                  </tr>
                  
              </table>
                </form>
              </div>
            </div>





              <br>
              <div class="panel panel-default">
                <div class="panel-heading">
                <h4 class="panel-title">Contact info</h4>
                </div>

                <div class="col-md-9 personal-info ">
                  <form class="form-horizontal">
                <table  class="table table-sm profileborder">
  
                    <tr>  
                      <td><label class="col-sm-7 control-label" style="text-align: left;">Phone</label></td>
                      <td><input type="tel" class="form-control" value="807 123-1234"></td>
                    </tr>
                    <tr>
                      <td><label class="col-sm-7 control-label" style="text-align: left;">E-mail address</label></td>
                      <td><input type="email" class="form-control" value="dwarfplanet@email.com" disabled="true"></td>
                    </tr>
  
                </table>
                  </form>
                </div>
              </div>
                <br>

            <div class="panel panel-default">
              <div class="panel-heading">
              <h4 class="panel-title">Location Info</h4>
              </div>
              <div class="col-md-9 personal-info ">
                <form class="form-horizontal">
              <table  class="table table-sm profileborder">

                  <tr>  
                    <td><label class="col-sm-7 control-label" style="text-align: left;">Address line</label></td>
                    <td><input type="text" class="form-control" value="123 Arrowsmith Close"></td>
                  </tr>
                  <tr>
                    <td><label class="col-sm-7 control-label" style="text-align: left;">City</label></td>
                    <td><input type="text" class="form-control" value="Thunder Bay"></td>
                  </tr>
                  <tr>
                    <td><label class="col-sm-7 control-label" style="text-align: left;">Postal Code</label></td>
                    <td><input type="text" class="form-control" value="P7B 5Y9"></td>
                  </tr>
              </table>
                </form>
              </div>
            </div>
            <br>
            
            <div class="panel panel-default">
              <div class="panel-heading">
              <h4 class="panel-title">Security Info</h4>
              </div>
              <div class="col-md-9 personal-info ">
                <form class="form-horizontal">
              <table  class="table table-sm profileborder">

                  <tr>  
                    <td><label class="col-sm-7 control-label" style="text-align: left;">Current password</label></td>
                    <td><input type="password" class="form-control"></td>
                  </tr>
                  <tr>
                    <td><label class="col-sm-7 control-label" style="text-align: left;">New password</label></td>
                    <td><input type="password" class="form-control"></td>
                  </tr>
                  <tr>
                    <td><label class="col-sm-7 control-label" style="text-align: left;">Confirm new password</label></td>
                    <td><input type="password" class="form-control"></td>
                  </tr>
              </table>
                </form>
              </div>
            </div>
          </form>
          </div>
      </div>
<<<<<<< Updated upstream
      <a href="myprofile.html"><img src="Images/cancel.png" alt="CancelButton" style="width:200px;height:60px;"></a>
      <a href="myprofile.html"><img src="Images/update.png" alt="UpdateButton" style="width:200px;height:60px;"></a>
=======
      <br><br>
      </main>

  </form>
  <footer class="footer bg-dark mt-auto py-3 bg-light">
    <div class="container">
        <p class="text-light">copyright © 2022 bookxchange.ca</p>
>>>>>>> Stashed changes
    </div>
    <br><br>
    </main>

    <footer class="footer bg-dark mt-auto py-3 bg-light">
      <div class="container">
          <p class="text-light">copyright © 2021 bookxchange.ca</p>
      </div>
  </footer>
  <script src="Assets/bootstrap.bundle.min.js"></script>
</body>
</html>