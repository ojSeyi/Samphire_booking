<!DOCTYPE html>
<html lang="en">
<?php include ("db_connection.php"); ?>
<?php
session_start();
if(is_null($_SESSION['facilityarraycheck'])){
    header('location: bookstate.php');
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
        <?php
        include ("db_connection.php");
        if(is_null($_POST['flow'])){
            header('location: bookstate2.php');
        };?>

        <?php
            $k = 0;
            if(isset($_POST['rfacilityarray'])){
                $facilityarrays = $_SESSION['facilityarray'];
                foreach ($facilityarrays as $showfacility) {
                    if ($showfacility = $_POST['rfacilityarray']){
                        $k = key($showfacility);
                        unset($facilityarrays[$k]);
                    }
                }
                $facilityarrays = array_values($facilityarrays);
                $_SESSION['facilityarray'] = $facilityarrays;
                header('location: bookstate2.php');
            }
        ?>


        <?php $facilityarrays = $_SESSION['facilityarray'];?>
        <form method="post" action="removefacility.php">
            <select name="rfacilityarray" id="facilityarray" size="<?php echo count($facilityarrays) ?>" required>
                <?php
                foreach ($facilityarrays as $showfacility) {
                    echo "<option>".$showfacility ."</option>";
                }
                ?>
            </select>
            <input type="submit" value="remove">
        </form>
        ?>
    </div>
</main>
</body>
</html>