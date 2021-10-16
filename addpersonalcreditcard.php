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
    $querycreditcardinfo = "SELECT c.creditcard_CID,c.creditcard_bank,c.creditcard_category
    FROM credit_card c
    WHERE c.creditcard_CID NOT IN (SELECT U.CID FROM user_creditcard_relation U WHERE U.UID='$UID');";
    $querycreditcardinfo_result = mysqli_query($conn, $querycreditcardinfo);
    $resultcheck = mysqli_num_rows($querycreditcardinfo_result);
    echo "<h1 style='text-align:center'>Add A Credit Card";
    if ($resultcheck > 0) {
        echo "<form action='addpersonalcreditcardDB.php' method='POST'>";
        echo "<select name='creditcard'>";
        //echo "<option selected disable>-- select --</option>";
        while ($row = mysqli_fetch_array($querycreditcardinfo_result)) {
            $CID = $row['creditcard_CID'];
            $creditcardbank = $row['creditcard_bank'];
            $creditcardcategory = $row['creditcard_category'];
            echo "<option value='$CID'>$creditcardbank $creditcardcategory</option>";
        }
        echo "</select>";
        echo "<input type='submit' value='Submit'>";
        echo "</form>";
        echo "</h1>";
    } 

    mysqli_free_result($querycreditcardinfo_result);
    $conn->close();
    echo "</center>";

    ?>



</body>

</html>