<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous"/>
  
  <link rel="stylesheet" href="../css/style.css">
  <link rel="icon" href="../img/LOGO.ico" type="image/x-icon"/>
  <title>MaPaY</title>
</head>
<body>
  <header>
    <a href="#">
      <img class="logo" src="../img/LOGO.png" alt="MaPaY-Logo">
      <h1>MaPaY</h1> 
    </a>
    <a href="#" class="burger">
      <i class="fas fa-bars"></i>
    </a>
    <!-- <form class="searchBar">
      <input type="text" name="Search" placeholder="Search">
      <input type='button' name='submit' value='click'>
    </form> -->
    <form class="search">
      <ul>
        <li>
          <input type="button" value="咖啡廳" id="cafe" class="cafe">
        </li>
        <li>
          <input type="button" value="醫院" id="hospital" class="hospital">
        </li>
        <li>
          <input type="button" value="餐廳" id="restaurant" class="restaurant">
        </li>
        <li>
          <input type="button" value="藥局" id="pharmacy" class="pharmacy">
        </li>
        <li>
          <input type="button" value="便利商店" id="store" class="store">
        </li>
        <li>
          <input type="button" value="超市" id="supermarket" class="supermarket">
        </li>
        <li>
          <input type="button" value="停車場" id="parking" class="parking">
        </li>
        <li>
          <input type="button" value="診所" id="doctor" class="doctor">
        </li>
      </ul> 
    </form>
    <?php
    if(isset($_SESSION['UID'])){
      echo '
      <ul class="burgerlist">
        <li> 
          <a href="./personalInfo.php" class="user">
            <img src="../img/user.png" alt="UserLogo">
            <span>個人資料</span>
          </a>
        </li>
        <li> 
          <a href="./personalCreditCard.php">
            <span>信用卡設定</span>
          </a> 
        </li>
        <li> 
          <a href="./logout.php" >
            <span>登出</span>
          </a> 
        </li>
      </ul>';
    }else{
      echo '
      <ul class="burgerlist">
        <li> 
          <a href="../login.html" class="user">
            <img src="../img/NoneUser.png" alt="UserLogo">
            <span>登入</span>
          </a> 
        </li>
        <li> 
          <a href="../signup.html">
            <span>註冊</span>
          </a> 
        </li>
      </ul>';
    }
    ?>
  </header>
  <div id="map"></div>  
</body>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZlmoXeSz14KZ7Tpttw2egBE-BlRkQiOk&libraries=places&callback=createMap" async defer></script>
<script src="../js/map.js"></script>
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<script src="../js/jquery-3.5.1.min.js"></script>
<script src="../js/burger.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script src="../js/all.js"></script>
</html>