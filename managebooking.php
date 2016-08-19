<?php

include ("db_connection.php");


$lastname = $_POST['lastname'];
$confirmation = $_POST['confirmation'];
echo $lastname;
$lastname = stripcslashes($lastname);
$confirmation = stripcslashes($confirmation);
$lastname = mysqli_real_escape_string($db, $lastname);
$confirmation = mysqli_real_escape_string($db,$confirmation);
$firstname = "";
$custid = "";


$getfacilitycommand = "SELECT f_id FROM samphire_facilities";
$fetchfacilities = mysqli_query($db, $getfacilitycommand);
$f_idarray = Array();
if(!$fetchfacilities){
    echo "nigga i aint working";
}
while ($row = mysqli_fetch_array($fetchfacilities, MYSQLI_ASSOC)) {
    $f_idarray[] =  $row;
}
foreach($f_idarray as $p){
    echo $p;
}

$facilities = array();
foreach($f_idarray as $facili){
    $bookingcommand = "SELECT * FROM customer_bookings WHERE f_id = '$facili' AND reference = '$confirmation'";
    $fetchbookings = mysqli_query($db, $bookingcommand);
    if(mysqli_num_rows($fetchbookings) > 0){
        $facilities[] = $facili;
    }else{

    }

}
$getdatescommand = "SELECT startdate, enddate FROM customer_bookings WHERE f_id = '$facilities[0]' AND reference = '$confirmation'";
$fetchdates = mysqli_query($db, $getdatescommand);
$dates = mysqli_fetch_array($fetchdates);
$startdate = $dates['startdate'];
$enddate = $dates['enddate'];

$facilitycosts = array();
foreach ($facilities as $showcost) {
    $checkcost = $showcost;
    $getfacilities = "SELECT * FROM samphire_facilities WHERE f_name = '$checkcost'";
    $result = mysqli_query($db, $getfacilities);
    $cost = mysqli_fetch_array($result);
    $costs = $cost['cost'];
    $facilitycosts[] = $costs;
}

echo $lastname ;
echo $confirmation;
echo $firstname;
echo $custid;
echo $facilities[0];
echo $startdate;
echo $enddate;
echo $facilitycosts[0];

?>