<!DOCTYPE html>
<html lang="en">
<?php include ("db_connection.php"); ?>
<?php
session_start();
if(is_null($_SESSION['firstname']) && is_null($_SESSION['start'])  && is_null($_SESSION['end'])  && is_null($_SESSION['facili'])){
    header('location: index.php');
};
?>
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
<header>
    <img src="assets/images/logo_2016.jpg" id="logo"/>
    <div id="form">
        <form method="post" action="login.php">
            <input type="text" name="username" id="usernamebox" placeholder="Username" required/>
            <input type="password" name="password" id="passwordbox" placeholder="Password" required/>
            <input type="submit" value="Login" name="login" id="loginb"/>
        </form>
    </div>
    <div id="pagetitle"><h4>Samphire-Subsea</h4><p>Facilities Booking System</p></div>
</header>
<main>
    <section id="bannerbox">
        <img src="assets/images/banner1.jpg" id="bannerimage"/>
    </section>

    <div id="syscon">
        <div id="bookingconfirmation">
            <table>
                <tr>
                    <td id="tablehead"> Here are the details of your booking </td>
                </tr>
                <tr>
                    <td>Customer Name: </td>
                    <td><?php echo $firstname . " " . $lastname; ?></td>
                </tr>
                <tr>
                    <td>Booking Date(s): </td>
                    <?php
                        if(is_null($enddate)){
                            echo "<td>".$startdate."</td>";
                        }else{
                            echo "<td> From: ".$startdate." to: " . $enddate . "</td>";
                        }
                    ?>
                </tr>
                <tr>
                    <td>Facility(s)</td>
                    <td>Price(s)</td>
                </tr>
                <tr>
                    <td><?php echo "<div><table>";
                        foreach ($facilityarrays as $showfacility) {
                            echo "<tr>" . $showfacility . "</tr>";
                        }
                        echo "</table></div>"; ?>
                    </td>
                    <td><?php echo "<div><table>";
                        foreach ($facilitypricearrays as $showprice) {
                            echo "<tr>" . $showprice . "</tr>";
                        }
                        echo "</table></div>"; ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</main>

</body>
</html>
