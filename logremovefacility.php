<!DOCTYPE html>
<html lang="en">
<?php include ("db_connection.php"); ?>
<?php
session_start();
if(is_null($_SESSION['firstname']) && is_null($_SESSION['facilityarraycheck'])){
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
                    $k = 1;
                }else{}
            }
            if($k == 1){
                $facilityarrays = array_diff($facilityarrays,[$_POST['rfacilityarray']]);
                $facilityarrays = array_values($facilityarrays);
                $_SESSION['facilityarray'] = $facilityarrays;
                header('location: bookstate2.php');
            }

        }
        ?>

        <?php $facilityarrays = $_SESSION['facilityarray'];?>
        <form method="post" action="removefacility.php">
            <select name="rfacilityarray" id="facilityarray" size="<?php echo count($facilityarrays) ?>" required>
                <?php
                foreach ($facilityarrays as $showfacilityy) {
                    echo "<option>".$showfacilityy ."</option>";
                }
                ?>
            </select>
            <input type="submit" value="remove">
        </form>

    </div>
</main>
</body>
</html>