<?php
session_start();
$Uemail = @$_POST['Uemail'];
$Upassword = @$_POST['Upassword'];

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

$querypassword = "SELECT * FROM `user` WHERE `user_email` = '$Uemail';";
$querypassword_result = mysqli_query($conn, $querypassword);
$row=mysqli_fetch_assoc($querypassword_result);

if($row['user_password']!=null){
    if($row['user_password']==$Upassword){
        //echo $row['user_UID'];
        //echo "<script>alert('login successfully')<script>";
        $_SESSION['UID']=$row['user_UID'];
        header("Refresh:0;url=map.php");    
    }
    else{
        //echo "login fail!(Wrong Password)";
        header("Refresh:0;url=initial.html");
    }
}    
else{
    //header("url=signin.html");
    //echo "login fail!(Wrong Email)";
    header("Refresh:0;url=initial.html");
    //sleep(3); header("signin.html");
}

mysqli_free_result($querypassword_result);
$conn->close();
?>