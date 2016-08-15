<?php
session_start();
if(is_null($_POST['bounce'])){
    header('location: bookstate.php');
};

$newfacility = $_POST['facilityarray'];
$facilityarray = $_SESSION['facilityarray'];
if(count($facilityarray) <= 3) {

    if (isset($facilityarray[0])) {

    } else {
        $firstfacility = $_POST['firstfacility'];
        $facilityarray[0] = $firstfacility;
    }

    $addfacility;

    foreach ($facilityarray as $checkfacility) {
        if ($checkfacility == $_POST['facilityarray']) {
            $_SESSION['facilityarray'] = $facilityarray;
            $_SESSION['facilityarraycheck'] = 1;
            header('location: bookstate2.php');

        } else {
            $addfacility = 1;
            $facilityarray[] = $newfacility;
            $_SESSION['facilityarray'] = $facilityarray;
            $_SESSION['facilityarraycheck'] = 1;
            header('location: bookstate2.php');
        }
    }

