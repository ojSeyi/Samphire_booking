<!DOCTYPE html>
<html lang="en">
<?php include ("db_connection.php"); ?>
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
<div id="syscon">

    <?php
    session_start();

        $startdate = date("d-m-Y",strtotime($_SESSION['startdate']));
        $enddate = $_POST['enddate'];
        $enddate = date("d-m-Y",strtotime($enddate));
        $facility = $_SESSION['facility'];

        if(isset($enddate)) {
            echo "<div id='reservationdetails'>
                <label>Facility: " . $facility . "</label><br><br><br>
                <label>Start Date: " . $startdate . "</label><br><br><br>
                <label>End Date: " . $enddate . "</label><br><br><br>
            </div>";
        }else{
            echo "<div id='reservationdetails'>
                <label>Facility: " . $facility . "</label><br><br><br>
                <label>Start Date: " . $startdate . "</label><br><br><br>
            </div>";
        }
    ?>

</div>
</body>
</html>