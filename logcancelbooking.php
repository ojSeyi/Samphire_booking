<?php
session_start();
include ("db_connection.php");
if(is_null($_SESSION['firstname'])){
    header('Location: index.php');
};
if(empty($_POST['iliya'])) {
    header('location: loglocatebooking.php');
}else {$proceed = 1;}

$confirmation = $_SESSION['confirmatio'];
$deleterecord = "DELETE FROM customer_bookings WHERE reference = '$confirmation'";
$go = mysqli_query($db, $deleterecord);

$_SESSION['confirmatio'] = null;
$_SESSION['firstnam'] = null;
$_SESSION['lastnam'] = null;
$_SESSION['cusi'] = null;
$_SESSION['facilitynam'] = null;
$_SESSION['facilitycost'] = null;
$_SESSION['startdat'] = null;
$_SESSION['enddat'] = null;

header('location: index.php');