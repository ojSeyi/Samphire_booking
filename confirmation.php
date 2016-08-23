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
            <li><a href='logmanagebooking.php'>Manage Booking</a></li>
            <li><a href='viewhistory.php'>View Past Bookings</a></li>
            <li><a href='contactus.php'>Contact Us</a></li>
        </ul>
    </nav>
</header>
<?php
$startdate = date("Y-m-d",strtotime($_SESSION['start']));
if(!is_null($_SESSION['end'])){
    $enddate =  date("Y-m-d",strtotime($_SESSION['end']));
}else{
    $enddate = $startdate;
    $enddate =  date("Y-m-d",strtotime($enddate));
}
$confirmationnumber = $_SESSION['confirmationa'];
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$facilities = $_SESSION['facilityarrayss'];
$facilitycost = array();
foreach ($facilities as $showcost) {
    $checkcost = $showcost;
    $getfacilities = "SELECT * FROM samphire_facilities WHERE f_name = '$checkcost'";
    $result = mysqli_query($db, $getfacilities);
    $cost = mysqli_fetch_array($result);
    $costs = $cost['cost'];
    $facilitycost[] = $costs;
}
$facilitycosts = $facilitycost;
$_SESSION['facilitycosts'] = $facilitycosts;

$totalcosts = 0;
foreach ($facilities as $showcost) {
    $checkcost = $showcost;
    $getfacilities = "SELECT * FROM samphire_facilities WHERE f_name = '$checkcost'";
    $result = mysqli_query($db, $getfacilities);
    $cost = mysqli_fetch_array($result);
    $totalcosts = $totalcosts + $cost['cost'];
}
$totalcost = $totalcosts;
$_SESSION['total'] = $totalcost;

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
                        <td>Your Booking has been created and an email of your booking details has been sent to your email.</td>
                    </tr>
                    <tr>
                        <td>Booking Reference Number:  <h3><?php echo $confirmationnumber ?></h3></td>
                        <td></td>
                    </tr><br><br>
                    <tr>
                        <td><label>Click this link view, print and save your invoice</label></td>
                    </tr>
                    <tr>
                        <td>
                            <form method="post" action="invoice.php">
                                <input type="hidden" name="firstname" value="<?php $_SESSION['firstname']?>">
                                <input type="hidden" name="firstname" value="<?php $_SESSION['lastname']?>">
                                <input type="hidden" name="firstname" value="<?php $_SESSION['confirmationa']?>">
                                <input type="hidden" name="firstname" value="<?php $_SESSION['facilityarrayss']?>">
                                <input type="hidden" name="firstname" value="<?php $_SESSION['facilitycosts']?>">
                                <input type="hidden" name="firstname" value="<?php $_SESSION['total']?>">
                                <input type="hidden" name="firstname" value="<?php $_SESSION['start']?>">
                                <input type="hidden" name="firstname" value="<?php $_SESSION['end']?>">
                                <input type="submit" name="invoice" value="Print Invoice">
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

    </main>
</div>

</body>
</html>