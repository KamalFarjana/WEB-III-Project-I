<?php
include("connect.php");
include("function.php");
$error="";
$success_msg="";

if(isset($_POST['AddBook'])){
  #variable_initialization
  $BookTitle=$_POST['BookTitle'] ?? "";
  $BookAuthor=$_POST['BookAuthor'] ?? "";
  $BookISBN=$_POST['BookISBN'] ?? "";
  $BookGenre=$_POST['BookGenre'] ?? "";
  $BookCondition=$_POST['BookCondition'] ?? "";
  $PickupPhone=$_POST['PickupPhone'] ?? "";
  $PickupEmail=$_POST['PickupEmail'] ?? "";
  $PickupNote=$_POST['PickupNote'] ?? "";

  $image = $_FILES['BookCover']['name'] ?? "";
  $tmp_image = $_FILES['BookCover']['tmp_name'] ?? "";
  $imageSize = $_FILES ['BookCover']['size'] ?? "";
  $allowed_image_ext = 'jpg';
  $div_image = explode(".", $image); #seperate name, ext
  $image_ext = end($div_image); #get extention
  $unique_image_name = substr(md5(time()), 0, 10).".".$image_ext; #generate unique name

  #$SubmittedBy = $_SESSION["username"];
  $SubmittedBy = '1';
  $Status = '1';

  $Date = date('m/d/Y h:i:s a', time());

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
  else if (strlen($PickupPhone) < 1 == 0 && strlen($PickupEmail) < 1){
    $error = "Please enter either phone number or email for pickup details!";
  }
  else if ($imageSize > 1048576){
    $error = "Image size must be less than 1 MB";
  }
  else if (strcmp($image_ext, $allowed_image_ext) !==0){
    $error = "Only jpg file is allowed!";
  }
  else
  {
    $insertQuery = "INSERT INTO books (Title, Author, ISBN, Genre, Condition, Book_image, User_id, Status, PhoneNumber, Email, Note, AddedDate)
                    VALUES ('$BookTitle','$BookAuthor','$BookISBN','$BookGenre','$BookCondition','$unique_image_name','$SubmittedBy','$Status','$PickupPhone','$PickupEmail', '$PickupNote', '$Date')";

    if(mysqli_query($connection, $insertQuery)){
      if(move_uploaded_file($tmp_image, "cover/$unique_image_name")) {
        $success_msg = "You have successfully added the book";
      }
    }
    else
    {
      $error = "The attempt was unsuccessfull.";
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
                <a class="nav-link active" aria-current="page" href="addbook.html">Add Book</a>
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
                  <td><input type="file" class="form-control" id="bookCover"></td>
                </tr>
              <tr>  
                <td><label class="col-sm-7 control-label" style="text-align: left;" name="BookTitle">Book Title</label></td>
                <td><input type="text" class="form-control" placeholder="Enter book title"></td>
              </tr>
              <tr>
                <td><label class="col-sm-7 control-label" style="text-align: left;" name="BookAuthor">Book's Author</label></td>
                <td><input type="text" class="form-control" placeholder="Enter book's author"></td>
              </tr>
              <tr>
                <td><label class="col-sm-7 control-label" style="text-align: left;" name="BookISBN">Book ISBN</label></td>
                <td><input type="text" class="form-control" placeholder="Enter ISBN"></td>
              </tr>
                <tr>
                <td><label class="col-sm-7 control-label" style="text-align: left;" name="BookGenre">Book's Genre</label></td>
                <td><input type="text" class="form-control" placeholder="Enter book's genre"></td>
              </tr>
                <tr>
                <td><label class="col-sm-7 control-label" for="BookCondition" style="text-align: left;" name="BookCondition">Book Condition</label></td>
                <td>
                  <select class="form-control" id="BookCondition">
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
                  <td><input type="text" class="form-control" id="bookCover" placeholder="Enter your phone number"></td>
                </tr>
              <tr>  
                <td><label class="col-sm-7 control-label" style="text-align: left;" name="PickupEmail">Email</label></td>
                <td><input type="email" class="form-control" placeholder="Enter your email address"></td>
              </tr>
              <tr>
                <td><label class="col-sm-7 control-label" style="text-align: left;" for="pickupNote" name="PickupNote">Note</label></td>
                <td><textarea class="form-control" id="pickupNote" rows="3" placeholder="Add note here"></textarea></td>
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