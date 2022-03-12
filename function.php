<?php
function email_exists($email,$connection){
  $Database_Emails=mysqli_query($connection,"SELECT * from registereduser where Email='$email'");
  if(mysqli_num_rows($Database_Emails)==1){
    return true;
  }
  else return false;
}
function username_exists($username,$connection){
  $Database_username=mysqli_query($connection,"SELECT * from registereduser where UserName='$username'");
  if(mysqli_num_rows($Database_username)==1){
    return true;
  }
  else return false;
}
function logged_in(){
  if(isset($_SESSION['email'])){
    return true;
  }
  else{
    return false;
  }
}

 ?>
