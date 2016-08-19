<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Samphire-Subsea: Facility Reservation</title>
    <link rel="stylesheet" href="assets/stylesheet.css">
    <link rel="stylesheet" href="assets/unsemantic-grid-responsive-tablet.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
    <meta name="viewpoint"
          content="width=device-width,
          initial-scale=1,
          minimum-scale=1,
          maximum-scale=1"/>
</head>

<body>

<header class="grid-container">
    <img src="assets/images/logo_2016.jpg" id="logo"/>
    <div id="log">
        <div id="form">
            <form method="post" action="login.php">
                <input type="text" name="username" id="usernamebox" placeholder="Username" required/>
                <input type="password" name="password" id="passwordbox" placeholder="Password" required/>
                <input type="submit" value="Login" name="login" id="loginb"/>
            </form>
        </div>
        <div id="pagetitle"><h4>Samphire-Subsea</h4><p>Facilities Booking System</p></div>
    </div>
    <nav id="upnav" class="grid-container">
        <ul>
            <li><a href='index.php'>Create Booking</a></li>
            <li><a href='contactus.php'>Contact Us</a></li>
            <li><a href='registration.php'>Register</a></li>
        </ul>
    </nav>
</header>

<?php

include ("db_connection.php");

if(empty($_POST['confirmation']) || empty($_POST['lastname'])) {
    echo "Enter Reference number and lastname";
}else {$proceed = 1;}
    $lastname = $_POST['lastname'];
    $confirmation = $_POST['confirmation'];
    $lastname = stripcslashes($lastname);
    $confirmation = stripcslashes($confirmation);
    $lastname = mysqli_real_escape_string($db, $lastname);
    $confirmation = mysqli_real_escape_string($db,$confirmation);
    $firstname = "";
    $custid = "";
    $customer = "";

    if($customerid=$db->prepare("SELECT * FROM customers WHERE lastname =?")){
        $customerid ->bind_param('ss',$lastname);
        $customerid->execute();
        $customer = $customerid->get_result();
    }

    if(($cust = $customer->fetch_row())){
        $custid = $cust['cust_id'];
        $firstname = $cust['firstname'];
    }else{
        header('location: locatebooking.php?nocustomer=1');
    }

    $getfacilitycommand = "SELECT f_id FROM samphire_facilities";
    $fetchfacilities = mysqli_query($db, $getfacilitycommand);
    $f_idarray = mysqli_fetch_array($fetchfacilities);
    $facilities = array();
    foreach($f_idarray as $facili){
        $bookingcommand = "SELECT * FROM customer_bookings WHERE f_id = '$facili' AND reference = '$confirmation'";
        $fetchbookings = mysqli_query($db, $bookingcommand);
        if($fetchbookings > 0){
            $facility = mysqli_fetch_array($fetchbookings);
            foreach($facility as $bookedfacility){
                $facilities[] = $bookedfacility;
            }
        }else{
            header('location: locatebooking.php?norecord=1');
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


?>

<div id="system">
    <main class="grid-container">

        <div id="syscon">
            <div id="bookingconfirmation">
                <table id="bookingdetails" class="grid-container">
                    <tr>
                        <td id="tablehead"> Here are the details of your booking </td>
                    </tr>
                    <tr>
                        <td>Customer Name: </td>
                        <td><?php echo $firstname . " " . $lastname; ?></td>
                    </tr>
                    <tr>
                        <td>Booking Reference Number:</td>
                        <td><h3><?php echo $confirmation ?></h3></td>
                    </tr>
                    <tr>
                        <td>Booking Date(s): </td>
                        <?php
                        if(is_null($enddate)){
                            echo "<td>".$startdate."</td>";
                        }else{
                            echo "<td> From: ".$startdate." to: " . $enddate . "</td>";
                        }
                        ?>
                    </tr>
                    <tr id="pins">
                        <td>Facility(s)</td>
                        <td>Price(s)</td>
                    </tr>
                    <tr id="pin">
                        <td>
                            <?php
                            foreach ($facilities as $showfacility) {
                                echo $showfacility ."</br>";
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            foreach ($facilitycosts as $costs) {
                                echo $costs ."</br>";
                            }
                            ?>
                        </td>
                    </tr><br><br>
                    <tr id="pind">
                        <td>Total: </td>
                        <td><?php
                            $totalcost = 0;
                            foreach ($facilitycosts as $showcost) {
                                $totalcost = $totalcost + $showcost;
                            }
                            echo $totalcost;
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

    </main>
</div>

</body>
</html>