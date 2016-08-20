<?php
session_start();
include ("db_connection.php");
if(is_null($_SESSION['firstname'])){
    header('Location: index.php');
};
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
            <li><a href='locatebooking.php'>Manage Booking</a></li>
            <li><a href='contactus.php'>Contact Us</a></li>
            <li><a href='registration.php'>Register</a></li>
        </ul>
    </nav>
</header>


<div id="system">
    <main class="grid-container">

        <div id="syscon">
            <form method="post" action="logmanagebooking.php">
                <table>
                    <caption>Please enter your valid booking reference and your last name below</caption>
                    <tr>
                        <td>
                            Reference: <input type="text" name="confirmation" required>
                        </td>
                        <td>
                            Last name: <input type="text" name="lastname" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="Find">
                        </td>
                    </tr>
                </table>
            </form>

        </div>

    </main>
</div>

</body>
</html>