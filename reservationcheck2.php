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
            $startdate = date("Y-m-d",strtotime($startdate));
            $type = $_POST['facility'];




            if (isset($_POST['enddate']) && $_POST['enddate'] == 'yes'){
                echo "<div id='reservationdetails'>
                <p>Facility: " .$type. "</p>
                <p>Start Date: " .$startdate. "</p>
                </div>";
                echo "<form method='post' action='reservationcheck.php'>"."
                <label>Meeting Date : </label>
                <input id='enddate' type='date' value='2016-07-02'/><br><br>
                <input type='submit' value='submit'/><br><br>
                </form>";
            }else{
                echo "<form method='post' action='reservationcheck.php'>
                <input type='hidden' value=. $startdate . id='startdate' ./>
                <input type='hidden' value=. $type . id='facility'/>
                </form>";
            }

        ?>
    </div>
</body>
</html>