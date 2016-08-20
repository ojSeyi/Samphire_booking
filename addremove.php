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
if(isset($_POST['removefacilityy'])){
    $facilityname = $_SESSION['facilitynam'];
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
        $go = mysqli_query($db, $deleterecord);
        $_SESSION['facilitynam'] = $facilityname;
        header('location: editbooking.php');
    }

}else{
    header('location: editbooking.php');
}
$l = 0;
if(isset($_POST['removefacility2'])){
    $facilityname = $_SESSION['facilitynam'];
    foreach ($facilityname as $showfacility) {
        if ($showfacility = $_POST['removefacility2']){
            $l = 1;
        }else{}
    }
    if($l != 1){

        $facilityname[] = $_POST['removefacility2'];
        $confirmation = $_POST['confirmation'];
        $firstname = $_POST['confirmation'];
        $lastname = $_POST['lastname'];
        $cusid = $_POST['cusid'];
        $facilityname = $_SESSION['facilitynam'];
        $facilitycosts = $_POST['facilitycosts'];
        $startdate = $_POST['startdate'];
        $enddate = $_POST['enddate'];
        $d = $_POST['removefacility2'];
        $totalcost = 0;
        foreach ($facilities as $showcost) {
            $checkcost = $showcost;
            $getfacilities = "SELECT * FROM samphire_facilities WHERE f_name = '$checkcost'";
            $result = mysqli_query($db, $getfacilities);
            $cost = mysqli_fetch_array($result);
            $totalcost = $totalcost + $cost['cost'];
        }
        echo $totalcost;
        $fac = "SELECT * FROM samphire_facilities WHERE f_name = '$d'";
        $result = mysqli_query($db, $fac);
        $rows = 0;
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $rows = $row['f_id'];
        }else{
            header('location: index1.php');
        }
        $addrecord = "INSERT INTO samphire_facilities (reference, f_id, cust_id, startdate, enddate, price) VALUES ('$confirmation', '$rows', '$cusid', '$startdate', '$enddate', '$totalcost')";
        $go = mysqli_query($db, $addrecord);
        $_SESSION['facilitynam'] = $facilityname;
        header('location: editbooking.php');

    }

}else{
    header('location: editbooking.php');
}

?>