<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="Assets/bootstrap.css">
    <link rel="stylesheet" href="Assets/style.css">

    <title>About Us | Book Xchange</title>
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
              <a class="nav-link "href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page"  href="aboutus.php">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="browse.php">Browse Books</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="faq.php">FAQ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contactus.php">Contact Us</a>
            </li>

          </ul>
          <ul class="nav-item navbar-nav navbar-right">
          <li><a class="nav-link" href="signup.php">Register</a></li>
            <li><a class="nav-link" href="signin.php">Sign In</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <main class="flex-shrink-0 px-3">
      <div class="container col-xxl-8 px-4 py-5">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">About Us</h1>
      </div>

        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
          <div class="col-10 col-sm-8 col-lg-6">
            <img src="Images/book-exchange-2.png" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
          </div>
          <div class="col-lg-6 aboutus">
            <h2 class="display-5 fw-bold lh-1 mb-3">Exchanging books save you time, money, shelf space, and environment.</h2>
            <p class="lead">BookXchange is a community for exchanging used books for free.
                It's a great crime to have a book disappear, out of print, for none to read. We keep books in circulation and find new readers for them. 
                You give your books you no longer need in exchange for book you really want. 
                We strive to make a platform where locals exchange books and try to contribute to the community.</p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <a href="faq.php" ><img src="Images/faq.png" alt="FAQButton" style="width:200px;height:60px;"></a>
            </div>
          </div>
        </div>
      </div>
    </main>

    <?php 
  require_once "footer.php";
?>