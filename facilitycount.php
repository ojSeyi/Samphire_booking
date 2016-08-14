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

while ($facilityarra == $facilityarray) {
    if($facilityarra == $_POST['facilityarray']){

        $_SESSION['notaddfacility'] = 1;

    }else{
        $facilityarray = $facilityarra;
        $_SESSION['facilityarray'] = $facilityarra;

    }
}
$_SESSION['facilityarraycheck'] = 1;
header('location: bookstate2.php');