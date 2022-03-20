<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("connect.php");
include("function.php");
$error="";
$result = mysqli_query($connection, "select * from books where status=1");
if(isset($_GET['Search'])){
  if(empty($_GET['search']) && empty($_GET['SearchType'])){
    $error="Please type something and select a type for your search";
  }
  else{
   $query=$_GET['search'];
   if(!empty($_GET['SearchType'])){
       $SearchType=$_GET['SearchType'];
       if($SearchType=="Author"){
         $result = mysqli_query($connection, "select * from books WHERE status=1 AND (`Author` LIKE '%".$query."%') ");
       }
       elseif($SearchType=="Title"){
         $result = mysqli_query($connection, "select * from books WHERE status=1 AND  (`Title` LIKE '%".$query."%') ");
       }
       elseif($SearchType=="ISBN"){
         $result = mysqli_query($connection, "select * from books WHERE status=1 AND  (`ISBN` LIKE '%".$query."%') ");
       }
   }
   else{
          $error="You have to select a type of your search";
   }
   #echo ("<script LANGUAGE='JavaScript'>window.alert('success');</script>");

  }
}

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
              <a class="nav-link active" aria-current="page" href="browse.php">Browse Books</a>
            </li>
            <?php if(logged_in()){
              $Logged_in_user_name=Logged_in_user_data($connection);?>
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
          <?php if(logged_in()){ ?>
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
      <div class="container py-4 container-fluid">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Browse Books</h1>
        </div>
        <div class="row">
          <div class="card col-xs-12 col-sm-6 col-md-3">
            <form action="browse.php" method="GET">
              <table>
                <tr>
                  <th>Search by</th><br>
                </tr>
                <tr>
                  <td><br>
                        <input type="radio" id="Title" value="Title" name="SearchType">
                        <label for="Title">Title</label><br>
                        <input type="radio" id="Author" value="Author" name="SearchType">
                        <label for="Author">Author</label><br>
                        <input type="radio" id="ISBN" value="ISBN" name="SearchType">
                        <label for="ISBN">ISBN</label>
                  </td>
                </tr>
                <tr>
                  <td><div class="search-container">
                    <input type="text" placeholder="Search.." name="search">
                    <input type="submit" value="Submit" name="Search"> </div>
                  </td>
                </tr>
              </table><br>
            </form>
          </div>
          <?php
           if(strlen($error)>0){
             echo "<div class=\"card col-xs-12 col-sm-6 col-md-12\">";
             echo "<h1>";
             echo $error;
             echo "</h1>";
             echo "<a class=\"nav-link belowformlink\" href=\"browse.php\">Search Again</a>";
            echo "</div>";
           }
           elseif(mysqli_num_rows($result)==0){
             echo "<div class=\"card col-xs-12 col-sm-6 col-md-12\">";
             echo "<h1>";
             echo "We didnot find a search for "."\"". $query. "\"".". Try searching for something else instead";
             echo "</h1>";
             echo "<a class=\"nav-link belowformlink\" href=\"browse.php\">Search Again</a>";
              echo "</div>";
           }
           else{
             while($row = mysqli_fetch_array($result)) {
               $userId = $row[7];
               $bookId = $row[0];
               $firstName = '';
               $lastName = '';
               $userProfile = mysqli_query($connection, "select * from registered_user where User_id='$userId'");
               while ($userRow = mysqli_fetch_array($userProfile)) {
                 $firstName = $userRow['FirstName'];
                 $lastName = $userRow['LastName'];
               }
               echo "<div class=\"card col-xs-12 col-sm-6 col-md-3\">";
               echo "<img src=\"cover/".$row[6]."\" class=\"card-img-top\"/>";
               echo "<div class=\"card-body\">";
               echo "<h5 class=\"card-title\">".$row[1]."</h5>";
               echo "<p class=\"card-text\">".$row[2]."</p>";
               echo "</div>";
               echo "<div class=\"card-body\">";
               echo "<form method=\"post\" action=\"viewbook.php\">";
               echo "<input type=\"text\" name=\"selectedBookId\" class=\"btn btn-primary btn-lg\" style=\"display:none\" value='$bookId'>";
               // echo "<a href=\"viewbook.php?id=$bookId\" class=\"card-link\">View Book</a>";
               echo "<button type=\"submit\" class=\"card-link\">View Book</button>";
               echo "</form>";
               echo "</div>";
               if(logged_in()){
               echo "<div class=\"card-footer\">";
               echo "<small class=\"text-muted\">Posted by ".$firstName." ".$lastName."<br>Posted on ".date('d-M-y',strtotime($row[12]))."</small>";
               echo "</div>";
               }
               echo "</div>";
             }
           }

          ?>
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
