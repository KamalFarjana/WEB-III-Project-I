<?php
include ("connect.php");
include ("function.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$error = "";
$success_msg = "";


if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST))
{
    $bookID=$_POST['selectedBookId'];

	$query = "UPDATE `books` set `Status` ='0' WHERE `Book_id` = '$bookID'";
	$result = mysqli_query($connection, $query);

  if(mysqli_query($connection, $query)){
    
    header("Location: myinventory.php");
  }
  else
  {
    header("Location: myinventory.php"); 
    
  }
}
?>