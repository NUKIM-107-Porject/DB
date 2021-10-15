<?php
$CID = @$_POST['CID'];


$servername = "localhost";
$username = "root";
$password = "lin1073329";
$dbname = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} else {
  $deletecredit = "DELETE FROM user_creditcard_relation WHERE user_creditcard_relation.CID='$CID'";
  $deletecredit_result = mysqli_query($conn, $deletecredit);
}
  $conn->close();
  header("Refresh:0;url=deletepersonalcreditcard.php");
?>