<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Credit Add</title>
</head>

<body>
    <?php
    echo "<center>";

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

    $UID = $_SESSION['UID'];
    $querycreditcardinfo = "SELECT C.creditcard_bank,C.creditcard_category FROM credit_card C,user_creditcard_relation U WHERE U.UID='$UID' AND C.creditcard_CID=U.CID ORDER BY C.creditcard_bank";
    $querycreditcardinfo_result = mysqli_query($conn, $querycreditcardinfo);
    $resultcheck = mysqli_num_rows($querycreditcardinfo_result);

    echo "<form action='modifypersonalinfoDB.php' method='POST'>";
        echo "<select name='creditcard'>";
        echo "<option value='Taipei'>台北</option>";
        echo "<option value='Tainan'>台南</option>";
        echo "</select>";
    echo "</form>";


    mysqli_free_result($querycreditcardinfo_result);
    $conn->close();
    echo "</center>";

    ?>



</body>

</html>