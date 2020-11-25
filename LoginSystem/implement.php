<?php
session_start();
include_once("LoginSystem.php");
$obj=new LoginSystem();
if($_POST["action"]=="register"){
    $reg_date = date("Y-m-d H:i:s");
    $obj->registerUser($_POST["familyname"],$_POST["firstname"],$_POST["email"], $_POST["password"], $reg_date);
}
elseif($_POST["action"]=="login"){
    $obj->loginUser($_POST["email"], $_POST["password"]);
}else if($_POST["action"]=="read"){
    $obj->readData();
}elseif($_POST["action"]=="update"){
    $obj->updateAdmin($_POST['id'],$_POST['newLevel']);
}
?>