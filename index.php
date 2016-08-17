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

<?php include ("db_connection.php"); ?>
<?php session_start();
if(isset($_SESSION['login'])){
    header('Location: home1.php');
}; ?>

<body>
<div id="system">
    <nav id="innav"">
        <ul>
            <li><a href='showbugs.php'>All Bug Items</a></li>
            <li><a href='showbugs.php?bugcategory=android'>Android Bug Items</a></li>
            <li><a href='showbugs.php?bugcategory=ios'>iOS Bug Items</a></li>
            <li><a href='showbugs.php?bugcategory=windows'>Windows Bug Items</a></li>
            <li><a href='addbug.php'>Insert Bug Items</a></li>
        </ul>
    </nav>
<main class="grid-container">
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

    <div id="syscon">

        <form id="search" name="search" method="post" action="datecheck2.php">
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
            <input type="text" name="startdate" id="startdate" min="2016-08-14" required/><br><br>
            <label>If you would require the facility for more than one day tick this box</label><br>
            <input type="checkbox" id="enddate" name="enddateC" value="yes"/><br><br><br>
            <input type="submit" onload="onload()" value="submit" /><br><br>
            <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
            <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
            <script type="text/javascript" src="JS/global.js"></script>
        </form>

    </div>

</main>
</div>
<nav id="outnav"">
    <ul>
        <li><a href='showbugs.php'>All Bug Items</a></li>
        <li><a href='showbugs.php?bugcategory=android'>Android Bug Items</a></li>
        <li><a href='showbugs.php?bugcategory=ios'>iOS Bug Items</a></li>
        <li><a href='showbugs.php?bugcategory=windows'>Windows Bug Items</a></li>
        <li><a href='addbug.php'>Insert Bug Items</a></li>
    </ul>
</nav>
</body>
</html>