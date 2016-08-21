<?php
session_start();
if(is_null($_SESSION['admin'])){
    header('location: adminlogin.php');
}


?>
<!DOCTYPE html>
<html lang="en">
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
<body>
<header>
    <img src="assets/images/logo_2016.jpg" id="logo"/>
    <div id="log">
        <div id="logout">
            <form method="post" action="adminlogout.php">
                <label><?php echo $_SESSION['firstname'];?></label>
                <input type="submit" name="logout" value="logout" id="logoutbutton"/>
            </form>
        </div>
        <div id="pagetitle"><h4>Samphire-Subsea</h4><p>Facilities Booking System - Administrator</p></div>
</header>

<main>
    <nav class="grid-30">
        <ul>
            <li><a href='viewbookings.php'>View Bookings</a></li>
            <li><a href='changebookings.php'>Change Bookings</a></li>
            <li><a href='cancelbookings.php'>Cancel Bookings</a></li>
            <li><a href='refreshsystem.php'>Refresh System</a></li>
            <li><a href='viewcustomers.php'>View Customers</a></li>
        </ul>
    </nav>
    <section class="grid-70">
        <div id="system" class="grid-container">
            <div id="screen" class="grid-container">
                <table id="intro">
                    <?php

                    if($k == 1){
                        echo "<caption>The is the system refresh page</caption>
                    <tr></tr>
                    <tr></tr>
                    <tr>
                        <th>
                            The system has been refreshed and records have been updated to resume with today.
                        </th>

                    </tr>";
                        $confirmation = null;
                    }else {
                        echo
                        "<caption>The is the system refresh page</caption>
                    <tr></tr>
                    <tr></tr>
                    <tr>
                        <th>
                            Please click refresh to update system!
                        </th><br><br>

                    </tr>";
                    }
                    ?>
                </table>
            </div><br>
            <div id="search">
                <table>
                    <form method="post" action="cancelbookings.php">
                        <tr>
                            <td><label>Enter reference number: </label></td>
                            <td><input type="text" name="confirmation" required><br></td>
                            <td><input type="submit" value="Cancel Booking"><br></td>
                        </tr>
                    </form>
                </table>
            </div>
        </div>
    </section>
</main>






</body>
</html>