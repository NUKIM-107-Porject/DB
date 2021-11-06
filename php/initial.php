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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin=""/>
  
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../img/LOGO.ico" type="image/x-icon"/>
    <title>MaPaY-Personal</title>
</head>

<body>
    <?php
        if (isset($_SESSION['UID'])) {
            //echo $_SESSION['UID'];    
            echo "<h1>";
            echo "<a href='./personalInfo.php'>個人資料</a>";
            echo "<br><a href='./personalCreditCard.php'>選擇/修改所使用的信用卡種</a>";
            echo "<br><a href='./logout.php'>登出</a>";
            echo "</h1>";
        } else {
            echo "<h1>";
            echo "home";
            echo "<br><a href='../login.html'>登入/註冊</a>";
            echo "</h1>";
        }
    ?>
</body>
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<script src="./js/jquery-3.5.1.min.js"></script>
<script src="./js/burger.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script src="./js/all.js"></script>
</html>