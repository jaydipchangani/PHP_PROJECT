<?php
    $lat=0.0;
    $lon=0.0;
        $conn=mysqli_connect('localhost','root','','test1');

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if(isset($_POST['submit']))
            {
                $lat=$_POST['lat'];
                $lon=$_POST['lon'];
                $filename = $_FILES['uploadfile']['name'];
                $tempname = $_FILES['uploadfile']['tmp_name'];
                $folder = "./image/" . $filename;

                $sql = "INSERT INTO images (lat,lon,image) VALUES ('$lat','$lon','$filename')";

                mysqli_query($conn, $sql);

                if($sql){
                    echo "Photo Uploaded";
                }
                else{
                    echo "Not uploaded Try Again !!";
                }
 
            }

        
            if($lat==1.2 && $lon==1.2)
            {
                $fetch='SELECT image FROM images WHERE lat=1.2 AND lon=1.2';

                mysqli_query($conn, $fetch);
                

            }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Image to Database</title>
</head>
<body>

<center><div>
  <div >
    <img style="height:100px;" alt="GUNI LOGO"src="./logo.png"/>
  </div>

  <div >
    <h1>Campus Navigation</h1>
  </div>
</div>
<hr>
    <form action="" method="post" enctype="multipart/form-data" style="margin: 50px; font-size: 24px ;">

        <table cellspacing="10" style=" ">

            <tr>
                <td><labe>Photo ID</labe></td>
                <td><input type="text"  name="pid" placeholder="Enter Photo ID" id="pid" required></td>
            </tr>
            
            <tr>
                <td><labe>Latitude</labe></td>
                <td><input type="number" step="0.000001" name="lat" placeholder="Enter Latitude" id="latitude" required></td>
            </tr>
            
            <tr>
                <td><labe>Longitude</labe></td>
                <td><input type="number" step="0.000001" name="lon" placeholder="Enter Longitude" id="longitude" required></td>
            </tr>
            

            <tr>
                <td><labe>Upload Photo</labe></td