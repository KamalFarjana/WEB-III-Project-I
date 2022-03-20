<?php
// for testing
function write_to_console($data) {

 $console = 'console.log(' . json_encode($data) . ');';
 $console = sprintf('<script>%s</script>', $console);
 echo $console;
}

//sign up
function email_exists($email,$connection){
  $Database_Emails=mysqli_query($connection,"SELECT * from registered_user where Email='$email'");
  if(mysqli_num_rows($Database_Emails)==1){
    return true;
  }
  else return false;
}
#checking whether username exists in the database or not
function username_exists($username,$connection){
  $Database_username=mysqli_query($connection,"SELECT * from registered_user where UserName='$username'");
  if(mysqli_num_rows($Database_username)==1){
    return true;
  }
  else return false;
}
// sign in
function logged_in(){
  if(isset($_SESSION['email'])){
    return true;
  }
  else{
    return false;
  }
}
//getting the username
function Logged_in_user_data($connection){
  $logged_email = $_SESSION['email'];
  $result=mysqli_query($connection,"SELECT * FROM registered_user WHERE Email='$logged_email'");
  $row = mysqli_fetch_array($result);
  return $row;
}

// faq
function faq_load() {
  $faqContent = mysqli_query($connection, "SELECT * from faq");
  return $faqContent;
}

//books
function book_load() {
  $bookContent = mysql_query($connection, "select * from books");
  return $bookContent;
}

function getUserProfile($userId) {
  $userContent = mysql_query($connection, "select * from registered_user where User_id='$userId'");
  return $userContent;
}

#edit book
function bookUpdateQuery($fieldName,$value,$connection,$Book_id){
  $updateQuery = "UPDATE books SET $fieldName = '$value' WHERE Book_id = '$Book_id'";
  $result = mysqli_query($connection,$updateQuery);
  return $result;
}

 ?>
