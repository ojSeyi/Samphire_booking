<?php
session_start();
if(is_null($_SESSION['admin'])){
    header('location: adminlogin.php');
}
$k = 0;
$confirmation = "";
if(isset($_POST['confirmation'])){
    $confirmation = $_POST['confirmation'];
    $deleterecord = "DELETE FROM customer_bookings WHERE reference = '$confirmation'";
    $go = mysqli_query($db, $deleterecord);
    if($go){
        $k = 1;
    }
    $_SESSION['confirmation'] = null;
}else{
    $confirmation = $_SESSION['confirmation'];
    $deleterecord = "DELETE FROM customer_bookings WHERE reference = '$confirmation'";
    $go = mysqli_query($db, $deleterecord);
    if($go){
        $k = 1;
    }
    $_SESSION['confirmation'] = null;

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
                        echo "<caption>The is the booking cancellation page</caption>
                    <tr></tr>
                    <tr></tr>
                    <tr>
                        <th>
                            The booking with reference ".$confirmation." has been cancelled and all recorde deleted.
                        </th>

                    </tr>";
                        $confirmation = null;
                    }else {
                        echo
                        "<caption>The is the booking cancellation page</caption>
                    <tr></tr>
                    <tr></tr>
                    <tr>
                        <th>
                            All cancelled bookings can never be retrieved
                        </th>

                    </tr>";
                    }
                    ?>
                </table>
            </div>
            <div id="search">
                <table>
                    <form method="post" action="cancelbookings.php">
                        <tr>
                            <td><label>Enter reference number: </label></td>
                            <td><input type="text" name="confirmation" required><br></td>
                            <td><input type="submit" value="search"><br></td>
                        </tr>
                    </form>
                </table>
            </div>
        </div>
    </section>
</main>




</body>
</html>