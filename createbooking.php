<?php

include ("db_connection.php");
session_start();

    function generateRandomString($length = 8) {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
    }

    $bookingconfirmationnumber = generateRandomString();
    echo $bookingconfirmationnumber;

    $availables = "SELECT * FROM guest_bookings WHERE reference = '$bookingconfirmationnumber'";
    $resultsavailables = mysqli_query($db, $availables) or die("failed");
    if(mysqli_num_rows($resultsavailables) > 0){
        header('location: createbooking.php');
    }else{

    }

    $facilities = $_SESSION['facilityarray'];
    $startdate = date("Y-m-d",strtotime($_SESSION['start']));
    echo $startdate;
    if(!is_null($_SESSION['end'])){
        $enddate =  date("Y-m-d",strtotime($_SESSION['end']));
    }else{
        $enddate = $startdate;
        $enddate =  date("Y-m-d",strtotime($enddate));
        echo $enddate;
    }

    $custid = $_SESSION['custid'];
    echo $custid;

$totalcost = 0;
foreach ($facilities as $showcost) {
    $checkcost = $showcost;
    $getfacilities = "SELECT * FROM samphire_facilities WHERE f_name = '$checkcost'";
    $result = mysqli_query($db, $getfacilities);
    $cost = mysqli_fetch_array($result);
    $totalcost = $totalcost + $cost['cost'];
}
echo $totalcost;


$addcount = 0;
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
    echo $rows;
    $insertrecord = "INSERT INTO customer_bookings (reference, f_id, cust_id, startdate, enddate, price) VALUES ('$bookingconfirmationnumber', '$rows', '$custid', '$startdate', '$enddate', '$totalcost')";
    $go = mysqli_query($db, $insertrecord);
    $addcount++;
}

if($addcount == count($facilities)){
    $SUCCESS = 1;
}else{}


//email subject
$subject = "Friendship Link has been created for you!";


//email body in html
//ATTENTION, THE LINK MAY POINT TO THE MASTER DOMAIN, RATHER THAN YOUR OWN xxx.PHP
$txt = "Dear $name,
					<br><br>
					Thank you for being a part of International Students Friendship Link
					<br>
					You have a match on the friendship link program.
					<br>
					This match was made based on your preferences at sign-up:
					<br>
					Gender prefrence: $gender
					Interested Nationality to host: $nation
					Hobbies: $hobbies

					<br><br>
					Please contact Kathrine on kathrine@friendsUk.com for more infomation on the student selected.
					<br><br>
					King Regards,
					<br><br>
					The Friendship link";

//take in the necessary swiftmailer code
require_once 'swiftmailer/lib/swift_required.php';

$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465,'ssl')->setUsername('ukpehmfon@gmail.com')->setPassword('seveneleven711');

$mailer = Swift_Mailer::newInstance($transport);
$message = Swift_Message::newInstance('FriendshipLink: student matched')
    ->setFrom(array('ukpehmfon@gmail.com' => 'Friendship link'))
    ->setTo(array($h_email => $h_email))
    ->setBody($txt, 'text/html');
$mailer->send($message);





?>

