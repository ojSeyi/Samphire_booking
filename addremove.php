<?php
session_start();
include ("db_connection.php");
/**
 * Created by PhpStorm.
 * User: OJ Pumping
 * Date: 19/08/2016
 * Time: 19:29
 */

//remove facility
$k = 0;
if(isset($_POST['removefacility'])){
    $facilityname = $_POST['facilities'];
    foreach ($facilityname as $showfacility) {
        if ($showfacility = $_POST['removefacility']){
            $k = 1;
        }else{}
    }
    if($k == 1){
        $facilityname = array_diff($facilityname,[$_POST['removefacility']]);
        $facilityname = array_values($facilityname);
        $d = $_POST['removefacility'];
        $r = $_POST['confirmation'];
        $deleterecord = "DELETE FROM samphire_facilities WHERE f_name = '$d' AND reference = '$confirmation'";
        $_SESSION['facilities'] = $facilityname;
        header('location: editbooking.php');
    }

}
$l = 0;
if(isset($_POST['removefacility2'])){
    $facilityname = $_POST['facilities'];
    foreach ($facilityname as $showfacility) {
        if ($showfacility = $_POST['removefacility2']){
            $l = 1;
        }else{}
    }
    if($l != 1){
        $facilityname[] = $_POST['removefacility2'];
        $d = $_POST['removefacility2'];
        $r = $_POST['confirmation'];
        $addrecord = "INSERT INTO samphire_facilities (reference, f_id, cust_id, startdate, enddate, price) VALUES ('$bookingconfirmationnumber', '$rows', '$custid', '$startdate', '$enddate', '$totalcost')";
        $_SESSION['facilities'] = $facilityname;
        header('location: editbooking.php');

    }

}

?>