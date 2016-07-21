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
    $type = $_SESSION['facility'];

    echo "<div id='reservationdetails'>
                <h6>Facility: " .$type. "</h6>
                <h6>Start Date: " .$startdate. "</h6>
                <h6>End Date: " .$enddate. "</h6>
            </div>";



    ?>
</div>
</body>
</html>