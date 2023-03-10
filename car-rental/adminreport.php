<?php
 //include auth_session.php file on all user panel pages
include("auth_admin.php");
require'db.php';
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Client area</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    
    <div class="form">
    <p style='text-align:right'><a href='index.php'>Back to Dashboard</a></p>
        <h3>My Reports</h3>
        <form  method="get" name="login">
        <input type="text"  name="user" placeholder="First Name,Last Name,User ID..."/>
        <input type="text"  name="car" placeholder="Car Brand,Car Model,Plate ID..."/>
        <input type="submit" value="search" name="submit"/>
        </form>
    </div>
</body>
</html>
<?php
if(isset($_GET['submit']))
{
    $user=$_GET['user'];
    $car=$_GET['car'];
    $query1="select * from reservation LEFT JOIN `car` on reservation.plate_id = `car`.plate_id JOIN car_brand on `car`.brand_id = car_brand.brand_id left join user on reservation.user_id=user.user_id";
    $query2="select count(*) as no_of_reservations , sum(total_price) as full_price from reservation LEFT JOIN `car` on reservation.plate_id = `car`.plate_id JOIN car_brand on `car`.brand_id = car_brand.brand_id left join user on reservation.user_id=user.user_id";
    if($user!='' || $car!='')
    {
        $query1 .=" where ";
        $query2 .=" where ";
    }
    if($user!='' && $car!='')
    {
        $query1 .="(first_name='$user' OR last_name='$user' OR email='$user') And (first_name='$user' OR last_name='$user' OR email='$user') AND (brand_name='$car' OR model='$car')";
        $query2 .="(first_name='$user' OR last_name='$user' OR email='$user') And (first_name='$user' OR last_name='$user' OR email='$user') AND (brand_name='$car' OR model='$car')";
    }
    if($user!='' && $car=='')
    {
        $query1 .="(first_name='$user' OR last_name='$user' OR email='$user') And (first_name='$user' OR last_name='$user' OR email='$user')";
        $query2 .="(first_name='$user' OR last_name='$user' OR email='$user') And (first_name='$user' OR last_name='$user' OR email='$user')";
    }
    if($user=='' && $car!='')
    {
       $query1 .="(brand_name='$car' OR model='$car')";
       $query2 .="(brand_name='$car' OR model='$car')";
    }
    //echo $query1 . "<br><br>";
    //echo $query2;
    $result1 = mysqli_query($con,$query1);
    $rows1=mysqli_num_rows($result1);   
    $result2 = mysqli_query($con,$query2);
    $rows2=mysqli_num_rows($result2);

    if ($rows1 > 0 && $rows2>0) 
    {
        echo"<div class='form' style='text-align:center' >";
        echo"<table>";
        echo"<tr>
        <td>ID</td>
        <td>First Name</td>
        <td>Last Name</td>
        <td>Brand</td>
        <td>Model</td>
        <td>Pickup Date</td>
        <td>Return Date</td>
        <td>Total Price</td>
        </tr>";
        //echo $query1 . "<br><br>";
        //echo $query2;
        // output data of each row
        while($row = mysqli_fetch_assoc($result1))
        {
            echo"<tr>";
            echo"<td>".$row["user_id"]."</td>";
            echo"<td>".$row["first_name"]."</td>";
            echo"<td>".$row["last_name"]."</td>";
            echo"<td>".$row["brand_name"]."</td>";
            echo"<td>".$row["model"]."</td>";
            echo"<td>".$row["pickup_date"]."</td>";
            echo"<td>".$row["return_date"]."</td>";
            echo"<td>".$row["total_price"]."</td>";
            echo"</tr>";
        }
        echo "</table>";
        echo"</br><hr>";
        echo"<table>";
        echo"<tr>
        <td>Number of Reservations</td>
        <td>Total price</td>
        </tr>";
        while($row1 = mysqli_fetch_assoc($result2))
        {
            echo"<tr>";
            echo"<td>".$row1["no_of_reservations"]."</td>";
            echo"<td>".$row1["full_price"]."</td>";
            echo"</tr>";
        }
        echo"</table>";
        echo"</div>";
    }
    else
    {
        echo"<p> No Data Found </p>";
    }
}
?>