<?php
session_start();
if(is_null($_SESSION['admin'])){
    header('location: adminlogin.php');
}

if(isset($_POST['today'])){
    $k = 0;
    $today = $_POST['today'];
    $today = date("Y-m-d",strtotime($today));
    $refreshsystem = "DELETE FROM customer_bookings WHERE startdate < '$today'";
    $refresh = mysqli_query($db, $refreshsystem);
    if($refresh){
        $k = 1;
    }
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
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
                    <form method="post" onload="getDate()" action="refreshsystem.php">
                        <tr>
                            <td><label> </label></td>
                            <td><input type="hidden" name="today" id="today" required><br></td>
                            <td><input type="submit" onload="onload()" id="refresh" value="Refresh System"><br></td>
                            <script type="text/javascript">
                                function getDate()
                                {
                                    var today = new Date();
                                    var dd = today.getDate();
                                    var mm = today.getMonth()+1; //January is 0!
                                    var yyyy = today.getFullYear();
                                    if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm}
                                    today = yyyy+""+mm+""+dd;

                                    document.getElementById("today").value = today;
                                }
                                window.onload = getDate();
                            </script>
                        </tr>
                    </form>
                </table>
            </div>
        </div>
    </section>
</main>






</body>
</html>