<?php
  include('auth_admin.php');
?>
<html>
<head>
<meta charset="utf-8"/>
    <link rel="stylesheet" href="style.css"/>
    <script src="script.js"></script>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental";
$plate_id =  $_POST["plate_id"];
$brand =  $_POST["car-brand"];
$model =  $_POST["model"];
$year =  $_POST["year"];
if (isset($_POST['active']))
$active = '1';
else
$active = '0';
$price_per_day =  $_POST["price_per_day"];
$city_id =  $_POST["city"];


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Plate_id: $plate_id , brand: $brand , model = $model"; 
$result = $conn->query("SELECT * FROM car WHERE plate_id='$plate_id'");
if($result->num_rows == 0) {
   
     echo"this car doesnt exist";
} else {
  
       $sql = "UPDATE car SET brand_id = '$brand',model='$model',year='$year',active='$active',price_per_day='$price_per_day',city_id='$city_id'
WHERE plate_id='$plate_id' ";

if ($conn->query($sql) === TRUE) {
  echo "<div class='form'><h3>Car edited Successfully!</h3><span>Return to <a href='index.php'>dashboard</a></div>";

} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
   
}
   
    
    
    
}
$conn->close();
 //$sql = "UPDATE car ADD (brand,model,year,active,price_per_day,area_id)
//VALUES ( '$brand','$model','$year','$active','$price_per_day','$area_id') WHERE plate_id='$plate_id' ";
?>
</head>
</html>