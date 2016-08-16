<?php include ("db_connection.php");
session_start();

    function generateRandomString($length = 8) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
    }

    $bookingconfirmationnumber = generateRandomString();

    $availables = "SELECT * FROM guest_bookings WHERE reference = '$bookingconfirmationnumber'";
    $resultsavailables = mysqli_query($db, $availables) or die("failed");
    if(mysqli_num_rows($resultsavailables) > 0){
        header('location: createbooking.php');
    }else{

    }

    $facilities = $_SESSION['facilityarray'];
    $startdate = date("Y-m-d",strtotime($_SESSION['start']));
    if(!is_null($_SESSION['end'])){
        $enddate =  date("Y-m-d",strtotime($_SESSION['end']));
    }else{
        $enddate = $startdate;
    }

    $userfullname = $_SESSION['userfullname'];
    $custid = $userfullname['cust_id'];

    $totalcost = 0;
    foreach ($facilities as $savecost) {
        $checkcost = $savecostcost;
        $getfacilities = "SELECT * FROM samphire_facilities WHERE f_name = '$checkcost'";
        $result = mysqli_query($db, $getfacilities);
        $cost = mysqli_fetch_array($result);
        $totalcost = $totalcost + $cost['cost'];
    }
    $cost = $totalcost;


foreach($facilities as $facility) {
    $fac = "SELECT * FROM samphire_facilities WHERE f_name = '$facility'";
    $result = mysqli_query($db, $fac);
    $rows = 0;
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $rows = $row['f_id'];
    }else{
        header('location: index1.php');
    }
    $insertrecord = "Insert Into customer_bookings (reference, f_id, cust_id, startdate, enddate, price) VALUES ('$bookingconfirmationnumber', '$rows', '$custid', '$startdate', '$enddate', '$cost')";

}


























?>

