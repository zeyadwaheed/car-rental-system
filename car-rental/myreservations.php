<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>My Reservations</title>
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
    require('auth_session.php');
    $query = "SELECT * FROM `reservation` NATURAL JOIN `car` NATURAL JOIN `city` NATURAL JOIN `car_brand` WHERE user_id = '" . $_SESSION['id'] ."' ";
    //echo $query;
    $result = mysqli_query($con, $query) or die(mysql_error());
    $rows = mysqli_num_rows($result);
    echo "<div class='form'><p style='text-align:right'><a href='index.php'>Back to Dashboard</a></p><h2>My Reservations</h2>";
    if($rows)
    {
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<p id='res_" . $row['reservation_id']."'>
                        Brand: " . $row['brand_name'] . "<br /> Model: " . $row['model'] . "<br /> Year: " . $row['year'] . "<br /> Pickup Date: " . $row['pickup_date'] . "<br /> Return Date: " . $row['return_date'] . "<br />Location: " . $row["city_name"] .  "<br /> Total Price: " . $row["total_price"] . "<br />";
                        if ($row['status'])
                        {
                        if (!$row['is_paid'])
                        echo "<a href='pay_res.php?id=" . $row["reservation_id"] . "' onclick='return confirm_pay()'>Pay</a>";
                        else
                        echo "<span style='color:green'>Paid</span>";
                echo "<br /><a href='cancel_res.php?id=" . $row["reservation_id"] . "' onclick='return confirm_cancel()'>Cancel</a>";
                        }
                        else
                        echo "<span style='color:red'>Cancelled</span>";
                echo "</p> <hr>";
            }
    }
    echo "</div>";
    ?>
    </body>
    </html>