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

        $start = date("Y-m-d",strtotime($_SESSION['start']));
        //booking check start
        ?>
        <div id="screen">
            <p>Your reservetion details are as follows: </p>

            <div><label><?php echo "Start date:  " . $start ; ?></label><br><br></div>

            <?php
            if(!is_null($_SESSION['end'])){
                echo "<div><label> End date:  " . $_SESSION['end'] . "</label><br><br></div>";
            }?>

            <div><label> Facility(s) to be reserved:  </label><br><br></div>
            <div id="facili">
                <?php
                echo "<div id='warning'><label>You cannot select the same facility</label></div>";

                if($_SESSION['newfacilityunavailable'] == 0) {

                    $_SESSION['count'] = $_SESSION['count'] + 1;
                    $_SESSION['usecount'] = $_SESSION['count'];

                    $facilityarrays = $_SESSION['facilityarray'];

                    echo "<div><table><tr>";
                    foreach ($facilityarrays as $showfacility) {
                        echo "<td>" . $showfacility . "</td>";
                    }
                    echo "</tr></table></div>";
                }elseif($_SESSION['newfacilityunavailable'] == 1){
                    $unavailabledate = $_SESSION['unavailabledate'];
                    $rejectfacility = $_SESSION['unavailablefacility'];
                    echo "<div id='filled dates'><label>The $rejectfacility is not unavailable on: $unavailabledate</label><br>";
                    echo "<div><table><tr>";
                    foreach ($facilityarrays as $showfacility) {
                        echo "<td>" . $showfacility . "</td>";
                    }
                    echo "</tr></table></div>";

                }elseif($_SESSION['newfacilityunavailable'] == 2){
                    $unavailabledates =  $_SESSION['unavailabledates'];
                    $_SESSION['unavailablefacility'] = $rejectfacility;
                    echo "<div id='filled dates'><label>The $rejectfacility is not unavailable on the following dates: </label><br>";
                    echo "<table><tr>";
                    foreach ($unavailabledates as $showdate) {
                        echo "<td>" . $showdate . "</td>";
                    }
                    echo "</tr></table></div>";

                    echo "<div><table><tr>";
                    foreach ($facilityarrays as $showfacility) {
                        echo "<td>" . $showfacility . "</td>";
                    }
                    echo "</tr></table></div>";
                }

                ?>

            </div>

        </div>

        <div><label>To add another facility, select facility and click 'add':  </label></div>
        <form method="post" action="logfacilitycount.php">
            <select name="facilityarray" id="facilityarray" size="1" required>
                <?php
                $getfacilities = "SELECT * FROM samphire_facilities";
                $result = mysqli_query($db, $getfacilities);
                while ($row = mysqli_fetch_array($result)){
                    if($row['f_name'] ==  $facilities[0]) {

                    }else{
                        echo "<option>" . $row['f_name'] . "</option>";
                    }
                }
                ?>
            </select><br><br>
            <input type="hidden" name="firstfacility" id="firstfacility" value="<?php $_SESSION['facili'] ?>">
            <input type='submit' name="addfacility" id="addfacility" value='Add Facility'>
        </form>
        <script type="text/javascript" src='http://code.jquery.com/jquery-1.8.0.min.js'></script>
        <script type="text/javascript" src='JS/facilityarray.js.js'></script>



        <?php
        function generateRandomString($length = 6) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        $randomtable = generateRandomString();
        ?>




    </div>
</main>

</body>
</html>