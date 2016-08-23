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
            <li><a href='contactus.php'>Contact Us</a></li>
        </ul>
    </nav>
</header>
<div id="system">
    <main class="grid-container">
        <div id="screen" class="grid-container">
            <table id="bookingdetails" class="grid-container">
                <tr>
                    <td id="o">Customer Name: </td>
                    <td id="o"><?php echo $firstname . " " . $lastname; ?></td>
                </tr>
                <tr id="ref">
                    <td>Booking Reference Number:</td>
                    <td><?php echo $reference ?></td>
                </tr>
                <tr>
                    <td>Booking Date(s): </td>
                    <?php
                    if($enddate == $startdate){
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
                        foreach ($bookedfacilities as $showfacility) {
                            echo $showfacility ."<br>";
                        }
                        ?>
                    </td>
                    <td>  <?php
                        foreach ($bookedfacilities as $showcost) {
                            $checkcost = $showcost;
                            $getfacilities = "SELECT * FROM samphire_facilities WHERE f_name = '$checkcost'";
                            $result = mysqli_query($db, $getfacilities);
                            $cost = mysqli_fetch_array($result);
                            echo "£".$cost['cost'] . "<br>";
                        }
                        ?>
                    </td>
                </tr><br><br>
                <tr id="pind">
                    <td>Total: </td>
                    <td><?php
                        $totalcost = 0;
                        foreach ($bookedfacilities as $showcost) {
                            $getfacilities = "SELECT * FROM samphire_facilities WHERE f_name = '$showcost'";
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
    </main>
</div>
</body>
</html>