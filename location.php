<?php
// Define the next location image and map coordinates
$nextLocationImage = 'guni_main.jpg';
$mapLatitude = 37.7749;
$mapLongitude = -122.4194;
$mapZoom = 12;

// Create the HTML page
?>
<html>
  <head>
    <title>Next Location</title>
    <style>
      body {
        font-family: Arial, sans-serif;
      }
      #image-container img{
        float: left;
        height: 75%;
        width: 49%;
      }
      #map-container {
        float: right;
        width: 50%;
        height: 500px;
      }
    </style>
    <!-- Include Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  </head>
  <body>
    <div id="image-container">
      <img src="<?php echo $nextLocationImage; ?>" alt="Next Location Image">
    </div>
    <div id="map-container"></div>

    <!-- Include Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
      // Initialize the map
      var map = L.map('map-container').setView([<?php echo $mapLatitude; ?>, <?php echo $mapLongitude; ?>], <?php echo $mapZoom; ?>);
      
      // Add OpenStreetMap tile layer
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(map);

      // Get current location and display marker
      navigator.geolocation.getCurrentPosition(function(position) {
        var currentLat = position.coords.latitude;
        var currentLng = position.coords.longitude;
        var currentMarker = L.marker([currentLat, currentLng]).addTo(map);
        currentMarker.bindPopup("You are here").openPopup();
      });

      // Define destination coordinates
      var destinationLat = 37.7749; // Define your destination latitude here
      var destinationLng = -122.4194; // Define your destination longitude here

      // Add destination marker
      var destinationMarker = L.marker([destinationLat, destinationLng]).addTo(map);
      destinationMarker.bindPopup("Destination").openPopup();
    </script>
  </body>
</html>
