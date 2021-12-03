var map;
var infoWindow;
var infowindow;
var request;
var pos;
var markers = [];
var marker;
var searchmarkers = [];
var infoObj = [];
var geocoder;
var response;
var responseDiv;

document.getElementById("store1").onclick = function() { FilterStoreType(1) };
document.getElementById("store2").onclick = function() { FilterStoreType(2) };
document.getElementById("store3").onclick = function() { FilterStoreType(3) };
document.getElementById("store4").onclick = function() { FilterStoreType(4) };
document.getElementById("store5").onclick = function() { FilterStoreType(5) };
document.getElementById("store6").onclick = function() { FilterStoreType(6) };
document.getElementById("store7").onclick = function() { FilterStoreType(7) };
document.getElementById("store8").onclick = function() { FilterStoreType(8) };
document.getElementById("store9").onclick = function() { FilterStoreType(9) };
document.getElementById("store10").onclick = function() { FilterStoreType(10) };
document.getElementById("store11").onclick = function() { FilterStoreType(0) };

document.getElementById("uLocate1").onclick = function() { setCurrentLoc(); };
document.getElementById("uLocate2").onclick = function() { setCurrentLoc(); };

document.getElementById("pay1").onclick = function () { filterPayment(1); };
document.getElementById("pay2").onclick = function () { filterPayment(2); };
document.getElementById("pay3").onclick = function () { filterPayment(3); };
document.getElementById("pay4").onclick = function () { filterPayment(4); };
document.getElementById("pay5").onclick = function () { filterPayment(5); };
document.getElementById("pay6").onclick = function () { filterPayment(6); };
document.getElementById("pay7").onclick = function () { filterPayment(7); };
document.getElementById("pay8").onclick = function () { filterPayment(8); };
document.getElementById("pay9").onclick = function () { filterPayment(9); };
document.getElementById("pay10").onclick = function () { filterPayment(10); };
document.getElementById("pay11").onclick = function () { filterPayment(11); };
document.getElementById("pay12").onclick = function () { filterPayment(12); };

