<?php
    session_start();
    if(!isset($_SESSION["id"])) {
        header("Location: login.php");
        exit();
    }
    else if ($_SESSION['is_admin'] == '0')
    {
        echo 'Unauthorized access!!';
        exit();
    }
?>
