<!DOCTYPE html>
<html lang="en">
<?php include ("db_connection.php"); ?>
<?php
session_start();
if(is_null($_SESSION['firstname']) && is_null($_SESSION['facilityarraycheck'])){
    header('location: bookstate.php');
};
?>
<head>
    <meta charset="UTF-8">
    <title>Samphire-Subsea: Facility Reservation</title>
    <link rel="stylesheet" href="assets/stylesheet.css">
    <link rel="stylesheet" href="assets/unsemantic-grid-responsive-tablet.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <meta name="viewpoint"
          content="width=device-width,
          initial-scale=1,
          minimum-scale=1,
          maximum-scale=1"/>
</head>
<head>
    <meta charset="UTF-8">
    <title>Samphire Subsea Facilities Booking</title>
</head>
<body>
<header class="grid-container">
    <img src="assets/images/logo_2016.jpg" id="logo"/>
    <div id="log">
        <div id="logout">
            <form method="post" action="logout.php">
                <label><?php echo $_SESSION['firstname'];?></label>
                <input type="submit" name="logout" value="logout" id="logoutbutton"/>
            </form>
        </div>
        <div id="pagetitle"><h4>Samphire-Subsea</h4><p>Facilities Booking System</p></div>
    </div>
    <nav id="upnav" class="grid-container">
        <ul>
            <li><a href='index.php'>Create Booking</a></li>
            <li><a href='showbugs.php?bugcategory=android'>Manage Booking</a></li>
            <li><a href='showbugs.php?bugcategory=ios'>Contact Us</a></li>
        </ul>
    </nav>
</header>
<?php

$confirmationnumber = $_SESSION['confirmation'];
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$facilities = $_SESSION['facilityarray'];

//Functions for declaring cart items
function displayfacilities(){
    $facilities = $_SESSION['facilityarray'];
    return implode('<br>',$facilities);
}
function displayprices(){
    define('db_server', "us-cdbr-azure-southcentral-f.cloudapp.net");
    define('db_username', "b508b6e557b8b9");
    define('db_password', "23ad37fd");
    define('db_name', "samphire_subsea");

    $db = mysqli_connect(db_server, db_username, db_password, db_name);
    $facilities = $_SESSION['facilityarray'];
    $facilitycosts = array();
    foreach ($facilities as $showcost) {
        $checkcost = $showcost;
        $getfacilities = "SELECT * FROM samphire_facilities WHERE f_name = '$checkcost'";
        $result = mysqli_query($db, $getfacilities);
        $cost = mysqli_fetch_array($result);
        $costs = $cost['cost'];
        $facilitycosts[] = $costs;
    }
    return implode('<br>',$facilitycosts);
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

?>
<div id="system">
    <main class="grid-container">

        <div id="syscon">
            <div id="bookingconfirmation">
                <table id="confirmation" class="grid-container">
                    <caption><h1>Thank you for choosing Samphire-Subsea Facilities</h1></caption>
                    <tr>
                        <caption>Your Booking has been created and an email of your booking details has been sent to your email along with an invoice</caption>
                    </tr>
                    <tr>
                        <td>Booking Reference Number:</td>
                        <td><h3><?php $confirmationnumber ?></h3></td>
                    </tr><br><br>
                    <tr></tr>
                </table>
            </div>
        </div>

    </main>
</div>

</body>
</html>