<?php
session_start();

if(is_null($_POST['newfacility'])){
    header('location: bookstate.php');
}


$newfacility = $_POST['newfacility'];

$facilityarray = array();
if(is_null($facilityarray[0])){
    $facilityarray[0] = $_SESSION['facili'];
}else {
    $facilityarray[] = $newfacility;
    $_SESSION['facilityarray'] = $facilityarray;
}