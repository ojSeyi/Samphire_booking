<?php
if(empty($_POST['confirmation']) || empty($_POST['lastname'])) {
    echo "Enter Reference number and lastname";
}else {$proceed = 1;}
?>
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


$lastname = $_POST['lastname'];
$confirmation = $_POST['confirmation'];
$lastname = stripcslashes($lastname);
$confirmation = stripcslashes($confirmation);
$lastname = mysqli_real_escape_string($db, $lastname);
$confirmation = mysqli_real_escape_string($db,$confirmation);
$_SESSION['lastnam'] = $lastname;
$_SESSION['confirmatio'] = $confirmation;

$getfacilitycommand = "SELECT f_id FROM samphire_facilities";
$fetchfacilities = mysqli_query($db, $getfacilitycommand);
$f_idarray = Array();
if(!$fetchfacilities){
    echo "nigga i aint working";
}
while ($row = mysqli_fetch_array($fetchfacilities, MYSQLI_ASSOC)) {
    $f_idarray[] =  $row['f_id'];
}


$facilities = array();
foreach($f_idarray as $facili){
    $bookingcommand = "SELECT * FROM customer_bookings WHERE f_id = '$facili' AND reference = '$confirmation'";
    $fetchbookings = mysqli_query($db, $bookingcommand);
    if(mysqli_num_rows($fetchbookings) > 0){
        while ($ross = mysqli_fetch_array($fetchbookings, MYSQLI_ASSOC)) {
            $facilities[] =  $ross['f_id'];
        }
    }else{

    }
}


$getdatescommand = "SELECT startdate, enddate FROM customer_bookings WHERE f_id = '$facilities[0]' AND reference = '$confirmation'";
$fetchdates = mysqli_query($db, $getdatescommand);
$dates = mysqli_fetch_array($fetchdates);
$startdate = $dates['startdate'];
$enddate = $dates['enddate'];
$_SESSION['startdat'] = $startdate;
$_SESSION['enddat'] = $enddate;


$getidcommand = "SELECT * FROM customer_bookings WHERE reference = '$confirmation' AND f_id = '$facilities[0]'";
$fetchid = mysqli_query($db, $getidcommand);
$id = mysqli_fetch_array($fetchid);
$cusid = $id['cust_id'];
$_SESSION['cusi'] = $cusid;

$getfirstname = "SELECT firstname FROM customers WHERE cust_id = '$cusid'";
$fetchfirstname = mysqli_query($db, $getfirstname) or die('shit aint work');
$first = mysqli_fetch_array($fetchfirstname);
$firstname = $first['firstname'];
$_SESSION['firstnam'] = $firstname;

$facilitycosts = array();
$facilityname = array();
foreach ($facilities as $showcost) {
    $checkcost = $showcost;
    $getcosts = "SELECT * FROM samphire_facilities WHERE f_id = '$checkcost'";
    $result = mysqli_query($db, $getcosts);
    $cost = mysqli_fetch_array($result);
    $costs = $cost['cost'];
    $name = $cost['f_name'];
    $facilitycosts[] = $costs;
    $facilityname[] = $name;
}
$_SESSION['facilitynam'] = $facilityname;
$_SESSION['facilitycost'] = $facilitycosts;


?>

<div id="system">
    <main class="grid-container">

        <div id="syscon">
            <div id="bookingconfirmation">
                <table id="bookingdetails" class="grid-container">
                    <caption id="tablehead"> Here are the details of your booking </caption>
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
                            foreach ($facilityname as $showfacility) {
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



            <form method="post" action="editbooking.php">
                <input type="hidden" name="flow" value="flow">
                <input type="hidden" name="firstname" value="<?php $_SESSION['firstnam'] ?>">
                <input type="hidden" name="lastname" value="<?php $_SESSION['lastnam']  ?>">
                <input type="hidden" name="confirmation" value="<?php $_SESSION['confirmatio']  ?>">
                <input type="hidden" name="startdate" value="<?php $_SESSION['startdat'] ?>">
                <input type="hidden" name="enddate" value="<?php $_SESSION['enddat'] ?>">
                <input type="hidden" name="custid" value="<?php $_SESSION['cusi'] ?>">
                <input type="hidden" name="facilities" value="<?php $_SESSION['facilitynam']  ?>">
                <input type="hidden" name="facilitycosts" value="<?php $_SESSION['facilitycost'] ?>">
                <input type="submit" name="removefacility" value="Edit">
            </form>
            <br><br><br>


            <form method="post" action="cancelbooking.php">
                <input type="hidden" name="iliya" value="iliya">
                <input type="hidden" name="firstname" value="<?php $_SESSION['firstnam'] ?>">
                <input type="hidden" name="lastname" value="<?php $_SESSION['lastnam']  ?>">
                <input type="hidden" name="confirmation" value="<?php $_SESSION['confirmatio']  ?>">
                <input type="hidden" name="startdate" value="<?php $_SESSION['startdat'] ?>">
                <input type="hidden" name="enddate" value="<?php $_SESSION['enddat'] ?>">
                <input type="hidden" name="custid" value="<?php $_SESSION['cusi'] ?>">
                <input type="hidden" name="facilities" value="<?php $_SESSION['facilitynam']  ?>">
                <input type="hidden" name="facilitycosts" value="<?php $_SESSION['facilitycost'] ?>">
                <input type="submit" name="removefacility2" value="Cancel">
            </form>


    </main>
</div>

</body>
</html>