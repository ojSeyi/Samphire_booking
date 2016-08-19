<?php

include ("db_connection.php");


$lastname = $_POST['lastname'];
$confirmation = $_POST['confirmation'];
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
    $f_idarray[] =  $row['f_id'];
}


$facilities = array();
foreach($f_idarray as $facili){
    $bookingcommand = "SELECT * FROM customer_bookings WHERE f_id = '$facili' AND reference = '$confirmation'";
    $stmt = mysqli_prepare($db, "SELECT * FROM customer_bookings WHERE f_id = ? AND reference = ?");
    mysqli_stmt_bind_param($stmt, 'ss', $facili, $confirmation);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $ross);
    while(mysqli_stmt_fetch($stmt)){
        $facilities[] =  $ross['f_id'];
    }
    mysqli_stmt_close($stmt);
    mysqli_close($db);

}

foreach($facilities as $f){
    echo $f;
}

$getdatescommand = "SELECT startdate, enddate FROM customer_bookings WHERE f_id = '$facilities[0]' AND reference = '$confirmation'";
$fetchdates = mysqli_query($db, $getdatescommand);
$dates = mysqli_fetch_array($fetchdates);
$startdate = $dates['startdate'];
$enddate = $dates['enddate'];

$facilitycosts = array();
$facilityname = array();
foreach ($facilities as $showcost) {
    $checkcost = $showcost;
    $getcosts = "SELECT * FROM samphire_facilities WHERE f_id = '$checkcost'";
    $result = mysqli_query($db, $getcosts);
    $cost = mysqli_fetch_array($result);
    $costs = $cost['cost'];
    $name = $cost['f_name'];
    $facilitycosts[] = $costs;
    $facilityname[] = $name;
}


echo $lastname ;
echo $confirmation;
echo $firstname;
echo $custid;
echo $facilityname[0];
echo $startdate;
echo $enddate;
echo $facilitycosts[0];

?>