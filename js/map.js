var map;
var infoWindow;
var infowindow;
var request;
var pos;
var markers = [];
var marker;

var infoObj = [];
var geocoder;
var response;
var responseDiv;

document.getElementById("cafe").onclick = function() { cafe() };
document.getElementById("hospital").onclick = function() { hospital() };
document.getElementById("restaurant").onclick = function() { restaurant() };
document.getElementById("pharmacy").onclick = function() { pharmacy() };
document.getElementById("store").onclick = function() { convenience_store() };
document.getElementById("supermarket").onclick = function() { supermarket() };
document.getElementById("parking").onclick = function() { parking() };
document.getElementById("doctor").onclick = function() { doctor() };
document.getElementById("uLocate1").onclick = function() { getCurrentLoc(); };
document.getElementById("uLocate2").onclick = function() { getCurrentLoc(); };


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

  geocoder = new google.maps.Geocoder();


//TEST
  const input = document.getElementById("pac-input");
  const searchBox = new google.maps.places.SearchBox(input);
  // Bias the SearchBox results towards current map's viewport.
  map.addListener("bounds_changed", () => {
    searchBox.setBounds(map.getBounds());
  });
  let markers = [];
  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener("places_changed", () => {
    const places = searchBox.getPlaces();
    if (places.length == 0) {
      return;
    }
    // Clear out the old markers.
    deleteMarkers();
    // markers.forEach((marker) => {
    //   marker.setMap(null);
    // });
    markers = [];
    // For each place, get the icon, name and location.
    const bounds = new google.maps.LatLngBounds();

    places.forEach((place) => {
      if (!place.geometry || !place.geometry.location) {
        console.log("Returned place contains no geometry");
        return;
      }
      const icon = {
        url: "../img/blue.png",//place.icon,
        // size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(20, 40),
        scaledSize: new google.maps.Size(40, 40),
      };
      // Create a marker for each place.
      markers.push(
        new google.maps.Marker({
          map,
          icon,
          title: place.name,
          position: place.geometry.location,
        })
      );
      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });
    map.fitBounds(bounds);
  });
//TEST

  // const inputText = document.createElement("input");
  // inputText.type = "text";
  // inputText.placeholder = "Enter a location";

  // const submitButton = document.createElement("input");
  // submitButton.type = "button";
  // submitButton.value = "Search";
  // submitButton.classList.add("button", "button-primary");

  // const clearButton = document.createElement("input");
  // clearButton.type = "button";
  // clearButton.value = "Clear";
  // clearButton.classList.add("button", "button-secondary");
  // response = document.createElement("pre");
  // response.id = "response";
  // response.innerText = "";
  // responseDiv = document.createElement("div");
  // responseDiv.id = "response-container";
  // responseDiv.appendChild(response);

  // map.controls[google.maps.ControlPosition.TOP_LEFT].push(inputText);
  // map.controls[google.maps.ControlPosition.TOP_LEFT].push(submitButton);
  // map.controls[google.maps.ControlPosition.TOP_LEFT].push(clearButton);
  
  // marker = new google.maps.Marker({
  //   map,
  // });
  // map.addListener("click", (e) => {
  //   geocode({ location: e.latLng });
  // });
  // submitButton.addEventListener("click", () =>
  //   geocode({ address: inputText.value })
  // );
  clearButton.addEventListener("click", () => {
    clear();
  });
  clear();
}

function getCurrentLoc() {
  // infoWindow = new google.maps.InfoWindow({map: map});
  user = new google.maps.Marker({
    map: map,
    icon: "../img/Here.ico",
  });
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function (position) {
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
    }, function () {
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

function geocode(request) {
  clear();
  geocoder
    .geocode(request)
    .then((result) => {
      const { results } = result;

      map.setCenter(results[0].geometry.location);
      for (var i = 0; i < results.length; i++) {
        marker.setPosition(results[i].geometry.location);
      }

      marker.setMap(map);
      responseDiv.style.display = "block";
      response.innerText = JSON.stringify(result, null, 2);
      return results;
    })
    .catch((e) => {
      alert("Geocode was not successful for the following reason: " + e);
    });
}

function clear() {
  marker.setMap(null);
  responseDiv.style.display = "none";
}

function cafe() {
  deleteMarkers();
  var request = {
    location: map.getCenter(),
    radius: 1500,
    types: ["cafe"]
  }
  var service = new google.maps.places.PlacesService(map);
  service.nearbySearch(request, callback);
}

function hospital() {
  deleteMarkers();
  var request = {
    location: map.getCenter(),
    radius: 1500,
    types: ["hospital"]
  }
  var service = new google.maps.places.PlacesService(map);
  service.nearbySearch(request, callback);
}

function restaurant() {
  deleteMarkers();
  var request = {
    location: map.getCenter(),
    radius: 1500,
    types: ["restaurant"]
  }
  var service = new google.maps.places.PlacesService(map);
  service.nearbySearch(request, callback);
}

function convenience_store() {
  deleteMarkers();
  var request = {
    location: map.getCenter(),
    radius: 1500,
    types: ["convenience_store"]
  }
  var service = new google.maps.places.PlacesService(map);
  service.nearbySearch(request, callback);
}

function parking() {
  deleteMarkers();
  var request = {
    location: map.getCenter(),
    radius: 1500,
    types: ["parking"]
  }
  var service = new google.maps.places.PlacesService(map);
  service.nearbySearch(request, callback);
}

function doctor() {
  deleteMarkers();
  var request = {
    location: map.getCenter(),
    radius: 1500,
    types: ["doctor"]
  }
  var service = new google.maps.places.PlacesService(map);
  service.nearbySearch(request, callback);
}

function pharmacy() {
  deleteMarkers();
  var request = {
    location: map.getCenter(),
    radius: 1500,
    types: ["pharmacy"]
  }
  var service = new google.maps.places.PlacesService(map);
  service.nearbySearch(request, callback);
}

function supermarket() {
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
    title: place.name,
    icon: {url:"../img/green.png", scaledSize: new google.maps.Size(40, 40)}, 
  });
  markers.push(marker);
  infowindow=new google.maps.InfoWindow({
    content:"123\n123"
  });
  google.maps.event.addListener(marker,'click',createInfo(marker));
}

function createInfo(marker){
  return function(){
      infowindow.open(map,marker);
  };
}

function closeOtherInfo() {
  if (InforObj.length > 0) {
      InforObj[0].set("marker", null);
      InforObj[0].close();
      InforObj.length = 0;
  }
}

function deleteMarkers() {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(null);
  }
}

function setplaceinfo(place) {
  var test = place.name;
  google.maps.event.addListener(marker, 'click', (function (marker, infowindow) {
    return function () {
      infowindow.open(map, marker);
    };
  })(marker, infowindow));
}