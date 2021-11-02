<?php
session_start();
$UID=$_SESSION['UID'];
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
    <title>Personal Credit Delete</title>
</head>

<body>
    <?php
    echo "<center>";
    echo "<table border='3'>";
    if (isset($_SESSION['UID'])) {
        include("./DBconnection.php");
        $querycreditcardinfo = "SELECT C.creditcard_CID,C.creditcard_bank,C.creditcard_category FROM credit_card C,user_creditcard_relation U WHERE U.UID='$UID' AND C.creditcard_CID=U.CID ORDER BY C.creditcard_bank";
        $querycreditcardinfo_result = mysqli_query($conn, $querycreditcardinfo);
        $resultcheck = mysqli_num_rows($querycreditcardinfo_result);

        echo "<tr>" . "<td>" . "銀行" . "</td>";
        echo "<td>" . "卡種" . "</td>" . "</tr>";
        if ($resultcheck > 0) {
            while ($row = mysqli_fetch_array($querycreditcardinfo_result)) {
                echo "<tr>" ."<td>" . $row['creditcard_bank'] . "</td>" ;
                $CID=$row['creditcard_CID'];
                echo "<td>" . $row['creditcard_category']."<form action='deletepersonalcreditcardDB.php' method='POST'>"."<input type='hidden' name='CID' value='$CID'>"  ."<input type='submit' name='submit' value='刪除'>"."</form>"."</td>" . "</tr>";
            }
        }

        mysqli_free_result($querycreditcardinfo_result);
        $conn->close();
        // echo "<table>"."<tr>"."<td>"."<a href='deletepersonalcreditcard.php'>刪除</a>"."</td>";
        // echo "<td>"."<a href='addpersonalcreditcard.php'>新增</a>"."</td>"."</tr>"."</table>";
        echo "</center>";
    } else {
        header("Refresh:0;url=./initial.php");
    }
    ?>
    


</body>

</html>