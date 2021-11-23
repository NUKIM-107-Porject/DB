<?php
    session_start();
    $UID = $_SESSION['UID'];
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
    <title>Personal Credit Add</title>
</head>

<body>
    <div class="creditContainer">
        <?php
            if (isset($_SESSION['UID'])) {
                include("./DBconnection.php");
                $querycreditcardinfo = "SELECT c.creditcard_CID,c.creditcard_bank,c.creditcard_category
            FROM credit_card c
            WHERE c.creditcard_CID NOT IN (SELECT U.CID FROM user_creditcard_relation U WHERE U.UID='$UID');";
                $querycreditcardinfo_result = mysqli_query($conn, $querycreditcardinfo);
                $resultcheck = mysqli_num_rows($querycreditcardinfo_result);
                echo "<h1>Add A Credit Card</h1>";
                if ($resultcheck > 0) {
                    echo "<form action='./addPersonalCreditCardDB.php' method='POST'>";
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

                //mysqli_free_result($querycreditcardinfo_result);
                $conn->close();
            } else {
                header("Refresh:0;url=./home.php");
            }
        ?>
    </div>
</body>
</html>