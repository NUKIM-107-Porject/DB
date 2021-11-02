<?php
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin=""/>
  
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../img/LOGO.ico" type="image/x-icon"/>
    <title>Personal Info</title>
</head>

<body>
    <?php
    echo "<table border='3'>";
    if (isset($_SESSION['UID'])) {
        include("./DBconnection.php");
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
        echo "<table>"."<tr>"."<td>"."<a href='./modifyPersonalInfo.php'>修改</a>"."</td>"."</table>";

        mysqli_free_result($querycreditcardinfo_result);
        $conn->close();
        echo "</table>";
    } else {
        header("Refresh:0;url=./initial.php");
    }
    ?>


</body>

</html>