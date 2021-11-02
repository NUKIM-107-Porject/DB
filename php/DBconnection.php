<?php
$servername = "localhost";
$username = "id17841235_root";
$password = "g)PJ!mY9@{%O0tee";
$dbname = "id17841235_nukim107project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
