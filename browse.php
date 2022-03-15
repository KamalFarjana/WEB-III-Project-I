<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("connect.php");
include("function.php");

$result = mysqli_query($connection, "select * from books");
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

    <title>Browse Books | Book Xchange</title>
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
              <a class="nav-link active" aria-current="page" href="browse.html">Browse Books</a>
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

      <main class="flex-shrink-0">
      <div class="container py-4 container-fluid">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Browse Books</h1>
        </div>

        <div class="row">
          <div class="card col-xs-12 col-sm-6 col-md-3">
            
            <table>
              <tr>
                <th>Search by</th><br>
              </tr>
              <tr>
                <td><br>
                  <input type="radio" id="Title" value="Title">
              <label for="Title">Title</label><br>
              <input type="radio" id="Author" value="Author">
              <label for="Author">Author</label><br>
              <input type="radio" id="ISBN" value="ISBN">
              <label for="ISBN">ISBN</label>
                </td>
              </tr>
              <tr>
                <td><div class="search-container">
                  <input type="text" placeholder="Search.." name="search">
                  <input type="submit" value="Submit"> </div>
                </td>
              </tr>
              <tr>
                <th><br><hr><br>Filter by</th>
              </tr>
            </table><br>
            <form>
            <table>
              <tr>
              <label for="genre">Genre</label>
              <select name="genre" id="genre">
                <option value="volvo">Fiction</option>
                <option value="saab">Non-Fiction</option>
                <option value="opel">Philosophy</option>
                <option value="audi">Historical</option>
              </select>
                <input type="submit" value="Submit">
              </tr>
            </table>
          </form>
          </div>
          <?php
            while($row = mysqli_fetch_array($result)) {
              $userId = $row[6];
              $bookId = $row[0];
              $firstName = '';
              $lastName = '';
              $userProfile = mysqli_query($connection, "select * from registered_user where User_id='$userId'");
              while ($userRow = mysqli_fetch_array($userProfile)) {
                $firstName = $userRow['FirstName'];
                $lastName = $userRow['LastName'];
              }
              echo "<div class=\"card col-xs-12 col-sm-6 col-md-3\">";
              echo "<img src=\"Images/book-cover.jpg\" class=\"card-img-top\" alt=\"1984\"/>";
              echo "<div class=\"card-body\">";
              echo "<h5 class=\"card-title\">".$row[1]."</h5>";
              echo "<p class=\"card-text\">".$row[2]."</p>";
              echo "</div>";
              echo "<div class=\"card-body\">";
              echo "<a href=\"viewbook.php?id=$bookId\" class=\"card-link\">View Book</a>";
              echo "</div>";
              echo "<div class=\"card-footer\">";
              echo "<small class=\"text-muted\">Posted by <a href=\"myprofile.php\">".$firstName." ".$lastName."</a><br>Posted on ".date('d-M-yy',strtotime($row[11]))."</small>";
              echo "</div>";
              echo "</div>";
            }
          ?>

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