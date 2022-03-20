<?php
include ("connect.php");
include ("function.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$error = "";
$success_msg = "";
if(logged_in()){
  $Logged_in_user_name=Logged_in_user_data($connection);
  if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST))
  {
      $bookID = $_POST['selectedBookId'];
      $getbookdata = mysqli_query($connection,"Select * from  books where Book_id= '$bookID' ");
      $retrivebookdata = mysqli_fetch_array ($getbookdata);

      #storing book data retrived from the database
      $BookID = $retrivebookdata[0];
      $Title = $retrivebookdata[1];
      $Author = $retrivebookdata[2];
      $Isbn = $retrivebookdata[3];
      $Genre = $retrivebookdata[4];
      $Condition=  $retrivebookdata[5];
      $ImageName= $retrivebookdata[6];
      $status = $retrivebookdata[8];
      $Phonenumber=  $retrivebookdata[9];
      $Email=  $retrivebookdata[10];
      $Note=  $retrivebookdata[11];
  }
  #get book data for catch bookID from database

  if (isset($_POST['updateBook'])){
    #initializing the variable
    $bookID = $_POST['selectedBookId'];
    $UpdatedTitle = $_POST['updatedTitle'];
    $UpdatedAuthor = $_POST['updatedAuthor'];
    $UpdatedISBN = $_POST['updatedISBN'];
    $UpdatedGenre = $_POST['updatedGenre'];
    $updatedBookStatus = $_POST['updatedBookStatus'];
    $UpdatedPhone = $_POST['updatedPhone'];
    $UpdatedEmail = $_POST['updatedEmail'];
    $UpdatedNote = $_POST['updatedNote'];
    $Updatedimage = $_FILES['updatedImage']['name'];
    $Updatedtmp_image = $_FILES['updatedImage']['tmp_name'];
    $UpdatedimageSize = $_FILES ['updatedImage']['size'];
    #$UpdatedAllowed_image_ext = array('jpg','png','jpge');
    $Updated_div_image = explode(".", $Updatedimage); #seperate name, ext
    $Updated_image_ext = end($Updated_div_image); #get extention
    $uploadDate=date("dmYHis_");
    $Updated_unique_image_name = $uploadDate.$Title.".".$Updated_image_ext; #generate unique name

    if($UpdatedTitle == $Title && $UpdatedAuthor == $Author && $UpdatedISBN == $Isbn && $UpdatedGenre == $Genre &&
    $updatedBookStatus == $status && $UpdatedPhone == $Phonenumber && $UpdatedEmail == $Email && $UpdatedNote == $Note
    && $UpdatedimageSize == 0 ){
        $error = "You have not change any filed to be updated";
    }
    elseif(strlen($UpdatedTitle )==0 || strlen($UpdatedAuthor) ==0  || strlen($UpdatedGenre) == 0 || strlen($updatedBookStatus) == 0 )
    {
      $error = "Book details cannot be empty";
    }
    else if (strlen($UpdatedPhone) < 1 && strlen($UpdatedEmail) < 1){
      $error = "Please enter either phone number or email for pickup details!";
    }
    else if (strlen($UpdatedPhone) >= 1  && !preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/",$UpdatedPhone)){

        $error="Phone number should 000-000-0000 format";

    }
    else if (strlen($UpdatedEmail) >= 1 && !filter_var($UpdatedEmail, FILTER_VALIDATE_EMAIL)){
        $error="$email is not a valid email address";
    }
    elseif($UpdatedimageSize> 0 && $UpdatedimageSize > 1048576)
    {
        $error = "Image size must be less than 1 MB";
    }
    elseif($UpdatedimageSize> 0 && $Updated_image_ext != 'jpg' && $Updated_image_ext != 'png' && $Updated_image_ext != 'jpeg')
    {
        $error = "Only JPG, PNG and JPEG  files are allowed!";
    }

    else {
        if($UpdatedimageSize>0){
          $ImageName = $Updated_unique_image_name;
          $result=bookUpdateQuery("Book_image", $ImageName,$connection,$bookID );
          move_uploaded_file($Updatedtmp_image, "cover/$ImageName");
        }
        if ($UpdatedTitle != $Title){
            $Title = $UpdatedTitle;
            bookUpdateQuery("Title", $Title,$connection,$bookID );
        }
        if ($UpdatedAuthor != $Author ){
            $Author= $UpdatedAuthor ;
            bookUpdateQuery("Author", $Author,$connection,$bookID );
        }
        if ($UpdatedISBN != $Isbn){
          $Isbn= $UpdatedISBN  ;
          bookUpdateQuery("ISBN", $Isbn,$connection,$bookID );
        }
        if ($UpdatedGenre != $Genre){
          $Genre= $UpdatedGenre ;
          bookUpdateQuery("Genre", $Genre,$connection,$bookID );
        }
        if ($updatedBookStatus != $status){
          $status= $updatedBookStatus ;
          bookUpdateQuery("Status", $status,$connection,$bookID );
        }
        if ($UpdatedPhone  !=   $Phonenumber){
          $Phonenumber= $UpdatedPhone  ;
          bookUpdateQuery("PhoneNumber", $Phonenumber,$connection,$bookID );
        }
        if ( $UpdatedEmail  !=   $Email){
          $Email=  $UpdatedEmail  ;
          bookUpdateQuery("Email", $Email,$connection,$bookID );
        }
        if ($UpdatedNote  != $Note && strlen(  $UpdatedNote) >= 1 ){
          $Note= $UpdatedNote  ;
          bookUpdateQuery("Note", $Note,$connection,$bookID );
        }

        $getbookdata = mysqli_query($connection,"Select * from  books where Book_id= '$bookID'");
        $success_msg = "You have successfully updated the book data";
      }
  }

  if (isset($_POST['Cancel'])){
    header ("location:myinventory.php");}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="Assets/bootstrap.css">
    <link rel="stylesheet" href="Assets/style.css">

    <title>Edit Book | Book Xchange</title>
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
                <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $Logged_in_user_name['UserName']; ?></a>
                <ul class="dropdown-menu" aria-labelledby="dropdown04">
                    <li><a class="dropdown-item" href="myprofile.php">My Profile</a></li>
                    <li><a class="dropdown-item" href="myinventory.php">My Inventory</a></li>
                    <li><a class="dropdown-item" href="Signout.php">Sign Out</a></li>
                </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <main class="flex-shrink-0">
      <div class="container py-4 container-fluid">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Edit Book Information</h1>
        </div>
        <div class="row">
          <?php
            if(strlen($error)>0){ ?>
              <div id="error"> <?php echo $error ?>  </div>
          <?php } else {?>
              <div id="success"> <?php echo $success_msg ?></div>
          <?php } ?>
          <form class="form-horizontal addbook" method="POST" action="editbook.php" enctype="multipart/form-data" >
            <h3>Book Details</h3><hr>
            <table   class="table table-sm profileborder">
              <tr>
                <td><label class="col-sm-7 control-label" style="text-align: left;" for="bookCover">Book Cover</label></td>
                <td>
                  <img src="cover/<?php echo $ImageName;?>" class="avatar img-circle" alt="avatar" height="120px" width="90px">
                  <h6>Upload a different photo...</h6>
                  <input type="file" class="form-control" id="bookCover" name ="updatedImage">
                </td>
              </tr>
              <tr>
                <td><label class="col-sm-7 control-label" style="text-align: left;" >Book Title</label></td>
                <td><input type="text" class="form-control" value="<?php echo $Title ; ?>" name="updatedTitle"></td>

                <?php

                  echo "<td><input type=\"text\" style=\"display:none\" name=\"selectedBookId\" value='$bookID' name=\"updatedTitle\" ></td>";
                ?>
              </tr>
              <tr>
                <td><label class="col-sm-7 control-label" style="text-align: left;">Book's Author</label></td>
                <td><input type="text" class="form-control" value="<?php echo $Author ;?>" name="updatedAuthor" /></td>
              </tr>
              <tr>
                <td><label class="col-sm-7 control-label" style="text-align: left;">Book ISBN</label></td>
                <td><input type="text" class="form-control" value="<?php echo $Isbn ;?>" name="updatedISBN"></td>
              </tr>
                <tr>
                <td><label class="col-sm-7 control-label" style="text-align: left;">Book's Genre</label></td>
                <td><input type="text" class="form-control" value="<?php echo $Genre; ?>" name="updatedGenre" ></td>
              </tr>
              <tr>
                <td><label class="col-sm-7 control-label" for="BookCondition" style="text-align: left;">Book Condition</label></td>
                <td><input type="text" class="form-control" value="<?php echo $Condition; ?>" name="updatedCondition" readOnly="true"></td>
                </td>
              </tr>
              <tr>
                <td><label class="col-sm-7 control-label" for="BookStatus" style="text-align: left;" name="BookStatus">Book Status</label></td>
                <td>
                  <select class="form-control" id="BookStatus" name="updatedBookStatus">
                  <option value="1"<?php if($status=="1") echo 'selected="selected"'; ?>>Available</option>
                  <option value="0"<?php if($status=="0") echo 'selected="selected"'; ?>>Not Available</option>

                  </select>
                </td>
              </tr>
            </table>
            <table>
              <h3>Pickup Details</h3><hr>
              <table class="table table-sm profileborder">
                <tr>
                  <td><label class="col-sm-7 control-label" style="text-align: left;" for="bookCover">Phone</label></td>
                  <td><input type="text" class="form-control" id="bookCover" placeholder="Phone Number (000-000-0000)" value="<?php echo $Phonenumber ;?>" name="updatedPhone"></td>
                </tr>
              <tr>
                <td><label class="col-sm-7 control-label" style="text-align: left;">Email</label></td>
                <td><input type="email" class="form-control" value="<?php echo $Email ;?>" name="updatedEmail"></td>
              </tr>
              <tr>
                <td><label class="col-sm-7 control-label" style="text-align: left;" for="pickupNote">Note</label></td>
                <td><textarea class="form-control" id="pickupNote" rows="3"  name="updatedNote"><?php echo $Note ;?></textarea></td>
              </tr>
            </table>
            <input type="submit" name="updateBook" style="background-image: url('Images/update.png'); border:none; background-repeat:no-repeat; width:200px;height:50px;" value="Update" /><br/><br/>
            <input type="submit" name="Cancel" style="background-image: url('Images/update.png'); border:none; background-repeat:no-repeat; width:200px;height:50px;" value="Cancel" /><br/>
          </form>
          <br>
        </div>
      </div>
    </main>
    <footer class="footer bg-dark mt-auto py-3 bg-light">
      <div class="container">
        <p class="text-light">copyright © 2022 bookxchange.ca</p>
      </div>
    </footer>
    <script src="Assets/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php }
else{
  header("location:index.php");
} ?>
