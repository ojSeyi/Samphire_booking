<!DOCTYPE html>
<html lang="en">
<?php include ("db_connection.php"); ?>
<?php session_start();
if(is_null($_SESSION['firstname'])){
    header('Location: index.php');
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

<div id="system">
    <main class="grid-container">

        <div id="syscon">
            <div id="bookingconfirmation" class="grid-container">

                <?php

                $startdate = $_POST['startdate'];
                $startdate = date("Y-m-d",strtotime($startdate));
                $facility = $_SESSION['facility'];

                    $enddate = $_POST['enddate'];
                    $enddate = date("Y-m-d",strtotime($enddate));;
                    echo "<br><br><div id='reservationdetails'>
                <label>Facility: " . $facility . "</label><br><br><br>
                <label>Start Date: " . date("d-m-Y",strtotime($startdate)) . "</label><br><br><br>
                <label>Reservation End Date: " . date("d-m-Y",strtotime($enddate)) . "</label><br><br><br>
            </div>";
                    $_SESSION['enddates'] = $enddate;

                $_SESSION['startdates'] = $startdate;
                $_SESSION['facility'] = $facility;

                ?>


                <form action="usavachk.php" method="post">
                    <input type="submit" value="Check Availability"/>
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