function createMap() {//建map、放user
  if (navigator.geolocation) {// Browser do support Geolocation
    navigator.geolocation.getCurrentPosition(function (position) {
      pos = {
        lat: position.coords.latitude,//緯度
        lng: position.coords.longitude//經度
      };
    }, function () {
      // handleLocationError(true, infoWindow, map.getCenter());
      handleLocationError(true);
    });
  }
  else {
    // Browser doesn't support Geolocation
    handleLocationError(false);
  }
  //new
  map = new google.maps.Map(document.getElementById('map'), {
    center: pos,
    styles:[
      {
          featureType:'poi.business',
          stylers:[{visibility:'off'}]
      },
      {
          featureType:'poi.medical',
          stylers:[{visibility:'off'}]
      },
      {
          featureType:'poi.place_of_worship',
          stylers:[{visibility:'off'}]
      },
      {
          featureType:'poi.sports_complex',
          stylers:[{visibility:'off'}]
      },
      {
        elementType: "geometry",
        stylers: [{"color": "#ebe3cd"}]
      },
      {
        elementType: "labels.text.fill",
        stylers: [{"color": "#523735"}]
      },
      {
        elementType: "labels.text.stroke",
        stylers: [{"color": "#f5f1e6"}]
      },
      {
        featureType: "administrative",
        elementType: "geometry.stroke",
        stylers: [{"color": "#c9b2a6"}]
      },
      {
        featureType: "administrative.land_parcel",
        elementType: "geometry.stroke",
        stylers: [{"color": "#dcd2be"}]
      },
      {
        featureType: "administrative.land_parcel",
        elementType: "labels.text.fill",
        stylers: [{"color": "#ae9e90"}]
      },
      {
        featureType: "landscape.natural",
        elementType: "geometry",
        stylers: [{"color": "#dfd2ae"}]
      },
      {
        featureType: "poi",
        elementType: "geometry",
        stylers: [{"color": "#dfd2ae"}]
      },
      {
        featureType: "poi",
        elementType: "labels.text.fill",
        stylers: [{"color": "#93817c"}]
      },
      {
        featureType: "poi.park",
        elementType: "geometry.fill",
        stylers: [{"color": "#a5b076"}]
      },
      {
        featureType: "poi.park",
        elementType: "labels.text.fill",
        stylers: [{"color": "#447530"}]
      },
      {
        featureType: "road",
        elementType: "geometry",
        stylers: [{"color": "#f5f1e6"}]
      },
      {
        featureType: "road.arterial",
        elementType: "geometry",
        stylers: [{"color": "#fdfcf8"}]
      },
      {
        featureType: "road.highway",
        elementType: "geometry",
        stylers: [{"color": "#f8c967"}]
      },
      {
        featureType: "road.highway",
        elementType: "geometry.stroke",
        stylers: [{"color": "#e9bc62"}]
      },
      {
        featureType: "road.highway.controlled_access",
        elementType: "geometry",
        stylers: [{"color": "#e98d58"}]
      },
      {
        featureType: "road.highway.controlled_access",
        elementType: "geometry.stroke",
        stylers: [{"color": "#db8555"}]
      },
      {
        featureType: "road.local",
        elementType: "labels.text.fill",
        stylers: [{"color": "#806b63"}]
      },
      {
        featureType: "transit.line",
        elementType: "geometry",
        stylers: [{"color": "#dfd2ae"}]
      },
      {
        featureType: "transit.line",
        elementType: "labels.text.fill",
        stylers: [{"color": "#8f7d77"}]
      },
      {
        featureType: "transit.line",
        elementType: "labels.text.stroke",
        stylers: [{"color": "#ebe3cd"}]
      },
      {
        featureType: "transit.station",
        elementType: "geometry",
        stylers: [{"color": "#dfd2ae"}]
      },
      {
        featureType: "water",
        elementType: "geometry.fill",
        stylers: [{"color": "#b9d3c2"}]
      },
      {
        featureType: "water",
        elementType: "labels.text.fill",
        stylers: [{"color": "#92998d"}]
      }],
    zoom: 15,
    mapTypeControl: false,//地圖種類
    fullscreenControl: false,//全螢幕
    streetViewControl: false,//小人
  });
  setCurrentLoc();//放User Marker

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
    // console.log(places);
    if (places.length == 0) {
      return;
    }
    console.log("DELETED");
    deleteMarkers(markers);

    markers = [];

    const bounds = new google.maps.LatLngBounds();
    // For each place, get the icon, name and location.
    // console.log(bounds);
    deleteMarkers(searchmarkers);
    places.forEach((place) => {
      if (!place.geometry || !place.geometry.location) {
        console.log("Returned place contains no geometry");
        return;
      }
      // console.log("TEST");
      console.log(place);
      // Create a marker for each place.
      searchMarker = {
        coords: place.geometry.location,
        title: place.name,
        icon: {
          url: "../img/blue.png",
          scaledSize: new google.maps.Size(40, 40)
        },
        // content: "<p>" + place.name + "<br/>" + place.adr_address + "</p>",
        content: "<p>" + place.name + "<br/>" +place.price_level+"<br/>"+ place.rating+"<br/>"+ place.user_ratings_total +"<br/>"+place.opening_hours+"<br/>"+ place.formatted_address+ "</p>",
        character: "search"
      };
      addMarker(searchMarker);
      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });
    map.fitBounds(bounds);
  });
}

function handleLocationError() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: {
      lat: 22.733035,//緯度
      lng: 120.287869//經度
    },
    zoom: 15,
    mapTypeControl: false,//地圖種類
    fullscreenControl: false,//全螢幕
    streetViewControl: false,//小人
  });
  // infoWindow.setContent(browserHasGeolocation ?
  // 'Error: The Geolocation service failed.' :
  // 'Error: Your browser doesn\'t support geolocation.');
}

function setCurrentLoc() {//設user所在位址為marker(new version)
  if (navigator.geolocation) {// Browser do support Geolocation
    navigator.geolocation.getCurrentPosition(function (position) {
      pos = {
        lat: position.coords.latitude,//緯度
        lng: position.coords.longitude//經度
      };
      // console.log(pos);
      user = {
        coords: pos,
        icon: "../img/Here.ico",
        content: "<h1>USER</h1>",
        character: "user"
      }
      addMarker(user);
      map.setCenter(pos);

      searchNearBy(pos, 2, null, null);//周圍2km所有可使用行動支付商家
    }, function () {
      handleLocationError(true);
    });
  }
  else {
    // Browser doesn't support Geolocation
    handleLocationError(false);
    // handleLocationError(false, infoWindow, map.getCenter());
  }
}

function addMarker(props) {//新增Marker(new version)
  console.log("TTTTTTT"+props);
  // console.log(props.coords);
  console.log(props.content);
  var marker = new google.maps.Marker({
    position: props.coords,
    map: map,
  });
  // Check for customicon
  if (props.icon) {
    // Set icon image
    marker.setIcon(props.icon);
  }
  // Check content
  if (props.content) {
    var infoWindow = new google.maps.InfoWindow({
      content: props.content
    });
    marker.addListener('click', function () {
      infoWindow.open(map, marker);
    });
  }
  if (props.character == "search") {
    searchmarkers.push(marker);
  }
  else if (props.character != "user") {
    markers.push(marker);
  }
}

