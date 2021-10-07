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
            <td>行動支付名稱</td>
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

        
        $querypaymentinfo = "SELECT * FROM `payment`;";
        $querypaymentinfo_result = mysqli_query($conn, $querypaymentinfo);
        $resultcheck = mysqli_num_rows($querypaymentinfo_result);

        if ($resultcheck > 0) {
            while ($row = mysqli_fetch_array($querypaymentinfo_result)) {
                echo "<tr>"."<td>".$row['payment_template']."</td>"."</tr>";
            }
        }


        mysqli_free_result($querypaymentinfo_result);
        $conn->close();
        ?>
    </table>

</body>

</html>