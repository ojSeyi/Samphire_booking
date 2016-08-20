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
if(isset($_POST['rfacility'])){
    $facilityname = $_SESSION['facilitynam'];
    foreach ($facilityname as $showfacility) {
        if ($showfacility == $_POST['rfacility']){
            $k = 1;
        }else{
            $k = 0;
        }
    }
    if($k == 1){
        $facilityname = array_diff($facilityname,[$_POST['rfacility']]);
        $facilityname = array_values($facilityname);
        $d = $_POST['rfacility'];
        $r = $_SESSION['confirmatio'];
        $getidcommand = "SELECT * FROM samphire_facilities WHERE f_name = '$d'";
        $fetchid = mysqli_query($db, $getidcommand);
        $id = mysqli_fetch_array($fetchid);
        $cusid = $id['cust_id'];
        $deleterecord = "DELETE FROM customer_bookings WHERE f_id = '$cusid' AND reference = '$confirmation'";
        $go = mysqli_query($db, $deleterecord);
        $_SESSION['facilitynam'] = $facilityname;
        header('location: editbooking.php');
    }

}elseif(isset($_POST['afacility'])){
$l = 0;
    $facilityname = $_SESSION['facilitynam'];
    foreach ($facilityname as $showfacility) {
        if ($showfacility == $_POST['afacility']){
            $l = 1;
        }else{}
    }
    if($l != 1){

        $facilityname[] = $_POST['afacility'];
        $confirmation = $_SESSION['confirmation'];
        $firstname = $_SESSION['firstnam'];
        $lastname = $_SESSION['lastnam'];
        $cusid = $_SESSION['cusi'];
        $facilitycosts = $_SESSION['facilitycost'];
        $startdate = $_SESSION['startdat'];
        $enddate = $_SESSION['enddat'];
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