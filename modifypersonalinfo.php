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
        include("DBconnection.php");
        $querycreditcardinfo = "SELECT * FROM `user` WHERE `user_UID` = $UID";
        $querycreditcardinfo_result = mysqli_query($conn, $querycreditcardinfo);
        $resultcheck = mysqli_num_rows($querycreditcardinfo_result);

        echo "<form action='modifypersonalinfoDB.php' method='POST'>";
            while ($row = mysqli_fetch_array($querycreditcardinfo_result)) {
                echo "<tr>" . "<td>" . "使用者名稱" . "</td>";
                $Uname=$row['user_name'];
                echo "<td>" . "<input type='text' name='Uname' value='$Uname'>" . "</td>" . "</tr>";
                echo "<tr>" . "<td>" . "使用者信箱" . "</td>";
                echo "<td>" . $row['user_email'] . "</td>" . "</tr>";
                echo "<tr>" . "<td>" . "使用者密碼" . "</td>";
                $Upassword=$row['user_password'];
                echo "<td>" . "<input type='text' name='Upassword' value='$Upassword'>" . "</td>" . "</tr>";
            }
        echo "<table>"."<tr>"."<td>"."<input type='submit' name='submit' value='完成'>"."</td>"."</table>";
        echo "</form>";

        mysqli_free_result($querycreditcardinfo_result);
        $conn->close();
        echo "</table>";
        echo "</center>";
    } else {
        header("Refresh:0;url=initial.php");
    }
    ?>


</body>

</html>