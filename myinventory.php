<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("connect.php");
include("function.php");
$error_loading_active="";
$error_loading_inactive="";
$success_msg="";

#status >>> 1 = active, 0 = inactive
$email = $_SESSION['email'];

$result=mysqli_query($connection,"SELECT * FROM registered_user WHERE Email='$email'");

$row = mysqli_fetch_array($result);

$user_id=$row['User_id'];

$result_for_active = mysqli_query($connection, "select * from books where status=1 and User_Id = '$user_id' ");
$result_for_inactive = mysqli_query($connection, "select * from books where status=0 and User_Id = '$user_id' ");
// print_r($result);

  if (mysqli_num_rows($result_for_active)==0){
    $error_loading_active = "No active books";
  }else{
    $success_msg;
  }
  
  if (mysqli_num_rows($result_for_inactive)==0){
    $error_loading_inactive = "No inactive books";
  }else{
    $success_msg;
  }

if(logged_in()){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="Assets/bootstrap.css">
    <link rel="stylesheet" href="Assets/style.css">

    <title>My Inventory | Book Xchange</title>
</head>
<body class="d-flex flex-column min-vh-100">
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
                <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $row['UserName']; ?></a>
                <ul class="dropdown-menu" aria-labelledby="dropdown04">
                    <li><a class="dropdown-item" href="myprofile.php">My Profile</a></li>
                    <li><a class="dropdown-item active" href="myinventory.php">My Inventory</a></li>
                    <li><a class="dropdown-item" href="Signout.php">Sign Out</a></li>
                </ul>
            </li>
      </ul>
        </div>
      </div>
    </nav>

      <main class="flex-shrink-0">
      <div class="container py-4">
        <div class="container py-4 container-fluid">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
              <h1 class="h2">My Inventory</h1>
          </div>

          <div class="row">
            <?php
              while($row = mysqli_fetch_array($result_for_active)) {
              $userId = $row[7];
              $bookId = $row[0];

              echo "<div class=\"card col-xs-12 col-sm-6 col-md-3\">";
              echo "<img src=\"cover/".$row[6]."\" class=\"card-img-top\"/>";
              echo "<div class=\"card-body\">";
              echo "<h5 class=\"card-title\">".$row[1]."</h5>";
              echo "<p class=\"card-text\">".$row[2]."</p>";
              echo "</div>";
              echo "<div class=\"card-footer\">";
              //echo "<a href=\"editbook.php?id=$bookId\" class=\"card-link\"><img src=\"Images/edit.png\" alt=\"Edit\" style=\"width:120px;height:36px;\"></a>";
              //echo "<a href=\"removebook.php?id=$bookId\" class=\"card-link\"><img src=\"Images/remove.png\" alt=\"Remove\" style=\"width:120px;height:36px;\"></a>";
              echo "</ul>";
              echo "<li style=\"display:inline-block; padding: 5px;\">";
              echo "<form method=\"POST\" action=\"editbook.php\">";
              echo "<input type=\"text\" name=\"selectedBookId\" class=\"btn btn-primary btn-lg\" style=\"display:none\" value='$bookId'>";
              echo "<button type=\"submit\" class=\"card-link\">Edit</button>";
              echo "</form>";
              echo "</ul>";
              echo "<li style=\"display:inline-block; padding: 5px;\">";
              echo "<form method=\"POST\" action=\"removebook.php\">";
              echo "<input type=\"text\" name=\"selectedBookId\" class=\"btn btn-primary btn-lg\" style=\"display:none\" value='$bookId'>";
              echo "<button type=\"submit\" class=\"card-link\">Remove</button>";
              echo "</form>";
              echo "</li>";
              echo "</ul>";
              echo "</div>";
              echo "</div>";
            }
          ?>
          <?php
            if(strlen($error_loading_active)>0){ ?>
              <div id="error"> <?php echo $error_loading_active ?>  </div>
            <?php } else {?>
              <div id="success"> <?php echo $success_msg ?></div>
          <?php } ?>
          </div>
          <br>
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Inactive</h1>
        </div>
        <div class="row">
        <div class="row">
            <?php
            while($row = mysqli_fetch_array($result_for_inactive)) {
              $userId = $row[6];
              $bookId = $row[0];

              echo "<div class=\"card col-xs-12 col-sm-6 col-md-3\">";
              echo "<img src=\"cover/".$row[6]."\" class=\"card-img-top\"/>";
              echo "<div class=\"card-body\">";
              echo "<h5 class=\"card-title\">".$row[1]."</h5>";
              echo "<p class=\"card-text\">".$row[2]."</p>";
              echo "</div>";
              echo "</div>";
            }
          ?>
          <?php
            if(strlen($error_loading_inactive)>0){ ?>
              <div id="error"> <?php echo $error_loading_inactive ?>  </div>
            <?php } else {?>
              <div id="success"> <?php echo $success_msg ?></div>
          <?php } ?>
          </div>
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
      <?php
}else{
  header("location: index.php");
}
?>
