<?php
session_start();
include ("db_connection.php");
if(is_null($_SESSION['firstname'])){
    header('Location: index.php');
};
if(is_null($_SESSION['facilitynam'])) {
    header('location: loglocatebooking.php');
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

$confirmation = $_SESSION['confirmatio'];
$firstname = $_SESSION['firstnam'];
$lastname = $_SESSION['lastnam'];
$cusid = $_SESSION['cusi'];
$facilitycosts = $_SESSION['facilitycost'];
$startdate = $_SESSION['startdat'];
$enddate = $_SESSION['enddat'];

$facilityname = $_SESSION['facilitynam'];

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
                            foreach ($facilityname as $showcost) {
                                $checkcost = $showcost;
                                $getfacilities = "SELECT * FROM samphire_facilities WHERE f_name = '$checkcost'";
                                $result = mysqli_query($db, $getfacilities);
                                $cost = mysqli_fetch_array($result);
                                echo "£" . $cost['cost'] . "<br>";
                            }
                            ?>
                        </td>
                    </tr><br><br>
                    <tr id="pind">
                        <td>Total: </td>
                        <td><?php
                            $totalcost = 0;
                            foreach ($facilityname as $showcost) {
                                $checkcost = $showcost;
                                $getfacilities = "SELECT * FROM samphire_facilities WHERE f_name = '$checkcost'";
                                $result = mysqli_query($db, $getfacilities);
                                $cost = mysqli_fetch_array($result);
                                $totalcost = $totalcost + $cost['cost'];
                            }
                            echo "£".$totalcost;
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <?php

        ?>
        <div>

            <label>To remove facility, select facility and click remove</label><br>
            <?php $facilities = $_SESSION['facilitynam'];?>
            <form method="post" action="logaddremove.php">
                <select name="rfacility" id="facilityarray" size="1" required>
                    <?php
                    foreach ($facilities as $showfacilityy) {
                        echo "<option>".$showfacilityy ."</option>";
                    }
                    ?>
                </select>
                <input type="hidden" name="iliya" value="iliya">
                <input type="submit" name="removefacilityy" value="Remove">
            </form><br><br><br>


            <div id="line"></div>


            <label>To add facility, select facility and click add</label><br>
            <?php $facilities = $_SESSION['facilitynam'];?>
            <form method="post" action="logaddremove.php">
                <select name="afacility" id="facilityarray" size="1" required>
                    <?php
                    $getfacilities = "SELECT * FROM samphire_facilities";
                    $result = mysqli_query($db, $getfacilities);
                    foreach ($facilities as $showfacilityy) {
                        while ($row = mysqli_fetch_array($result)) {

                            if ($row['f_name'] == $showfacilityy) {

                            } else {
                                echo "<option>" . $row['f_name'] . "</option>";
                            }
                        }
                    }

                    ?>
                </select>
                <input type="hidden" name="iliya" value="iliya">
                <input type="submit" name="removefacility2" value="Add">
            </form>
            <br><br>
            <div id="bookcancel" class="grid-container">
                <form method="post" action="logcancelbooking.php">
                    <input type="hidden" name="confirmation" value="<?php $_SESSION['confirmatio']  ?>">
                    <input type="submit" name="removefacility2" value="Cancel">
                </form>
            </div>
        </div>
    </main>
</div>
<footer>
    <div id="base"><p>&#169; Oluwaseyi Jason Nojimu-Yusuf, 2016</p></div>
</footer>
</body>
</html>