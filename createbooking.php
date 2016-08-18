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


function displayprices(){
    define('db_server', "us-cdbr-azure-southcentral-f.cloudapp.net");
    define('db_username', "b508b6e557b8b9");
    define('db_password', "23ad37fd");
    define('db_name', "samphire_subsea");

    $db = mysqli_connect(db_server, db_username, db_password, db_name);
    $facilities = $_SESSION['facilityarray'];
    foreach ($facilities as $showcost) {
        $checkcost = $showcost;
        $getfacilities = "SELECT * FROM samphire_facilities WHERE f_name = '$checkcost'";
        $result = mysqli_query($db, $getfacilities);
        $cost = mysqli_fetch_array($result);
        return $cost['cost'] . "<br>";
    }
}

function total(){
    define('db_server', "us-cdbr-azure-southcentral-f.cloudapp.net");
    define('db_username', "b508b6e557b8b9");
    define('db_password', "23ad37fd");
    define('db_name', "samphire_subsea");

    $db = mysqli_connect(db_server, db_username, db_password, db_name);
    $facilities = $_SESSION['facilityarray'];
    $totalcost = 0;
    foreach ($facilities as $showcost) {
        $checkcost = $showcost;
        $getfacilities = "SELECT * FROM samphire_facilities WHERE f_name = '$checkcost'";
        $result = mysqli_query($db, $getfacilities);
        $cost = mysqli_fetch_array($result);
        $totalcost = $totalcost + $cost['cost'];
    }
    return $totalcost;
}

function displayfacilities(){
    $facilities = $_SESSION['facilityarray'];
    foreach ($facilities as $showfacility) {
        return $showfacility ."<br>";
    }
}


$custemail = $_SESSION['custemail'];
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
//email subject
$subject = "Confirmation Of Your Facility Reservation With Samphire Subsea";
//email body in html
//ATTENTION, THE LINK MAY POINT TO THE MASTER DOMAIN, RATHER THAN YOUR OWN xxx.PHP
$txt = "Dear $firstname,
					<br><br>
					Your booking has been created.
					<br>
					Here is your reference number: <h2> $bookingconfirmationnumber </h2>
					<br>
					Here are the details of your booking
					<br>
					<table>
					    <tr>
					        <th>Facility</th>
					        <th>Price</th><br>
                        </tr>
                        <tr>
                            <td>KGB</td>
                        </tr>
                        <tr>
                            <td>Total: </td>
                            <td>". $totalcost . "</td>
                        </tr>
                    </table>

					<br><br>
					Thank you for choosing Samphire-Subsea facilities!
					<br>
					Please contact the facilities department on nomail@samphire-subsea.com with any complaints or enquiries.
					<br><br>
					King Regards,
					<br><br>
					Samphire Subsea Facilities";

//take in the necessary swiftmailer code
require_once 'swiftmailer/lib/swift_required.php';

try{

$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465,'ssl')
    ->setUsername('ojtestall@gmail.com')
    ->setPassword('Oluwas3yi');

$mailer = Swift_Mailer::newInstance($transport);
$message = Swift_Message::newInstance();
    $message->setSubject("Samphire Subsea Facilities: Reservation");
    $message->setFrom(array('ojtestall@gmail.com' => 'Samphire Subsea Facilities'));
    $message->setTo('seyiyusuf100@gmail.com');
    $message->setBody($txt, ['text/html']);
$send = $mailer->send($message);

print_r($send);

}catch(Exception $e){
    echo $e;
    $e->getMessage();
}
?>

