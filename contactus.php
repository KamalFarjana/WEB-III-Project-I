<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("connect.php");
include("function.php");
// Include packages and files for PHPMailer and SMTP protoc
$connection = mysqli_connect("localhost","root","","book_exchange");
if(mysqli_connect_errno()){
  echo "error occured while connecting to Database: ".mysqli_connect_errno();
}
/*use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require 'vendor/autoload.php';
require 'C:\xampp\htdocs\Web_De\vendor\phpmailer\phpmailer\src\Exception.php';
require 'C:\xampp\htdocs\Web_De\vendor\phpmailer\phpmailer\src\SMTP.php';
require 'C:\xampp\htdocs\Web_De\vendor\phpmailer\phpmailer\src\PHPMailer.php';*/


// Initialize PHP mailer, configure to use SMTP protocol and add credentials


$output = [];
$responses = [];
// Check if the form was submitted
if (isset($_POST["submit"])){

  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];
  $date = date("Y-m-d h:i:s");

  // Validate email adress
  if (!empty($_POST['email'])&& !empty($_POST['name']) && !empty($_POST['message'])) {

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

      $responses[] = 'Email is not valid!';
    }}
    if (empty($_POST['email']) ||empty($_POST['name']) || empty($_POST['message'])) {

      $responses[] = 'Please complete all fields!';
    }
   if (!$responses){

  /*  $mail->SMTPDebug = SMTP::DEBUG_SERVER;
      $mail->IsSMTP();
      $mail->Mailer = "smtp";
      $mail->SMTPDebug  = 0;
      $mail->SMTPAuth   = TRUE;
      $mail->SMTPSecure = "tls";
      $mail->Port       = 587;
      $mail->Host       = "smtp.gmail.com";
      $mail->Username   = "BookXchange2022ICT@gmail.com";
      $mail->Password   = "Book@2022";
      $mail->setFrom('BookXchange2022ICT@gmail.com', 'Jenish');
      $mail->addAddress($email, $name);
      $mail->isHTML(true);
      $mail->Subject = 'Thankyou for Contacting BookXchange!We get in touch soon';
      $mail->Body = "Your Name: $name \n Your Email: $email \nYour Message: $message\n Thankyou for Contacting BookXchange!We get in touch soon.\nPls do-not-reply back";

        $mail->send();*/
        $query = "INSERT INTO `contact_us` (Name, Email,Message) VALUES ('$name', '$email','$message')";
        $result = mysqli_query($connection, $query);
        $output []= '<div class="alert alert-success">
        <h5>Thankyou! for contacting us, We will get back to you soon!</h5>
        </div>';

  }
}?>


  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="Assets/bootstrap.css">
    <link rel="stylesheet" href="Assets/style.css">

    <title>Contact Us | Book Xchange</title>
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
              <a class="nav-link " href="aboutus.php">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="browse.php">Browse Books</a>
            </li>
            <?php if(logged_in()){
               ?>
            <li class="nav-item">
                <a class="nav-link" href="addbook.php">Add Book</a>
            </li>
            <?php } ?>
            <li class="nav-item">
              <a class="nav-link" href="faq.php">FAQ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="contactus.php">Contact Us</a>
            </li>

          </ul>
          <ul class="nav-item navbar-nav navbar-right">
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
        </div>
      </div>
    </nav>

    <main class="flex-shrink-0">
      <div class="container">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Contact Us</h1>
        </div>

        <div class="well well-sm">
          <form class="form-horizontal" action="" method="post">
            <fieldset>
              <table  class="table table-sm profileborder">
                <tr>
                  <td><label class="col-md-3 control-label" for="name" style="text-align: right;">Your Name</label></td>
                  <td><input id="name" name="name" type="text" placeholder="Your name" class="form-control"></td>
                </tr>
                <tr>
                  <td><label class="col-md-3 control-label" for="email" style="text-align: right;">Your E-mail</label></td>
                  <td><input id="email" name="email" type="email" placeholder="Your email" class="form-control"></td>
                </tr>
                <tr>
                  <td><label class="col-md-3 control-label" for="message" style="text-align: right;">Your message</label></td>
                  <td>
                    <textarea class="form-control" id="message" name="message" placeholder="Please enter your message here..." rows="4"></textarea>
                  </td>
                </tr>
              </table>

              <!-- Form actions -->
              <div class="form-group">
                <div class="col-md-12 text-right">
                  <input type="submit" name="submit" class="btn btn-primary btn-lg">

                  <?php if ($responses): ?>
                    <p class="responses"><?php echo implode('<br>', $responses); ?></p>
                  <?php else: ?>

                  <p class="responses"><?php echo implode('<br>', $output); ?></p>
                    <?php endif ?>
  </div>
              </div>

            </fieldset>
          </form>
        </div>


      </div>
    </main>

    <footer class="footer bg-dark mt-auto py-3 bg-light fixed-bottom">
      <div class="container">
        <p class="text-light">copyright © 2022 bookxchange.ca</p>
      </div>
    </footer>

    <script src="Assets/bootstrap.bundle.min.js"></script>

  </body>
  </html>
