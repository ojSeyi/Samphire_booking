<?php
session_start();
include ('db_connection.php');
if(is_null($_SESSION['admin'])){
    header('location: adminlogin.php');
}

$emailsarray = $_SESSION['emailarray'];
$firstnamearray = $_SESSION['firstnamearray'];
$lastnamearray = $_SESSION['lastnamearray'];
$usernamearray = $_SESSION['usernamearray'];
$passwordarray = $_SESSION['passwordarray'];
$mobilearray = $_SESSION['mobilearray'];
$addressarray = $_SESSION['addressarray'];

?>