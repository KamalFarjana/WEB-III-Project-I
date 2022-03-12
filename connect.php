<?php
$connection = mysqli_connect("localhost","root","","project1-bookexchange");
if(mysqli_connect_errno()){
  echo "error occured while connecting to Database: ".mysqli_connect_errno();
}
 ?>
