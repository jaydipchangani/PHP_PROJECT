<?php

$submitted_username = "";
$submitted_password ="";


$valid_username = "admin";
$valid_password = "admin";




if(isset($_POST['submit']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username === $valid_username && $password === $valid_password) {

        header("Location: test.php");
    } else {
    
        echo "Invalid username or password.";
    }
}

?>



<html lang="en">
<head>
    <title>Admin Login</title>
    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
       .container {
            max-width: 300px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
       .form-group {
            margin-bottom: 20px;
        }
       .form-control {
            width: 100%;
            height: 40px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
        }
       .btn {
            width: 100%;
            height: 40px;
            padding: 10px;
            font-size: 16px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
       .btn:hover {
            background-color: #3e8e41;
        }
    </style>
</head>
<body>
<center>
<div>
  <div >
    <img style="height:100px;" alt="GUNI LOGO"src="./logo.png"/>
  </div>
<hr>
</center>

    <div class="container">
        <h2>Admin Login</h2>

        <form method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Enter username">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name ="password" class="form-control" placeholder="Enter password">
            </div>
            <input class="btn" type="submit" value="Log in" name="submit">

        </form>
    </div>
</body>
</html>

