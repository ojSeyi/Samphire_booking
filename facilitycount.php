<?php
session_start();
if(is_null($_POST['bounce'])){
    header('location: bookstate.php');
};

$newfacility = $_POST['facilityarray'];
$facilityarray = $_SESSION['facilityarray'];
if(isset($facilityarray[0])){

}else {
    $firstfacility = $_POST['firstfacility'];
    $facilityarray[0] = $firstfacility;
}

$addfacility;

foreach ($facilityarray as $checkfacility) {
    if($checkfacility == $_POST['facilityarray']){

        $_SESSION['notaddfacility'] = 1;
        $addfacility = 0;

    }else{
        $addfacility = 1;

    }
}

if($addfacility == 1){
    $facilityarray[] = $newfacility;
    $_SESSION['facilityarray'] = $facilityarray;
}elseif($addfacility == 0){
    $_SESSION['facilityarray'] = $facilityarray;
}



$_SESSION['facilityarraycheck'] = 1;
header('location: bookstate2.php');