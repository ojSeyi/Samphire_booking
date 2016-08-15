<!DOCTYPE html>
<html lang="en">
<?php include ("db_connection.php"); ?>
<?php
session_start();
if(is_null($_SESSION['facili']) && is_null($_SESSION['start'])){
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
        <?php

        $startdate = date("Y-m-d",strtotime($_SESSION['start']));
        if(!is_null($_SESSION['end'])){
            $enddate =  date("Y-m-d",strtotime($_SESSION['end']));
        }else{
            $enddate = null;
        }
        //booking check start
        ?>

        <script type="text/javascript" src='http://code.jquery.com/jquery-1.8.0.min.js'></script>
        <script type="text/javascript" src='JS/facilityarray.js.js'></script>

        <div id="bookingconfirmation">
            <table>
                <tr>
                    <td id="tablehead"> Here are the details of your booking </td>
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
                    <td><?php
                        echo $_SESSION['facili'];
                        $_SESSION['count'] = 0;
                        $_SESSION['facilityarray'] = $facilityarray = array($_SESSION['facili']);
                        ?>
                    </td>
                    <td><?php
                        $check = $_SESSION['facili'];
                        $getfacilities = "SELECT * FROM samphire_facilities WHERE f_name = '$check";
                        $result = mysqli_query($db, $getfacilities)or die('error');
                        $row = mysqli_fetch_array($result);
                        echo $row['cost'];
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Total: </td>
                    <td><?php $pricetotal ?> </td>
                </tr>
            </table>
        </div>


        <div><label>To add another facility, select facility and click 'add':  </label></div>
        <div>
        <form method="post" action="facilitycount.php">
            <input type="hidden" name="bounce" value="bounce">
            <input type="hidden" name="firstfacility" id="firstfacility" value="<?php $_SESSION['facili'] ?>">
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
            <input type='submit' name="addfacility" id="addfacility" value='Add Facility'>
        </form>
        </div>

        <div id="submitbooking">
            <form method="post" action="jsfggksvuaigfuakwjygviuaevfvdkuvjy.php">
                <input type="submit" value="Make Reservation">
            </form>
        </div>

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