<?php
session_start();

if(is_null($_POST['newfacility'])){
    header('location: bookstate.php');
}


$newfacility = $_POST['newfacility'];
$facilityarray = array();
foreach($facilityarray as $count){
    if($count = $_POST['newfacility']){
        header('location: bookstate.php');
    }else{
        if(is_null($facilityarray[0])){
            $facilityarray[0] = $_SESSION['facili'];
            header('location: bookstate.php');
        }else {
            $facilityarray[] = $newfacility;
            $_SESSION['facilityarray'] = $facilityarray;
            header('location: bookstate.php');
        }
    }
}


