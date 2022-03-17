<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("connect.php");
include("function.php");
$error="";
$success_msg="";

if(isset($_POST['AddBook'])){
  #variable_initialization
  $BookTitle = mysqli_real_escape_string($connection, $_POST['BookTitle']);
  $BookAuthor = mysqli_real_escape_string($connection, $_POST['BookAuthor']);
  $BookISBN = mysqli_real_escape_string($connection, $_POST['BookISBN']);
  $BookGenre = mysqli_real_escape_string($connection, $_POST['BookGenre']);
  $BookCondition = mysqli_real_escape_string($connection, $_POST['BookCondition']);
  $PickupPhone = mysqli_real_escape_string($connection, $_POST['PickupPhone']);
  $PickupEmail = mysqli_real_escape_string($connection, $_POST['PickupEmail']);
  $PickupNote = mysqli_real_escape_string($connection, $_POST['PickupNote']);

  $image = $_FILES['BookCover']['name'] ?? "";
  $tmp_image = $_FILES['BookCover']['tmp_name'] ?? "";
  $imageSize = $_FILES ['BookCover']['size'] ?? "";
  $allowed_image_ext = 'jpg';
  $div_image = explode(".", $image); #seperate name, ext
  $image_ext = end($div_image); #get extention
  #$unique_image_name = substr(md5(time()), 0, 10).".".$image_ext; #generate unique name
  $extension_verification = pathinfo($image,PATHINFO_EXTENSION);

  #$SubmittedBy = $_SESSION["username"];
  $SubmittedBy  = mysqli_real_escape_string($connection, 1);
  $Status  = mysqli_real_escape_string($connection, 1);

  if(strlen($BookTitle)<1){
    $error= "Please enter the book title!";
  }
  else if (strlen($BookAuthor) < 1){
    $error = "Please enter the name of the book's author!";
  }
  else if (strlen($BookGenre) < 1){
    $error = "Please enter the genre for the book!";
  }
  else if (strlen($BookCondition) < 1){
    $error = "Please select book condition!";
  }
  else if (strlen($PickupPhone) < 1 && strlen($PickupEmail) < 1){
    $error = "Please enter either phone number or email for pickup details!";
  }
  else if ($imageSize > 1048576){
    $error = "Image size must be less than 1 MB";
  }
  else if (strcmp($image_ext, $allowed_image_ext) !==0){
    $error = "Please upload jpg cover image for the book!";
  }
  

  else
      {
        $unique_image_name=$BookISBN.time().".".$extension_verification;
        #Query to insert the user data into the DataBase


        $insertQuery = "INSERT INTO `books`(`Title`, `Author`, `ISBN`, `Genre`, `Condition`, `Book_image`, `User_id`, `Status`, `PhoneNumber`, `Email`, `Note`) VALUES ('$BookTitle','$BookAuthor','$BookISBN','$BookGenre','$BookCondition','$unique_image_name','$SubmittedBy','$Status','$PickupPhone','$PickupEmail','$PickupNote')";
        if(mysqli_query($connection, $insertQuery))
          {
          if(move_uploaded_file($tmp_image,"cover/$image")){
                rename("cover/$image", "cover/$unique_image_name");
                $success_msg="You have successfully added the book!";
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

    <title>Add Book | Book Xchange</title>
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
              <a class="nav-link" href="index.html">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="aboutus.html">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="browse.html">Browse Books</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="addbook.php">Add Book</a>
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

      <main class="flex-shrink-0">
        <div class="container py-4 container-fluid">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Add Book Information</h1>
          </div>

          <div class="row">
          <?php
            if(strlen($error)>0){ ?>
              <div id="error"> <?php echo $error ?>  </div>
          <?php } else {?>
              <div id="success"> <?php echo $success_msg ?></div>
          <?php } ?>
          <form method="post" action="addbook.php" enctype="multipart/form-data" class="form-horizontal addbook">
              <h3>Book Details</h3>
              <table   class="table table-sm profileborder">
                <tr>
                  <td><label class="col-sm-7 control-label" style="text-align: left;" for="bookCover" name="BookCover">Book Cover</label></td>
                  <td><input type="file" class="form-control" id="BookCover" name="BookCover"></td>
                </tr>
              <tr>  
                <td><label class="col-sm-7 control-label" style="text-align: left;" name="BookTitle">Book Title</label></td>
                <td><input type="text" class="form-control" placeholder="Enter book title" id="BookTitle" name="BookTitle"></td>
              </tr>
              <tr>
                <td><label class="col-sm-7 control-label" style="text-align: left;" name="BookAuthor">Book's Author</label></td>
                <td><input type="text" class="form-control" placeholder="Enter book's author" id="BookAuthor" name="BookAuthor"></td>
              </tr>
              <tr>
                <td><label class="col-sm-7 control-label" style="text-align: left;" name="BookISBN">Book ISBN</label></td>
                <td><input type="text" class="form-control" placeholder="Enter ISBN" id="BookISBN" name="BookISBN"></td>
              </tr>
                <tr>
                <td><label class="col-sm-7 control-label" style="text-align: left;" name="BookGenre">Book's Genre</label></td>
                <td><input type="text" class="form-control" placeholder="Enter book's genre" id="BookGenre" name="BookGenre"></td>
              </tr>
                <tr>
                <td><label class="col-sm-7 control-label" for="BookCondition" style="text-align: left;" name="BookCondition">Book Condition</label></td>
                <td>
                  <select class="form-control" id="BookCondition" name="BookCondition">
                    <option value="New">New</option>
                    <option value="Decent">Decent</option>
                    <option value="NotGreat">Not so great</option>
                  </select>
                </td>
              </tr>
            </table>
              <h3>Pickup Details</h3>
              <table class="table table-sm profileborder">
                <tr>
                  <td><label class="col-sm-7 control-label" style="text-align: left;" name="PickupPhone">Phone No</label></td>
                  <td><input type="text" class="form-control" id="PickupPhone" placeholder="Enter your phone number" name="PickupPhone"></td>
                </tr>
              <tr>  
                <td><label class="col-sm-7 control-label" style="text-align: left;" name="PickupEmail">Email</label></td>
                <td><input type="email" class="form-control" id="PickupEmail" placeholder="Enter your email address" name="PickupEmail"></td>
              </tr>
              <tr>
                <td><label class="col-sm-7 control-label" style="text-align: left;" for="pickupNote" name="PickupNote">Note</label></td>
                <td><textarea class="form-control" id="pickupNote" rows="3" placeholder="Add note here" name="PickupNote"></textarea></td>
              </tr>
            </table>

            <input type="submit" name="AddBook" style="background: url('Images/submit.png'); border:none; background-repeat:no-repeat; width:200px;height:50px;" value="Add Book" />
            </form>
          </div>  

      
        </div>
      </main>

      <footer class="footer bg-dark mt-auto py-3 bg-light">
        <div class="container">
            <p class="text-light">copyright © 2021 bookxchange.ca</p>
        </div>
    </footer>
    <script src="Assets/bootstrap.bundle.min.js"></script>
</body>
</html>