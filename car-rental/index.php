<?php
session_start();
if (isset($_SESSION['id']) && $_SESSION['is_admin'] == 0)
header ("Location: userdashboard.php");
else if (isset($_SESSION['id']) && $_SESSION['is_admin'] == 1)
header ("Location: admindashboard.php");
else
header("Location: login.php");
?>
