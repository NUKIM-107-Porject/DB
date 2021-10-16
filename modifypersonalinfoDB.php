<?php
session_start();
$UID=$_SESSION['UID'];
//echo $UID;
$Uname = @$_POST['Uname'];
$Upassword = @$_POST['Upassword'];

// echo $Uname;
// echo $Upassword;

$servername = "localhost";
$username = "root";
$password = "lin1073329";
$dbname = "project";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$UpdateUserInfo = "UPDATE user SET user_name='$Uname' ,user_password = '$Upassword' WHERE user.user_UID ='$UID' ;";
$UpdateUserInfo_result = mysqli_query($conn, $UpdateUserInfo);



mysqli_free_result($UpdateUserInfo_result);
$conn->close();

header("Refresh:0;url=personalinfo.php");

?>