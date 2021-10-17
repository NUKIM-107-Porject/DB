<?php
session_start();
$UID = $_SESSION['UID'];
echo $UID . "<br>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAP</title>
</head>

<body>
    <?php
    if (isset($_SESSION['UID'])) {
        //echo $_SESSION['UID'];    
        echo "<center>";
        echo "<h1>";
        echo "<a href='./personalInfo.php'>個人資料</a>";
        echo "<br><a href='./personalCreditCard.php'>選擇/修改所使用的信用卡種</a>";
        echo "<br><a href='./logout.php'>登出</a>";
        echo "</h1>";
        echo "</center>";
    } else {
        echo "<center>";
        echo "<h1>";
        echo "visiter";
        echo "<br><a href='./loginregist.php'>登入/註冊</a>";
        echo "</h1>";
        echo "</center>";
    }
    ?>
</body>

</html>