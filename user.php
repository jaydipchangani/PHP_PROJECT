<!DOCTYPE html>
<html>
<head>
  <title>Campus Visit Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    form {
      max-width: 500px;
      margin: 40px auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    label {
      display: block;
      margin-bottom: 10px;
    }
    input, textarea {
      width: 95%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
    }
    input[type="submit"] {
      background-color: #4CAF50;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background-color: #3e8e41;
    }
  </style>
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

  <h1>Campus Visit Form</h1></center>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="mobile_number">Mobile Number:</label>
    <input type="tel" id="mobile_number" name="mobile_number" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="reason_to_visit">Reason to Visit Campus:</label><br>
    <textarea id="reason_to_visit" name="reason_to_visit" rows="4" cols="50" required></textarea><br><br>

    <input type="submit" value="Submit" name="submit">
  </form>

<?php
if(isset($_POST['submit'])){
    // Database configuration
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "user";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        echo "Connected to database successfully";
    }

    // Fetching form data
    $name = $_POST['name'];
    $mobile_number = $_POST['mobile_number'];
    $email = $_POST['email'];
    $reason_to_visit = $_POST['reason_to_visit'];

    // Insert data into the database
    $sql = "INSERT INTO udata (name, mobile, email, reason) VALUES ('$name', '$mobile_number', '$email', '$reason_to_visit')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();

    // Redirect to get_location.php
    header("Location: get_location.php");
    exit;
}
?>
</body>
</html>