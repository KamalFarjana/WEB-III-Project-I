<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("connect.php");
include("function.php");
$result = mysqli_query($connection, "select * from faq");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="Assets/bootstrap.css">
    <link rel="stylesheet" href="Assets/style.css">

    <title>FAQ | Book Xchange</title>
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
              <a class="nav-link " aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="aboutus.php">About Us</a>
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
              <a class="nav-link active" aria-current="page"  href="faq.php">FAQ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="contactus.php">Contact Us</a>
            </li>

          </ul>
          <ul class="nav-item navbar-nav navbar-right">
          <?php if(logged_in()){
            $Logged_in_user_name=Logged_in_user_data($connection); ?>
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
        </div>
      </div>
    </nav>

    <main class="flex-shrink-0">
        <div class="container py-3">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Frequently Asked Questions</h1>
            </div>
            <div class="row" style="text-align: left;">
                <div class="col-10 mx-auto">
                    <div class="accordion" id="faqExample">
                        <?php
                        while($row = mysqli_fetch_array($result)) {
                            echo "<div class=\"card\">";
                            echo "<div class=\"card-header p-2\" id=\"headingOne\">";
                            echo "<h5 class=\"mb-0\">";
                            echo "<button class=\"btn\" type=\"button\" data-toggle=\"collapse\" data-target=\"#collapseOne\" aria-expanded=\"true\" aria-controls=\"collapseOne\">";
                            echo "Q: ".$row[1];
                            echo "</button>";
                            echo "</h5>";
                            echo "</div>";
                            echo "<div id=\"collapseTwo\" class=\"collapse show\" aria-labelledby=\"headingTwo\" data-parent=\"#faqExample\">";
                            echo "<div class=\"card-body\">";
                            echo "<b>Answer: </b>".$row[2];
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "<br/>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </main>

    <footer class="footer bg-dark mt-auto py-3 bg-light">
      <div class="container">
          <p class="text-light">copyright © 2022 bookxchange.ca</p>
      </div>
  </footer>
  <script src="Assets/bootstrap.bundle.min.js"></script>
</body>
</html>
