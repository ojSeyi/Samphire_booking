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
    <div id="logout">
        <form method="post" action="logout.php">
            <label><?php echo $_SESSION['firstname'];?></label>
            <input type="submit" name="logout" value="logout" id="logoutbutton"/>
        </form>
    </div>
    <div id="pagetitle"><h4>Samphire-Subsea</h4><p>Facilities Booking System</p></div>
</header>
<main>
    <section id="bannerbox">
        <img src="assets/images/banner1.jpg" id="bannerimage"/>
    </section>

     <div id="syscon">
        <?php

            $startdate = $_POST['startdate'];
            $startdate = date("d-m-Y",strtotime($startdate));
            $facility = $_POST['facility'];




            if (isset($_POST['enddate']) && $_POST['enddate'] == 'yes'){

                $_SESSION['startdate'] = $startdate;
                $_SESSION['facility'] = $facility;

                echo "<div id='reservationdetails'>
                <label>Facility: " .$facility. "</label><br><br><br>
                <label>Start Date: " .$startdate. "</label><br><br><br>
                </div>";

                echo "<form method='post' action='reservationcheck.php'>"."
                <label>Reservation End Date : </label>
                <input id='enddate' name='enddate' type='date' value='2016-07-02'/><br><br>
                <input type='submit' value='submit'/><br><br>
                </form>";
            }else{
                $_SESSION['startdate'] = $startdate;
                $_SESSION['facility'] = $facility;
                header('Location: reservationcheck.php');
            }

        ?>
    </div>
</main>

</body>
</html>