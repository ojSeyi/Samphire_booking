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
<head>
    <meta charset="UTF-8">
    <title>Samphire Subsea Facilities Booking</title>
</head>
<?php include ("db_connection.php"); ?>
<?php session_start();
if(isset($_SESSION['login'])){
    header('Location: home1.php');
};
?>
<?php
$currentdate = date('d-m-Y', getTimestamp());
$currentnextdate = date('d-m-Y', ($currentdate + 1)); ?>
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

        <form id="search" method="post" action="datecheck2.php">
            <Label>Please select a facility</Label>
            <select name="facility" size="1" required>
                <?php
                $getfacilities = "SELECT * FROM samphire_facilities";
                $result = mysqli_query($db, $getfacilities);
                while ($row = mysqli_fetch_array($result))
                    echo "<option>". $row['f_name'] . "</option>";
                ?>
            </select><br><br>
            <label>Reservation Date : </label>
            <input id="startdate" name="startdate" type="date" value="<?php echo $currentdate?>"/><br><br>
            <label>If you would require the facility for more than one day tick this box</label><br>
            <input type="checkbox" id="enddate" name="enddateC" value="yes"/><br><br><br>
            <input type="submit" value="submit"/><br><br>
        </form>

    </div>
</main>

</body>
</html>