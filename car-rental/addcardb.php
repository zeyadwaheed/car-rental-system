<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Reserve Car</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
include('auth_admin.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental";
$plate_id =  $_POST["plate_id"];
$brand_id =  $_POST["car-brand"];
$model =  $_POST["model"];
$year =  $_POST["year"];
if (!isset($_POST['active']))
  $active = '0';
  else
$active =  '1';
$price_per_day =  $_POST["price_per_day"];
$city_id =  $_POST["city"];


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$result = $conn->query("SELECT * FROM car WHERE plate_id='$plate_id'");
if($result->num_rows == 0) {
    // row not found, do stuff...
     $sql = "INSERT INTO car (plate_id,brand_id,model,year,active,price_per_day,city_id)
VALUES ('$plate_id', '$brand_id','$model','$year','$active','$price_per_day','$city_id')";
//echo $sql;
if ($conn->query($sql) === TRUE) {
  echo "<div class='form'>
            <h3>Car added Successfully!</h3>
            <span><a href='addcar.php'>Add another car</a></span><br>
            <span>Return to <a href='index.php'>dasboard</a></span>
            </div>";
  
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
   
}
} else {
   // do other stuff...
   echo "<div class='form'>
   <h3>Car already exists!</h3>
   <span><a href='addcar.php'>Add a different car</a></span>
   </div>";
    
}
$conn->close();

?>
</body>
</html>