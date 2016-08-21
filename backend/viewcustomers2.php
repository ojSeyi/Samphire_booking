<?php
session_start();
include ('db_connection.php');
if(is_null($_SESSION['admin'])){
    header('location: adminlogin.php');
}

$emailsarray = $_SESSION['emailarray'];
$firstnamearray = $_SESSION['firstnamearray'];
$lastnamearray = $_SESSION['lastnamearray'];
$usernamearray = $_SESSION['usernamearray'];
$passwordarray = $_SESSION['passwordarray'];
$mobilearray = $_SESSION['mobilearray'];
$addressarray = $_SESSION['addressarray'];

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
                <?php
                    echo "
                        <table id='bookingdetails' class='grid-container'>
                        <tr>
                        <td>
                                Username:
                            <br>
                        </td>
                        <td>
                            ";$i = 0;
                foreach ($usernamearray as $firstname) {
                    echo $firstname;
                    $i++;
                } echo"<br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                                Password:
                            <br>
                        </td>
                        <td>
                            "; $j = 0;
                foreach ($passwordarray as $firstname) {
                    echo $firstname;
                    $j++;
                } echo"<br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                                First name:
                            <br>
                        </td>
                        <td>
                            "; $k = 0;
                foreach ($firstnamearray as $firstname) {
                    echo $firstname;
                    $k++;
                } echo"<br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                                Last name:
                            <br>
                        </td>
                        <td>
                            "; $l = 0;
                foreach ($lastnamearray as $firstname) {
                    echo $firstname;
                    $l++;
                } echo"<br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                                Email:
                            <br>
                        </td>
                        <td>
                            "; $m = 0;
                foreach ($emailsarray as $firstname) {
                    echo $firstname;
                    $m++;
                } echo"<br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                                Mobile number:
                            <br>
                        </td>
                        <td>
                            "; $n = 0;
                foreach ($mobilearray as $firstname) {
                    echo $firstname;
                    $n++;
                } echo"<br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                                Address:
                            <br>
                        </td>
                        <td>
                            "; $o = 0;
                foreach ($addressarray as $firstname) {
                    echo $firstname;
                    $o++;
                } echo"<br>
                        </td>
                    </tr>
                    </table><br><br>";
                ?>

            </div>

        </div>
    </section>
</main>






</body>
</html>
