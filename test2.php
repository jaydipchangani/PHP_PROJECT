<?php
require_once 'ip2location.class.php';

// Get the user's IP address
$user_ip = $_SERVER['REMOTE_ADDR'];

// Initialize the IP2Location object
$ip2location = new IP2Location();

// Get the user's location
$location = $ip2location->getLatitudeLongitude($user_ip);

// Get the latitude and longitude
$latitude = $location['latitude'];
$longitude = $location['longitude'];

// Display the latitude and longitude
echo "Latitude: $latitude, Longitude: $longitude";
?>