<?php
if(empty($_POST['iliya'])) {
    header('location: editbookings.php');
}else {$proceed = 1;}
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
if(isset($_POST['facility'])){
    $l = 0;
    $facilityname = $_SESSION['bookedfacilities'];
    foreach ($facilityname as $showfacility) {
        if ($showfacility == $_POST['rfacility']){
            $l = 1;
        }else{}
    }
    if($l == 1){
        $facilityname = array_diff($facilityname,[$_POST['rfacility']]);
        $facilityname = array_values($facilityname);
        $d = $_POST['rfacility'];
        $confirmation = $_POST['confirmation'];
        $confirmation = stripcslashes($confirmation);
        $confirmation = mysqli_real_escape_string($db, $confirmation);
        $getidcommand = "SELECT * FROM samphire_facilities WHERE f_name = '$d'";
        $fetchid = mysqli_query($db, $getidcommand);
        $id = mysqli_fetch_array($fetchid);
        $idd = $id['f_id'];
        $deleterecord = "DELETE FROM customer_bookings WHERE f_id = '$idd' AND reference = '$confirmation'";
        $go = mysqli_query($db, $deleterecord);
        $_SESSION['bookedfacilities'] = $facilityname;
        header('location: editbookings.php');
    }else{
        header('location: editbookings.php');
    }

}elseif(isset($_POST['afacility'])){
    $l = 0;
    $facilityname = $_SESSION['bookedfacilities'];
    foreach ($facilityname as $showfacility) {
        if ($showfacility == $_POST['afacility']){
            $l = 1;
        }else{}
    }
    if($l != 1){

        $facilityname[] = $_POST['afacility'];
        $confirmation = $_POST['confirmation'];
        $confirmation = stripcslashes($confirmation);
        $confirmation = mysqli_real_escape_string($db, $confirmation);
        $firstname = $_SESSION['firstname'];
        $lastname = $_SESSION['lastname'];
        $cusid = $_SESSION['cusid'];
        $facilitycosts = $_SESSION['facilitycost'];
        $startdate = $_SESSION['startdate'];
        $enddate = $_SESSION['enddate'];
        $d = $_POST['afacility'];
        $totalcost = 0;
        foreach ($facilityname as $showcost) {
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
            header('location: changebookings.php');
        }
        $addrecord = "INSERT INTO customer_bookings (reference, f_id, cust_id, startdate, enddate, price) VALUES ('$confirmation', '$rows', '$cusid', '$startdate', '$enddate', '$totalcost')";
        $go = mysqli_query($db, $addrecord);
        $_SESSION['bookedfacilities'] = $facilityname;
        header('location: editbookings.php');

    }

}else{
    header('location: editbookings.php');
}
