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

            $startdate = $_POST['startdate'];
            $startdate = date("d-m-Y",strtotime($startdate));
            $facility = $_POST['facility'];




            if (isset($_POST['enddate']) && $_POST['enddate'] == 'yes'){

                $_SESSION['startdate'] = $startdate;
                $_SESSION['facility'] = $facility;

                echo "<div id='reservationdetails'>
                <label>Facility: " .$type. "</label><br><br><br>
                <label>Start Date: " .$startdate. "</label><br><br><br>
                </div>";

                echo "<form method='post' action='reservationcheck.php'>"."
                <label>Meeting Date : </label>
                <input id='enddate' name='enddate' type='date' value='2016-07-02'/><br><br>
                <input type='submit' value='submit'/><br><br>
                </form>";
            }else{
                $_SESSION['startdate'] = $startdate;
                $_SESSION['facility'] = $facility;
                header('Location: reservationcheck.php');
            }

        ?>
    </div>
</body>
</html>