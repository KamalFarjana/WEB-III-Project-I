<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="Assets/bootstrap.css">
    <link rel="stylesheet" href="Assets/style.css">

    <title>Home | Book Xchange</title>
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
            <a class="nav-link" href="aboutus.html">About Us</a>
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
          <li><a class="nav-link active" href="signup.php">Register</a></li>
          <li><a class="nav-link active" href="signin.php">Sign In</a></li>
        </ul>
      </div>
    </div>
  </nav>

    <main>
      <div class="container py-4">
            <img class="bd-placeholder-img" width="100%" height="100%" src="Images/book-exchange-1.jpg" style="opacity: 0.5;">
            <hr>
        <div class="row align-items-md-stretch">
          <div class="col-md-6">
            <div class="h-100 p-5 bg-light border rounded-3">
              <h2>HOW IT WORKS?</h2>
              <p>Check out <a href="faq.php">FAQ</a>.</p>
            </div>
        </div>

          <div class="col-md-6">
            <div class="h-100 p-5 bg-light border rounded-3">
              <h2>Not a member yet?</h2>
              <p><a href="signup.html">Join Now</a> (it's free!)</p>
            </div>
          </div>
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
