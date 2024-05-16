<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Location Finder</title>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
  }

  .container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  h1 {
    text-align: center;
    color: #333;
  }

  #map {
    height: 400px;
    margin-bottom: 20px;
    border-radius: 8px;
    overflow: hidden;
  }

  .form-group {
    margin-bottom: 20px;
  }

  label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #333;
  }

  input[type="text"] {
    width: calc(100% - 22px);
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
  }

  button {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 16px;
  }

  button:hover {
    background-color: #0056b3;
  }

  .submitted-coordinates {
    margin-top: 20px;
  }

  .loc{
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 16px;
  }

  .loc:hover {
    background-color: #0056b3;
  }
</style>
</head>
<body>
<div class="container">
  <h1>Location Finder</h1>
  <div id="map"></div>
  <button id="fetch-location">Get Current Location</button>
  <form id="location-form">
    <div class="form-group">
      <label for="latitude">Latitude:</label>
      <input type="text" id="latitude" name="latitude" placeholder="Enter latitude">
    </div>
    <div class="form-group">
      <label for="longitude">Longitude:</label>
      <input type="text" id="longitude" name="longitude" placeholder="Enter longitude">
    </div>
    <div class="form-group">
      <label for="destination">Destination:</label>
      <input type="text" id="destination" name="destination" placeholder="Enter destination">
    </div>
    <button type="submit">Find Location</button>
  </form>
  <div class="submitted-coordinates" id="submitted-coordinates"></div>

  <form method="post" action="location.php" >

    <input type="Submit" value="See the image path" id="submit" class="loc" />
</form>

</div>

<script>
  function initMap() {
    var mapDiv = document.getElementById('map');
    var japanLocation = { lat: 36.2048, lng: 138.2529 };
    var map = new google.maps.Map(mapDiv, {
      center: japanLocation,
      zoom: 6
    });

    document.getElementById('fetch-location').addEventListener('click', function() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
          var pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          };
          map.setCenter(pos);
          var marker = new google.maps.Marker({
            position: pos,
            map: map,
            title: 'Your Location'
          });
          document.getElementById('latitude').value = pos.lat;
          document.getElementById('longitude').value = pos.lng;
        });
      }
    });
  }

  document.getElementById('location-form').addEventListener('submit', function(event) {
    event.preventDefault();
    var latitude = document.getElementById('latitude').value;
    var longitude = document.getElementById('longitude').value;
    var destination = document.getElementById('destination').value;
    if (latitude && longitude) {
      var mapDiv = document.getElementById('map');
      var pos = { lat: parseFloat(latitude), lng: parseFloat(longitude) };
      var map = new google.maps.Map(mapDiv, {
        center: pos,
        zoom: 14
      });
      var marker = new google.maps.Marker({
        position: pos,
        map: map,
        title: 'Submitted Location'
      });
      document.getElementById('submitted-coordinates').innerHTML = '<p>Submitted Coordinates:</p><p>Latitude: ' + latitude + '</p><p>Longitude: ' + longitude + '</p>';
      if (destination) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
          if (this.readyState === 4 && this.status === 200) {
            var response = JSON.parse(this.responseText);
            if (response.length > 0) {
              var destPos = { lat: parseFloat(response[0].lat), lng: parseFloat(response[0].lon) };
              var destMarker = new google.maps.Marker({
                position: destPos,
                map: map,
                title: 'Destination'
              });
              var bounds = new google.maps.LatLngBounds();
              bounds.extend(pos);
              bounds.extend(destPos);
              map.fitBounds(bounds);
              var directionsService = new google.maps.DirectionsService();
              var directionsDisplay = new google.maps.DirectionsRenderer();
              directionsDisplay.setMap(map);
              var request = {
                origin: pos,
                destination: destPos,
                travelMode: 'DRIVING'
              };
              directionsService.route(request, function(response, status) {
                if (status === 'OK') {
                  directionsDisplay.setDirections(response);
                } else {
                  window.alert('Directions request failed due to ' + status);
                }
              });
            } else {
              window.alert('No results found for the destination.');
            }
          }
        };
        xhr.open('GET', 'https://nominatim.openstreetmap.org/search?format=json&q=' + destination, true);
        xhr.send();
      }
    } else {
      alert('Please enter both latitude and longitude coordinates.');
    }
  });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7YDuC4G_lzpLILAaJsGNZLP1vRPuyUoU&callback=initMap" async defer></script>
</body>
</html>
