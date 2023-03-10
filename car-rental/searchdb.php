<?php
  include('auth_admin.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Advanced Search</title>
    <link rel="stylesheet" href="style.css"/>
    <script src="script.js"></script>
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental";
$selectedValue=$_POST['list'];
//mysqli_connect("localhost","root") or die("could not connect");
//mysql_select_db("car_rental") or die("could not find db");
$output = '';
// Create connection
$blela = new mysqli($servername, $username, $password, $dbname);
if ($blela->connect_error) {
    die("Connection failed: " . $blela->connect_error);
  }
  echo "<div class='form'> <p style='text-align:right'><a href='index.php'>Back to Dashboard</a></p>";
if($selectedValue=="car"){
    if(isset($_POST['search'])){
    $searchq = $_POST['search'];
    $query="SELECT * FROM car NATURAL JOIN car_brand JOIN reservation ON reservation.plate_id=car.plate_id JOIN user ON reservation.user_id=user.user_id JOIN city ON reservation.city_id=city.city_id JOIN country ON city.country_id=country.country_id WHERE  
    car.plate_id LIKE '%$searchq%' OR
     brand_name LIKE '%$searchq%' OR
    car.model LIKE '%$searchq%'OR
    car.year LIKE '%$searchq%' 
    ";
    //echo $query;
    $result = $blela->query($query);
     
     if($result->num_rows == 0){
        echo "Not Found";
     }else{
         while($row = $result->fetch_assoc()){
             echo "<p id='res_" . $row['reservation_id']."'>
                        Brand: " . $row['brand_name'] . "<br /> 
                        Model: " . $row['model'] . "<br /> 
                        Year: " . $row['year'] . "<br /> 
                        Pickup Date: " . $row['pickup_date'] . "<br /> 
                        Return Date: " . $row['return_date'] . "<br /> 
                        Location: " . $row["city_name"] . "<br /> 
                        Total Price: " . $row["total_price"] . "<br /> 
                        User ID =" . $row['user_id']. "<br/>
                        Name: " . $row['first_name'] . " " . $row['last_name'] . "<br/>
                        Email: " . $row['email']. "<br/>
                        Birth date: " . $row['birth_date']. "<br/>
                        ";
                        if(!$row['status'])
                        echo "<span style='color:red'>Cancelled</span><br/>";
                        else
                        echo "<span style='color:green'>Active</span><br/>";
                        if (!$row['is_paid'])
                        echo "<span style='color:red'>Unpaid</span>";
                        else
                        echo "<span style='color:green'>Paid</span>";
                echo "<hr/>";
         }
     }
     

}
} elseif ($selectedValue=="customer"){
    if(isset($_POST['search'])){
        $searchq = $_POST['search'];
        $query="SELECT * FROM car NATURAL JOIN car_brand JOIN reservation ON reservation.plate_id=car.plate_id JOIN user ON reservation.user_id=user.user_id JOIN city ON reservation.city_id=city.city_id JOIN country ON city.country_id=country.country_id WHERE  
         user.user_id LIKE '%$searchq%' OR
        user.first_name LIKE '%$searchq%' OR
         user.last_name LIKE '%$searchq%'OR
         user.email LIKE '%$searchq%' 
     ";
     $result = $blela->query($query);
     if($result->num_rows == 0){
        echo "Not Found";
         }else{
             while($row = $result->fetch_assoc()){
                echo "<p id='res_" . $row['reservation_id']."'>
                        Brand: " . $row['brand_name'] . "<br /> 
                        Model: " . $row['model'] . "<br /> 
                        Year: " . $row['year'] . "<br /> 
                        Pickup Date: " . $row['pickup_date'] . "<br /> 
                        Return Date: " . $row['return_date'] . "<br /> 
                        Location: " . $row["city_name"] . "<br /> 
                        Total Price: " . $row["total_price"] . "<br /> 
                        User ID =" . $row['user_id']. "<br/>
                        Name: " . $row['first_name'] . " " . $row['last_name'] . "<br/>
                        Email: " . $row['email']. "<br/>
                        Birth date: " . $row['birth_date']. "<br/>
                        ";
                        if(!$row['status'])
                        echo "<span style='color:red'>Cancelled</span><br/>";
                        else
                        echo "<span style='color:green'>Active</span><br/>";
                        if (!$row['is_paid'])
                        echo "<span style='color:red'>Unpaid</span>";
                        else
                        echo "<span style='color:green'>Paid</span>";
                echo "<hr/>";
             }
         }
         
    
    }


}elseif($selectedValue=="reservation"){
    if(isset($_POST['search'])){
        $searchq = $_POST['search'];
        $query="SELECT * FROM car NATURAL JOIN car_brand JOIN reservation ON reservation.plate_id=car.plate_id JOIN user ON reservation.user_id=user.user_id JOIN city ON reservation.city_id=city.city_id JOIN country ON city.country_id=country.country_id WHERE  
        reservation.reservation_id LIKE '%$searchq%' OR
         reservation.user_id LIKE '%$searchq%' OR
         reservation.plate_id LIKE '%$searchq%' OR
         reservation.pickup_date LIKE '%$searchq%' OR
         reservation.return_date LIKE '%$searchq%' OR
         city_name LIKE '%$searchq%' OR
         reservation.total_price LIKE '%$searchq%' 
        ";
        $result = $blela->query($query);
        if($result->num_rows == 0){
           echo "Not Found";
         }else{
             while($row = $result->fetch_assoc()){
                echo "<p id='res_" . $row['reservation_id']."'>
                        Brand: " . $row['brand_name'] . "<br /> 
                        Model: " . $row['model'] . "<br /> 
                        Year: " . $row['year'] . "<br /> 
                        Pickup Date: " . $row['pickup_date'] . "<br /> 
                        Return Date: " . $row['return_date'] . "<br /> 
                        Location: " . $row["city_name"] . "<br /> 
                        Total Price: " . $row["total_price"] . "<br /> 
                        User ID =" . $row['user_id']. "<br/>
                        Name: " . $row['first_name'] . " " . $row['last_name'] . "<br/>
                        Email: " . $row['email']. "<br/>
                        Birth date: " . $row['birth_date']. "<br/>
                        ";
                        if(!$row['status'])
                        echo "<span style='color:red'>Cancelled</span><br/>";
                        else
                        echo "<span style='color:green'>Active</span><br/>";
                        if (!$row['is_paid'])
                        echo "<span style='color:red'>Unpaid</span>";
                        else
                        echo "<span style='color:green'>Paid</span>";
                echo "<hr/>";
             }
         }
         
    
    }


}else{
    echo "please select criteria of search";
}
echo "</div>";
// print("$selectedValue");
?> 
</body>
</html>