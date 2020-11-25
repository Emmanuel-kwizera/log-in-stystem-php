<?php
session_start();
unset($_SESSION['FAMILYNAME']);
unset($_SESSION['FIRSTNAME']);
unset($_SESSION['EMAIL']);
header("location: ./");
exit();
?>