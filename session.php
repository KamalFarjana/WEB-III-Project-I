<?php
include('connect.php');
$user_check=$_SESSION['email'];
$ses_sql=mysqli_query($connection,"SELECT User_id,Username,Password from registered_user where Email='$user_check'");
$row=mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
$loggedin_session=$row['Username'];
$loggedin_id=$row['Password'];
if(!isset($loggedin_session) || $loggedin_session==NULL) {
 echo "Go back";

}
?>
