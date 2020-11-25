<?php
session_start();
echo "<h1>Dashboard</h1>";
echo "Welcome ".$_SESSION["FIRSTNAME"];
if($_SESSION['LEVELS'] == 1)
    echo "You are a user at this system.";
elseif($_SESSION['LEVELS'] == 2)
    echo "Welcome admin";
    echo "<meta http-equiv='refresh' content='0;URL= adminDash.php' />";
echo "<hr>";
echo "<a href='logout.php'>Logout</a>";
?>