<?php
session_start();
if($_SESSION["EMAIL"]!=""){
    echo "Welcome ".$_SESSION["FIRSTNAME"]."<br>";
    echo "Go to <a href='dashboard.php'>DashBoard</a>";
    echo "<hr>";
    echo "<a href='logout.php'>Logout</a>";
}else{
    echo "<a href='forms.php#login'>Login</a>";
}
?>