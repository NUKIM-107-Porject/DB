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
    <title>MAP</title>
</head>

<body>
    <?php
    if(isset($_SESSION['UID'])){
    //echo $_SESSION['UID'];    
    echo "<a href='personalinfo.php'>個人資料</a>";
    echo "<br><a href='personalcreditcard.php'>選擇/修改所使用的信用卡種</a>";
    //echo "<input type='button' value='個人資料' onclick='location.href='modifypersonalinfo.php''>";
    //echo "<input type='button' value='選擇/修改所使用的信用卡種' onclick='location.href='modifypersonalcreditcard.php''>";
    }
    else{
        header("Refresh:0;url=initial.html");
    }
    ?>
</body>

</html>