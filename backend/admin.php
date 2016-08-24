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
<body class="grid-container">
    <header>
        <img src="assets/images/logo_2016.jpg" id="logo"/>
        <div id="log">
            <div id="logout">
                <form method="post" action="adminlogout.php">
                    <label><?php echo $_SESSION['firstname']."  ";?></label>
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
                <li><a href='addremoveadmin.php'>Add/Remove Facility</a></li>
            </ul>
        </nav>
        <section class="grid-70">
            <div id="system" class="grid-container">
                <table id="intro">
                    <caption>Hello Welcome to admin...</caption>
                    <tr></tr>
                    <tr></tr>
                    <tr>
                        <th>
                            Select an activity from the sidebar on the left
                        </th>
                    </tr>
                </table>
            </div>
        </section>
    </main>


    <br>
    <footer>
        <div id="base"><p>&#169; Oluwaseyi Jason Nojimu-Yusuf, 2016</p></div>
    </footer>


</body>
</html>