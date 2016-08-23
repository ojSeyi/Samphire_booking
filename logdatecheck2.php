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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
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
            $startdate = date("d-m-Y",strtotime($startdate));
            $facility = $_POST['facility'];
            $currentdate = date('d-m-Y');
            $currentnextdate = date('d-m-Y', ($currentdate + 1));



            if (isset($_POST['enddate']) && $_POST['enddate'] == 'yes'){

                $_SESSION['startdate'] = $startdate;
                $_SESSION['facility'] = $facility;

                echo "<div id='reservationdetails'>
                <label>Facility: " .$facility. "</label><br><br><br>
                <label>Start Date: " .$startdate. "</label><br><br><br>
                </div>";

                echo "<form method='post' action='logdatecheck.php'>" ."
                <label>Reservation End Date : </label>
                <input id='enddate' name='enddate' type='text' value='Click here to pick a date'/><br><br>
                <input type='submit' value='submit'/><br><br>
                <script src= 'https://code.jquery.com/jquery-1.12.4.js'></script>
                <script src= 'https://code.jquery.com/ui/1.12.0/jquery-ui.js'></script>
                <script type= 'text/javascript' src='JS/global.js'></script>
                </form>";
            }else{
                $_SESSION['startdate'] = $startdate;
                $_SESSION['facility'] = $facility;
                header('Location: logdatecheck.php');
            }

        ?>
        </div>
    </div>
</main>
</div>

</body>
</html>