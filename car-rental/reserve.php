<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Reserve Car</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    require('db.php');
    require('auth_session.php');
    $row;
    $data;
    if (!isset($_POST['confirm_res']))
    {
    if (isset($_GET['id']))
    {
        $query = "SELECT * FROM `car` NATURAL JOIN `city` NATURAL JOIN `car_brand` WHERE plate_id =" . $_GET['id'] ;
        $result = mysqli_query($con, $query) or die(mysql_error());
        $row = mysqli_fetch_array($result);
        if($row)
    {   
        echo "<div class='form'><p style='text-align:right'><a href='index.php'>Back to Dashboard</a></p><h2>Reserve Car</h2> <p id='car_" . $row['plate_id']."'> Brand: " . $row['brand_name'] . "<br /> Model: " . $row['model'] . "<br /> Year: " . $row['year'] . "<br /> Active: " . $row['active'] . "<br /> Price per day: " . $row["price_per_day"] . "<br /> Location: " . $row["city_name"] . "</p>";
        echo "<form method='post' name='reserve'>
            Start date <input type= 'date' id='start_date' name= 'start_date' min= " . date('y-m-d') .  " onchange='saveValue(this);' required /> <br/>
            End date <input type= 'date' id='end_date' name= 'end_date' min= " . date('y-m-d') .  " onchange='saveValue(this);' required /> " .
            "<br /><input type='submit' value='Check availability' name='submit' class='login-button'/>
            </form> </div>";
    }

    if(isset($_POST['start_date']))
    {
        $data['start_date'] = date_create($_POST['start_date']);
        $data['end_date'] = date_create($_POST['end_date']);
        if ($data['start_date']->format('Y-m-d') < date('Y-m-d'))
        {
            echo "<div class='form'>
        <h3>Pickup date can't be in the past!</h3>
        </div>";
        }
        else if ($data['start_date'] > $data['end_date'])
        {
            echo "<div class='form'>
            <h3>Return date can't be before Pickup date!</h3>
            </div>";
        }
        else if ($data['end_date']->format('Y-m-d') < date('Y-m-d'))
        {
            echo "<div class='form'>
        <h3>Return date can't be in the past!</h3>
        </div>";
        }
        else
        {
        $days = date_diff($data['end_date'], $data['start_date'])->format('%d');
        $query2 = "SELECT MIN(CASE WHEN (CAST('". $_POST['start_date'] . "' AS DATE) BETWEEN pickup_date AND return_date) OR (CAST('" . $_POST['end_date'] . "' AS DATE) BETWEEN pickup_date AND return_date)
        THEN '0' ELSE '1' END) as is_available
         FROM
        ( SELECT pickup_date, return_date FROM `reservation` WHERE plate_id = '" . $row['plate_id'] . "' AND status='1') s ";
        //echo $query2;
        $result2 = mysqli_query($con, $query2) or die(mysql_error());
        $row2 = mysqli_fetch_array($result2);

        if (!isset($row2['is_available']) ||$row2['is_available'])
        {
            $total_price = $row['price_per_day'] * $days;
            echo "<div class='form'>
        <h3>Time available</h3>
        Total price: $" . $total_price . 
        "<form method='post' name='reservation_confirm'>
        <input type='submit' id='confirm_res' name='confirm_res' value='Confirm Reservation' class='login-button'/>" .
        "<input type='hidden' name='plate_id' value='". $_GET['id'] . "'/>" .
        "<input type='hidden' name='start_date' value='". $data['start_date']->format('Y-m-d') . "'/>" .
        "<input type='hidden' name='end_date' value='". $data['end_date']->format('Y-m-d') . "'/>" .
        "<input type='hidden' name='city_id' value='". $row['city_id'] . "'/>" .
        "<input type='hidden' name='total_price' value='". $total_price . "'/>" .
        "</form>" ."</div>";
        }
        else
        echo "<div class='form'>
        <h3>Time unavailable</h3>
        </div>";
    }
        
    }
}
    }
    else
    {
        $query3="INSERT into `reservation` (user_id,plate_id,pickup_date,return_date,city_id,total_price) 
                VALUES ('". $_SESSION['id'] ."','" . $_POST['plate_id'] . "','" . $_POST['start_date'] . "','" . $_POST['end_date'] . "','" . $_POST['city_id'] . "','" . $_POST['total_price'] ."')";
        //echo $query3;
        $result3 = mysqli_query($con, $query3) or die(mysql_error());
        if ($result3)
        {
        echo "<div class='form'><h3>Reserved successfully!</h3>
        <a href='reserve.php?id=". $_POST['plate_id'] ."'>Return</a><br/>
        <a href='myreservations.php'>My Reservations</a></div>";
        }
        empty($_POST['confirm_res']);

    }
?>