function searchRange(range) {//搜尋range內所有可使用行動支付商店
  deleteMarkers(markers);
  searchNearBy(pos, range, null, null);
}

function filterPayment(payment) {
  deleteMarkers(markers,payment);
  console.log("Payment" + payment);
  searchNearBy(pos, 10, null, payment);//search range in 10KM with payment
}

function searchNearBy(position, range, storeCategory, payment) {//payment可使用此行動支付商家,null:不指定;storeCategory顯示的商家種類
  console.log(position);
  // console.log(position + " " + range + " " + storeCategory + " " + payment);
  var ajax = new XMLHttpRequest();
  ajax.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var nearByStore = JSON.parse(this.responseText);
    //   console.log("Result:" + nearByStore.length);
      for (var i = 0; i < nearByStore.length; i++) {//各家商家資料
        //name,storecategory_category,address,address_Longtitude,address_Latitude,payment_template
        console.log(nearByStore[i][0] + " " + nearByStore[i][1] + " " + nearByStore[i][2] + " " + nearByStore[i][3] + " " + nearByStore[i][4]);
        var store = {
          coords: {
            lat: parseFloat(nearByStore[i][4]),//緯度
            lng: parseFloat(nearByStore[i][3])//經度
            // lat: x,//緯度
            // lng: y//經度
          },
          // icon:"../img/Here.ico",
          icon: { url: "../img/green.png", scaledSize: new google.maps.Size(40, 40) },
          content: "<h1>" + nearByStore[i][0] + "</h1><h2>" + nearByStore[i][1] + "<h2><h3>" + nearByStore[i][2] + "</h3><h4>" + nearByStore[i][5] + "</h4>",//店名、類型、地址、行動支付
          category: nearByStore[i][1],
          payment: nearByStore[i][5]
        };
        // deleteMarkers(markers);
        addMarker(store);
      }
    }

  };
  ajax.open("GET", "queryNearByStoreDB.php?lng=" + position.lng + "&" + "lat=" + position.lat + "&" + "range=" + range + "&" + "storeCategory=" + storeCategory + "&" + "payment=" + payment, true);
  // ajax.open("GET", "queryNearByStoreDB.php?lng=" + position.lng + "&" + "lat=" + position.lat + "&" + "range=" + range + "&" + "userpayment=" + userPayment, true);
  //search?q=網址一次傳多個值&addon=opensearch
  ajax.send();
}
function geocode(request) {
  // clear();
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

// function clear() {
//   marker.setMap(null);
//   responseDiv.style.display = "none";
// }

function FilterStoreType(StoreType) {
  // var StoreType=StoreType;
  switch (StoreType) {
    case 1:
      searchNearBy(pos,2,1,0);
      break;
    case 2:
      searchNearBy(pos,2,2,0);
      break;
    case 3:
      searchNearBy(pos,2,3,0);
      break;
    case 4:
      searchNearBy(pos,2,4,0);
      break;
    case 5:
      searchNearBy(pos,2,5,0);
      break;
    case 6:
      searchNearBy(pos,2,6,0);
      break;
    case 7:
      searchNearBy(pos,2,7,0);
      break;
    case 8:
      searchNearBy(pos,2,8,0);
      break;
    case 9:
      searchNearBy(pos,2,9,0);
      break;
    case 10:
      searchNearBy(pos,2,10,0);
      break;
    case 0:
      searchNearBy(pos,2,0,0);
      break;
    default:
      break;
  }
}

// function createInfo(marker) {
//   return function () {
//     infowindow.open(map, marker);
//   };
// }

function closeOtherInfo() {
  if (InforObj.length > 0) {
    InforObj[0].set("marker", null);
    InforObj[0].close();
    InforObj.length = 0;
  }
}

function deleteMarkers(selectedmarkers, payment) {//刪除傳入之markers(array)
  if (payment == null) {
    for (var i = 0; i < selectedmarkers.length; i++) {
      selectedmarkers[i].setMap(null);
    }
    selectedmarkers = null;
    console.log("DELETED:" + selectedmarkers);
  }
  else {//payment!=null
    for (var i = 0; i < selectedmarkers.length; i++) {
      if (selectedmarkers[i].payment != payment) {
        selectedmarkers[i].setMap(null);
        selectedmarkers.splice(i, 1);
      }
    }
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