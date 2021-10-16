<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Credit Delete</title>
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
    }
    ?>
    


</body>

</html>