<?php
$Uname = @$_POST['Uname'];
$Uemail = @$_POST['Uemail'];
$Upassword = @$_POST['Upassword'];
//echo $Uname."<br>";
//echo $Uemail."<br>";
//echo $Upassword."<br>";

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
else{
//echo "Registration successfully...<br>";

$insert = "INSERT INTO `user` (`user_UID`, `user_name`, `user_password`, `user_email`) VALUES (NULL, '$Uname', '$Upassword', '$Uemail');";
//$insert2 = "Select * From user;";
$insert_result = mysqli_query($conn, $insert);

if($insert_result){
    echo "success!";
}    
else{
    echo "fail!";
}

$conn->close();
}
?>