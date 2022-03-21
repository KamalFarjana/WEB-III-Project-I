<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("connect.php");
include("function.php");
$bookId = '';
$bookTitle = '';
$bookAuthor = '';
$bookISBN = '';
$bookGenre = '';
$bookCondition = '';
$userId = '';
$addedDate = '';
$userPhone = '';
$userEmail = '';
$userNote = '';
$firstName = '';
$lastName = '';

  if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST))
{
    $bookId=$_POST['selectedBookId'];
} else {
  header('Location: browse.php');
  die();
}
$result = mysqli_query($connection, "select * from books where Book_id='$bookId'");
  while($row = mysqli_fetch_array($result)) {
    $bookId=$row['Book_id'];
    $bookTitle=$row['Title'];
    $bookAuthor=$row['Author'];
    $bookISBN=$row['ISBN'];
    $bookGenre=$row['Genre'];
    $bookCondition=$row['Condition'];
    $bookImage=$row['Book_image'];
    $userId=$row['User_id'];
    $addedDate=$row['AddedDate'];
    $userPhone=$row['PhoneNumber'];
    $userEmail=$row['Email'];
    $userNote = $row['Note'];
  }
$userProfile = mysqli_query($connection, "select * from registered_user where User_id='$userId'");
  while ($userRow = mysqli_fetch_array($userProfile)) {
    $firstName = $userRow['FirstName'];
    $lastName = $userRow['LastName'];
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

    <title>View Book | Book Xchange</title>
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
              <a class="nav-link active" href="browse.php">Browse Books</a>
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
          <?php if(logged_in()){
            $Logged_in_user_name=Logged_in_user_data($connection);?>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $Logged_in_user_name['UserName']; ?></a>
                <ul class="dropdown-menu" aria-labelledby="dropdown04">
                    <li><a class="dropdown-item" href="myprofile.php">My Profile</a></li>
                    <li><a class="dropdown-item" href="myinventory.php">My Inventory</a></li>
                    <li><a class="dropdown-item" href="Signout.php">Sign Out</a></li>
                </ul>
            </li>
          <?php } else{ ?>
            <li><a class="nav-link" href="signup.php">Register</a></li>
            <li><a class="nav-link" href="signin.php">Sign In</a></li>
          <?php } ?>
                </ul>
            </li>
      </ul>
        </div>
      </div>
    </nav>

      <main class="flex-shrink-0">
      <div class="container py-4 container-fluid">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <?php
            echo "<h1 class=\"h2\">".$bookTitle."</h1>";
          ?>
          <!-- <h1 class="h2">1984</h1> -->
        </div>

        <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-3 viewbook">
          <?php
            echo "<img src=\"cover/".$bookImage."\" class=\"card-img-top\" alt=\"$bookImage\"/>";
           ?>

        </div>
        <div class="card col-xs-12 col-sm-6 col-md-8 viewbook align-items-start">
          <?php
            echo "<h5 class=\"card-title\">Book Details</h5>";
            echo "<p class=\"card-text\"><b>Title</b>: ".$bookTitle."</p>";
            echo "<p class=\"card-text\"><b>Author</b>: ".$bookAuthor."</p>";
            echo "<p class=\"card-text\"><b>ISBN</b>: ".$bookISBN."</p>";
            echo "<p class=\"card-text\"><b>Genre</b>: ".$bookGenre."</p>";
            echo "<p class=\"card-text\"><b>Condition</b>：".$bookCondition."</p>";
            echo "<hr>";
            if(logged_in()){
            echo "<h5 class=\"card-title\">Pickup Details</h5>";
            echo "<p class=\"card-text\"><i>Posted by ".$firstName." ".$lastName." on ".date('d-M-y',strtotime($addedDate))."</i></p>";
            echo "<p class=\"card-text\"><b>Phone</b>: ".$userPhone."</p>";
            echo "<p class=\"card-text\"><b>Email</b>: ".$userEmail."</p>";
            echo "<p class=\"card-text\"><b>Note</b>: ".$userNote."</p>";
          }
          ?>
              <!-- <h5 class="card-title">Book Details</h5>
              <p class="card-text"><b>Title</b>: 1984</p>
              <p class="card-text"><b>Author</b>: George Orwell</p>
              <p class="card-text"><b>ISBN</b>: 9780141391700</p>
              <p class="card-text"><b>Genre</b>: Fiction</p>
              <p class="card-text"><b>Condition</b>：Great</p>
              <hr>
              <h5 class="card-title">Pickup Details</h5>
              <p class="card-text"><i>Posted by dwarfplanet on March 31, 2021</i></p>
              <p class="card-text"><b>Phone</b>: 807 123-1234</p>
              <p class="card-text"><b>Email</b>: dwarfplanet@email.com</p>
              <p class="card-text"><b>Note</b>: pls only call me between 7am-9pm</p> -->
        </div>
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
