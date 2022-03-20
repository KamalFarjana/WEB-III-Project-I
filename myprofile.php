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
?>
<?php
$sql="SELECT * FROM registered_user WHERE Email='$user_check'";
$result=mysqli_query($connection,$sql);
?>
<?php if(logged_in()){ ?>
<?php
while($rows=mysqli_fetch_array($result)){
   $imageSrc = '/Images/profile' . '/'. $rows['Image'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="Assets/bootstrap.css">
    <link rel="stylesheet" href="Assets/style.css">

    <title>My profile | Book Xchange</title>
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

          <ul class="navbar-nav navbar-right">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-bs-toggle="dropdown" aria-expanded="false"> <?php echo $rows['UserName']; ?></a>
                <ul class="dropdown-menu" aria-labelledby="dropdown04">
                    <li><a class="dropdown-item active" href="myprofile.php">My Profile</a></li>
                    <li><a class="dropdown-item" href="myinventory.php">My Inventory</a></li>
                    <li><a class="dropdown-item" href="Signout.php">Sign Out</a></li>
                </ul>
            </li>
      </ul>
        </div>
      </div>
    </nav>

    <main class="flex-shrink-0">
        <div class="container">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">My profile</h1>

          </div>

          <div class="col-md-9 personal-info ">
            <form class="form-horizontal" method=""="POST" action="editprofile.php" enctype="multipart/form-data">
          <table  class="table table-sm profileborder">
            <tr >
              <div align="right"><input type="submit" value="Edit Profile" class="btn btn-primary btn-lg"></div>
              </tr>

            <tr>

              <td><?php echo "<img src='Images/profile/".$rows['Image']."'"?> class="avatar img-circle" alt="avatar" height="150px" width="140px"> </td>

<td>
                <div class="profile-head" style="text-align: left;">
                  <h3>
                      <?php echo  $rows['FirstName']." ". $rows['LastName']?>


                  <br>
                </div>
              </td>
                </tr>
              <tr>
                <td><label class="col-sm-7 control-label" style="text-align: right;">Username</label></td>
                <td><input type="text" class="form-control" disabled="true" value="<?php echo $rows['UserName']; ?>"></td>
              </tr>
              <tr>
                <td><label class="col-sm-7 control-label" style="text-align: right;">First name</label></td>
                <td><input type="text" class="form-control" disabled="true"  value="<?php echo $rows['FirstName']; ?>"</td>
              </tr>
              <tr>
                <td><label class="col-sm-7 control-label" style="text-align: right;">Last name</label></td>
                <td><input type="text" class="form-control" disabled="true"  value="<?php echo $rows['LastName']; ?>"></td>
              </tr>
              <tr>
                <td><label class="col-sm-7 control-label" style="text-align: right;">Phone</label></td>
                <td><input type="tel" class="form-control" disabled="true"  value="<?php echo $rows['PhoneNumber']; ?>"></td>
              </tr>
              <tr>
                <td><label class="col-sm-7 control-label" style="text-align: right;">E-mail address</label></td>
                <td><input type="email" class="form-control" value="<?php echo $rows['Email']; ?>" disabled="true"></td>
              </tr>
              <tr>
                <td><label class="col-sm-7 control-label" style="text-align: right;">Address line</label></td>
                <td><input type="text" class="form-control" disabled="true"  value="<?php echo $rows['Address']; ?>"></td>
              </tr>

              <tr>
                <td><label class="col-sm-7 control-label" style="text-align: right;">Postal Code</label></td>
                <td><input type="text" class="form-control" disabled="true"  value="<?php echo $rows['PostalCode']; ?>"></td>
              </tr>
          </table>
            </form>
          </div>
      </div>
        <br>
      <?php }
      ?>
      </main>
    <?php  } else {
        echo ("<script LANGUAGE='JavaScript'>window.alert('Login to your account');window.location.href='signin.php';</script>");
    }
     ?>


      <footer class="footer bg-dark mt-auto py-3 bg-light">
        <div class="container">
            <p class="text-light">copyright © 2022 bookxchange.ca</p>
        </div>
    </footer>
    <script src="Assets/bootstrap.bundle.min.js"></script>
</body>
</html>
