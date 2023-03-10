<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>My Cars</title>
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
    $query = "SELECT * FROM `car` NATURAL JOIN `city` NATURAL JOIN `car_brand`";
    //echo $query;
    $result = mysqli_query($con, $query) or die(mysql_error());
    $rows = mysqli_num_rows($result);
    echo "<div class='form'><p style='text-align:right'><a href='index.php'>Back to Dashboard</a></p><h2>My Cars</h2><a href='addcar.php'>Add a new car</a><br><br>";
    if($rows)
    {
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<p id='res_" . $row['plate_id']."'>
                        Brand: " . $row['brand_name'] . "<br /> Model: " . $row['model'] . "<br /> Year: " . $row['year'] . "<br /> Location: " . $row["city_name"] .  "<br /> Price per day: " . $row["price_per_day"] . "<br />";
                        
                        if ($row['active']=='1')
                        echo "<span style='color:green'>Active</span>";
                        else
                        echo "<span style='color:red'>Inactive</span>";
                echo "<br /><a href='editcar.php?id=" . $row["plate_id"] . "'>Edit</a>";
                echo "</p> <hr>";
            }
    }
    echo "</div>";
    ?>
    </body>
    </html>