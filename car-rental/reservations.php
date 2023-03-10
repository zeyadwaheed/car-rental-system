<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Reservations</title>
    <link rel="stylesheet" href="style.css"/>
    <script>
    function confirm_cancel()
    {
    if(window.confirm("Are you sure you want to cancel your reservation?"))
    return true;
    else
    return false;
    }
    function confirm_pay()
    {
    if(window.confirm("Are you sure you want to pay for your reservation?"))
    return true;
    else
    return false;
    }
    </script>
</head>
<body>
<?php
    require('db.php');
    require('auth_admin.php');
    $query = "SELECT * FROM `reservation` NATURAL JOIN `car` NATURAL JOIN `city` NATURAL JOIN `car_brand` NATURAL JOIN `user`";
    $result = mysqli_query($con, $query) or die(mysql_error());
    $rows = mysqli_num_rows($result);
    echo "<div class='form'><p style='text-align:right'><a href='admindashboard.php'>Back to Dashboard</a></p><h2>All Reservations</h2>";
    if($rows)
    {
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<p id='res_" . $row['reservation_id']."'>
                        Brand: " . $row['brand_name'] . "<br /> Model: " . $row['model'] . "<br /> Year: " . $row['year'] . "<br /> Pickup Date: " . $row['pickup_date'] . "<br /> Return Date: " . $row['return_date'] . "<br /> Location: " . $row["city_name"] . "<br /> Total Price: " . $row["total_price"] . "<br /> User Name: " . $row['first_name'] . " " . $row['last_name'] . "<br/>";
                        if(!$row['status'])
                        echo "<span style='color:red'>Cancelled</span><br/>";
                        if (!$row['is_paid'])
                        echo "<span style='color:red'>Unpaid</span>";
                        else
                        echo "<span style='color:green'>Paid</span>";
                echo "<hr/>";
            }
    }
    echo "</div>";
    ?>
    </body>
    </html>