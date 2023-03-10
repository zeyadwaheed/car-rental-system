<?php
//include auth_session.php file on all user panel pages
include("auth_admin.php");
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
        <p>You are in admin dashboard page.</p>
        <p><a href="search.php">Search for cars</a></p>
        <p><a href="myreservations.php">My reservations</a></p>
        <p><a href="logout.php">Logout</a></p>
        <hr><h4>Admin Panel</h4>
        <p><a href="reservations.php">All reservations</a></p>
        <p><a href="mycars.php">My cars</a></p>
        <p><a href="adv_search.php">Advanced Search</a></p>
        <p><a href="adminreport.php">My Reports</a></p>
    </div>
</body>
</html>
