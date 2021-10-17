<?php
session_start();
if (isset($_SESSION['UID'])) {
$servername = "localhost";
$username = "root";
$password = "lin1073329";
$dbname = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
}
else{
  header("Refresh:0;url=./initial.php");
}
?>