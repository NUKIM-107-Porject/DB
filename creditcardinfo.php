<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credit Card Info</title>
</head>

<body>

    <table border="3">
        <tr>
            <td>發行銀行</td>
            <td>卡種</td>
        </tr>

        <?php
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

        
        $querycreditcardinfo = "SELECT * FROM `credit_card`;";
        $querycreditcardinfo_result = mysqli_query($conn, $querycreditcardinfo);
        $resultcheck = mysqli_num_rows($querycreditcardinfo_result);

        if ($resultcheck > 0) {
            while ($row = mysqli_fetch_array($querycreditcardinfo_result)) {
                echo "<tr>"."<td>".$row['creditcard_bank']."</td>";
                echo "<td>".$row['creditcard_category']."</td>"."</tr>";
                //           echo "<tr><td>$row['creditcard_bank']</td>";
                //           echo "<td>$row['creditcard_category']</td></tr>";
            }
        }


        mysqli_free_result($querycreditcardinfo_result);
        $conn->close();
        ?>
    </table>

</body>

</html>