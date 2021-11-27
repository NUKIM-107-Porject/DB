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
    <title>Add Credit Card</title>
</head>

<body>
    <div class="creditContainer">
        <?php
            if (isset($_SESSION['UID'])) {
                include("./DBconnection.php");
                $queryCreditcardBank="SELECT B.BID,B.name FROM bank B";
                $queryCreditcardBank_result = mysqli_query($conn, $queryCreditcardBank);
                $queryCreditcardBank_resultcheck = mysqli_num_rows($queryCreditcardBank_result);
                echo "<h1>Choose Credit Card Bank</h1>";
                if ($queryCreditcardBank_resultcheck > 0) {
                    echo "<h1><select id='bankID' onchange='queryCreditcardInfo(this.value)'>
                    <option selected disable>-- select --</option>;
                    <option value='1'>test1</option>";
                    while ($row = mysqli_fetch_array($queryCreditcardBank_result)) {
                        $bank_ID=$row['BID'];
                        $bank_name=$row['name'];
                        echo "<option value='$bank_ID'>$bank_name</option>";
                    }
                    echo "</select></h1>";
                }
            }
                // $conn->close();
            } else {
                header("Refresh:0;url=./home.php");
            }
        ?>
        <h1 id="txtHint"></h1>
        <script type="text/javascript">
            function queryCreditcardInfo(bankName) {
                //alert(bankName);
                if (bankName == "") {
                document.getElementById("txtHint").innerHTML = "";
                return;
                } else {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET","queryCreditcardInfoDB.php?q="+bankName,true);
                xmlhttp.send();
                }
            }
        </script>
    </div>
</body>
</html>