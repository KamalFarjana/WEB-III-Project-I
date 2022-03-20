<?php
$connection = mysqli_connect("localhost","root","","book_exchange");
if(mysqli_connect_errno()){
  echo "error occured while connecting to Database: ".mysqli_connect_errno();
}
session_start();

 ?>
