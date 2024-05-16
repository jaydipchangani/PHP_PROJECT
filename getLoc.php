<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT image, id, path, lat, lon FROM udata";
$result =  mysqli_query($conn,$sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $photo = $row["image"];
        $areaName = $row["id"];
        $direction = $row["path"];
        $latitude = $row["lat"];
        $longitude = $row["lon"];
        
        echo "<div>";
        echo "<img src='$photo' alt='$areaName'>";
        echo "<p>$areaName</p>";
        echo "<p>$direction</p>";
        echo "<p>Coordinates: ($latitude, $longitude)</p>";
        echo "</div>";
    }
} else {
    echo "No results found";
}

echo "<script>";
echo "setInterval(fetchUserLocation, 3000);";
echo "function fetchUserLocation() {";
echo "// Code to fetch user's updated location using JavaScript and send it to the server for processing";
echo "}";
echo "</script>";

$conn->close();
?>