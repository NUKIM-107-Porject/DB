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
  <!-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin=""/> -->
  
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
<!-- <script src="./js/map.js"async defer></script> -->
<script>
            var map;
            var infoWindow;
            var request;
            var pos;
            const searchtxt=document.getElementByName('Search')[0].value;

            function createMap() {
                map = new google.maps.Map(document.getElementById('map'), {
                    center: {
                        lat: 22.687370,
                        lng: 120.301476
                    },
                    zoom: 14
                });
                getCurrentLoc();

            }

            function getCurrentLoc(){
                infoWindow = new google.maps.InfoWindow({map: map});
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };

                        infoWindow.setPosition(pos);
                        infoWindow.setContent('Location found.');
                        map.setCenter(pos);

                    }, function() {
                        handleLocationError(true, infoWindow, map.getCenter());
                    });
                } else {
                    // Browser doesn't support Geolocation
                    handleLocationError(false, infoWindow, map.getCenter());
                }
            }

            function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                infoWindow.setPosition(pos);
                infoWindow.setContent(browserHasGeolocation ?
                                    'Error: The Geolocation service failed.' :
                                    'Error: Your browser doesn\'t support geolocation.');
            }

            function cafe(){
                var request = {
                    location: map.getCenter(),
                    radius: 1500,
                    types: ["cafe"]
                }

                var service = new google.maps.places.PlacesService(map);

                service.nearbySearch(request, callback);
            }

            function hospital(){
                var request = {
                    location: map.getCenter(),
                    radius: 1500,
                    types: ["hospital"]
                }

                var service = new google.maps.places.PlacesService(map);

                service.nearbySearch(request, callback);
            }

            function restaurant(){
                var request = {
                    location: map.getCenter(),
                    radius: 1500,
                    types: ["restaurant"]
                }

                var service = new google.maps.places.PlacesService(map);

                service.nearbySearch(request, callback);
            }

            function convenience_store(){
                var request = {
                    location: map.getCenter(),
                    radius: 1500,
                    types: ["convenience_store"]
                }

                var service = new google.maps.places.PlacesService(map);

                service.nearbySearch(request, callback);
            }

            function parking(){
                var request = {
                    location: map.getCenter(),
                    radius: 1500,
                    types: ["parking"]
                }

                var service = new google.maps.places.PlacesService(map);

                service.nearbySearch(request, callback);
            }

            function doctor(){
                var request = {
                    location: map.getCenter(),
                    radius: 1500,
                    types: ["doctor"]
                }

                var service = new google.maps.places.PlacesService(map);

                service.nearbySearch(request, callback);
            }

            function pharmacy(){
                var request = {
                    location: map.getCenter(),
                    radius: 1500,
                    types: ["pharmacy"]
                }

                var service = new google.maps.places.PlacesService(map);

                service.nearbySearch(request, callback);
            }

            function supermarket(){
                var request = {
                    location: map.getCenter(),
                    radius: 1500,
                    types: ["supermarket"]
                }

                var service = new google.maps.places.PlacesService(map);

                service.nearbySearch(request, callback);
            }

            function callback(results, status) {
                if (status == google.maps.places.PlacesServiceStatus.OK) {
                    console.log(results.length);
                    for (var i = 0; i < results.length; i++) {
                    createMarker(results[i]);
                    }
                }
            }

            function createMarker(place) {
                var placeLoc = place.geometry.location;
                var marker = new google.maps.Marker({
                    map: map,
                    position: place.geometry.location,
                    title: place.name
                })
            }
        </script>
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<script src="../js/jquery-3.5.1.min.js"></script>
<script src="../js/burger.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script src="../js/all.js"></script>
</html>