<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Client area</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    
    <div class="form">
        <p>Hey, <?php echo $_SESSION['name']; ?>!</p>
        <p>You are in user dashboard page.</p>
        <p><a href="search.php">Search for cars</p>
        <p><a href="myreservations.php">My reservations</p>
        <p><a href="logout.php">Logout</a></p>
    </div>
</body>
</html>
