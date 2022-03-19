<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("connect.php");
include("function.php");

#status >>> 1 = active, 0 = inactive
$result_for_active = mysqli_query($connection, "select * from books where status=1");
$result_for_inactive = mysqli_query($connection, "select * from books where status=0");
// print_r($result);
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
                    <li><a class="dropdown-item active" href="myinventory.html">My Inventory</a></li>
                    <li><a class="dropdown-item" href="index.html">Sign Out</a></li>
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
              echo "<input type=\"text\" name=\"selectedBookId\" style=\"display:none\" value='$bookId'>";
              echo "<button type=\"submit\" class=\"card-link\">Edit</button>";
              echo "</form>";
              echo "</ul>";
              echo "<li style=\"display:inline-block; padding: 5px;\">";
              echo "<form method=\"POST\" action=\"removebook.php\">";
              echo "<input type=\"text\" name=\"selectedBookId\" style=\"display:none\" value='$bookId'>";
              echo "<button type=\"submit\" class=\"card-link\">Remove</button>";
              echo "</form>";
              echo "</li>";
              echo "</ul>";
              echo "</div>";
              echo "</div>";
            }
          ?>
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
          </div>
        </div>

        </div>
      </div>
      </main>

      <?php 
  require_once "footer.php";
?>