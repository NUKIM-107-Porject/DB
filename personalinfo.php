<?php
session_start();
session_start();
$UID=$_SESSION['UID'];
echo $UID;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Info</title>
</head>

<body>
    <?php
    echo "<center>";
    echo "<table border='3'>";
    if (isset($_SESSION['UID'])) {
        $servername = "localhost";
        $username = "root";
        $password = "lin1073329";
        $dbname = "project";

        //Create connection 
        $conn = new mysqli($servername, $username, $password, $dbname);
        //Check connection -->
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $UID=$_SESSION['UID'];
        $querycreditcardinfo = "SELECT * FROM `user` WHERE `user_UID` = $UID";
        $querycreditcardinfo_result = mysqli_query($conn, $querycreditcardinfo);
        $resultcheck = mysqli_num_rows($querycreditcardinfo_result);

        if ($resultcheck > 0) {
            while ($row = mysqli_fetch_array($querycreditcardinfo_result)) {
                echo "<tr>" . "<td>" . "使用者名稱" . "</td>";
                echo "<td>" . $row['user_name'] . "</td>" . "</tr>";
                echo "<tr>" . "<td>" . "使用者信箱" . "</td>";
                echo "<td>" . $row['user_email'] . "</td>" . "</tr>";
                echo "<tr>" . "<td>" . "使用者密碼" . "</td>";
                echo "<td>" . $row['user_password'] . "</td>" . "</tr>";
            }
        }
        echo "<table>"."<tr>"."<td>"."<a href='modifypersonalinfo.php'>修改</a>"."</td>"."</table>";

        mysqli_free_result($querycreditcardinfo_result);
        $conn->close();
        echo "</table>";
        echo "</center>";
    } else {
    }
    ?>


</body>

</html>