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
    $startdate = $_POST['startdate'];
    $startdate = date("Y-m-d",strtotime($enddate));
    $enddate = $_POST['startdate'];
    $enddate = date("Y-m-d",strtotime($enddate));
    $type = $_POST['facility'];

    echo "<div id='reservationdetails'>
                <p>Facility: " .$type. "</p>
                <p>Start Date: " .$startdate. "</p>
                <p>End Date: " .$type. "</p>
            </div>";


    if (isset($_POST['enddate']) && $_POST['enddate'] == 'yes'){

    }
    ?>
</div>
</body>
</html>