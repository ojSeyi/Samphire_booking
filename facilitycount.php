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
    $a = 1;
    $k = 0;
    foreach ($facilityarray as $checkfacility) {
        if ($checkfacility == $_POST['facilityarray']) {

            $addfacility = 0;
            $k = $a++;
        } else {

            if($k > $a){
                $addfacility = 4;
            }else{
            $addfacility = 1;
            }


        }
    }

    if ($addfacility == 1) {
        $facilityarray[] = $newfacility;
        $_SESSION['facilityarray'] = $facilityarray;
    } else {
        $_SESSION['facilityarray'] = $facilityarray;
    }

}

$_SESSION['facilityarraycheck'] = 1;
header('location: bookstate2.php');