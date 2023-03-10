<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Cancel Reservation</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    require('db.php');
    require('auth_session.php');
    if (isset($_GET['id']))
    {
        $query = "UPDATE `reservation` SET is_paid = '1' WHERE reservation_id = '" . $_GET['id'] . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        if ($result)
        {
            echo "<div class='form'>
            <h3>Reservation paid successfully!</h3><br/>
            <p class='link'>Return to <a href='myreservations.php'>My Reservations</a></p>
            </div>";
        }
        else
        {
            echo "<div class='form'>
            <h3>Failed to pay for reservation</h3><br/>
            <p class='link'>Return to <a href='myreservations.php'>My Reservations</a></p>
            </div>";
        }
    }
?>
</body>
</html>