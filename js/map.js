var map;
var infoWindow;
var request;
var pos;
var markers=[];
var marker;

document.getElementById("cafe").onclick = function() {cafe()};
document.getElementById("hospital").onclick = function() {hospital()};
document.getElementById("restaurant").onclick = function() {restaurant()};
document.getElementById("pharmacy").onclick = function() {pharmacy()};
document.getElementById("store").onclick = function() {convenience_store()};
document.getElementById("supermarket").onclick = function() {supermarket()};
document.getElementById("parking").onclick = function() {parking()};
document.getElementById("doctor").onclick = function() {doctor()};

function createMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: {
      lat: 22.687370,
      lng: 120.301476
    },
    zoom: 15,
    mapTypeControl: false,//地圖種類
    fullscreenControl: false,//全螢幕
    streetViewControl: false,//小人
  });
  getCurrentLoc();
}

function getCurrentLoc(){
  // infoWindow = new google.maps.InfoWindow({map: map});
  user = new google.maps.Marker({
    map: map,
    icon:"./img/ufo.ico"
  });
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      user.setPosition(pos);
      // user.setContent('You are here!');
      // infoWindow.setPosition(pos);
      // infoWindow.setContent('You are here!');
      map.setCenter(pos);
      // nearbysearch();
      // map.setCenter(pos);
    }, function() {
        handleLocationError(true, infoWindow, map.getCenter());
      });
  } 
  else {
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
  deleteMarkers();
  var request = {
    location: map.getCenter(),
    radius: 1500,
    types: ["cafe"]
  }
  var service = new google.maps.places.PlacesService(map);
  service.nearbySearch(request, callback);
}

function hospital(){
  deleteMarkers();
  var request = {
    location: map.getCenter(),
    radius: 1500,
    types: ["hospital"]
  }
  var service = new google.maps.places.PlacesService(map);
  service.nearbySearch(request, callback);
}

function restaurant(){
  deleteMarkers();
  var request = {
    location: map.getCenter(),
    radius: 1500,
    types: ["restaurant"]
  }
  var service = new google.maps.places.PlacesService(map);
  service.nearbySearch(request, callback);
}

function convenience_store(){
  deleteMarkers();
  var request = {
    location: map.getCenter(),
    radius: 1500,
    types: ["convenience_store"]
  }
  var service = new google.maps.places.PlacesService(map);
  service.nearbySearch(request, callback);
}

function parking(){
  deleteMarkers();
  var request = {
    location: map.getCenter(),
    radius: 1500,
    types: ["parking"]
  }
  var service = new google.maps.places.PlacesService(map);
  service.nearbySearch(request, callback);
}

function doctor(){
  deleteMarkers();
  var request = {
    location: map.getCenter(),
    radius: 1500,
    types: ["doctor"]
  }
  var service = new google.maps.places.PlacesService(map);
  service.nearbySearch(request, callback);
}

function pharmacy(){
  deleteMarkers();
  var request = {
    location: map.getCenter(),
    radius: 1500,
    types: ["pharmacy"]
  }
  var service = new google.maps.places.PlacesService(map);
  service.nearbySearch(request, callback);
}

function supermarket(){
  deleteMarkers();
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
    for (var i = 0; i < results.length; i++) {
      createMarker(results[i]);
    }
  }
}

function createMarker(place) {
  marker = new google.maps.Marker({
    map: map,
    position: place.geometry.location,
    title: place.name
  });
  markers.push(marker);
}

function deleteMarkers() {
  for(var i=0;i<markers.length;i++){
    markers[i].setMap(null);
  }
}