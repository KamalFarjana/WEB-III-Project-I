<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="Assets/bootstrap.css">
    <link rel="stylesheet" href="Assets/style.css">

    <title><?php echo $title; ?></title>
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
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="aboutus.php">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="browse.php">Browse Books</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="faq.php">FAQ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="contactus.php">Contact Us</a>
            </li>
          </ul>

          <ul class="navbar-nav navbar-right">
                 <li class="nav-item dropdown">

                    <?php 
                        if (logged_in()){
                    ?>

                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-bs-toggle="dropdown" aria-expanded="false">dwarfplanet</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown04">
                        <li><a class="dropdown-item" href="myprofile.php">My Profile</a></li>
                        <li><a class="dropdown-item" href="myinventory.php">My Inventory</a></li>
                        <li><a class="dropdown-item" href="logout.php">Sign Out</a></li>
                    </ul>

                    <?php 
                        }else{
                    ?>

                    <li><a class="nav-link active" href="signup.php">Register</a></li>
                    <li><a class="nav-link active" href="signin.php">Sign In</a></li>

                    <?php 
                        exit();}
                    ?>
                 </li>
                </ul>
        
        </div>
      </div>
    </nav>