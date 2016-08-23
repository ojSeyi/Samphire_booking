<!DOCTYPE html>
<html lang="en">
<?php include ("db_connection.php"); ?>
<?php
session_start();
if(is_null($_SESSION['firstname']) && is_null($_SESSION['facili']) && is_null($_SESSION['start'])){
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
<header class="grid-container">
    <img src="assets/images/logo_2016.jpg" id="logo"/>
    <div id="log">
        <div id="logout">
            <form method="post" action="logout.php">
                <label><?php echo $_SESSION['firstname'];?></label>
                <input type="submit" name="logout" value="logout" id="logoutbutton"/>
            </form>
        </div>
        <div id="pagetitle"><h4>Samphire-Subsea</h4><p>Facilities Booking System</p></div>
    </div>
    <nav id="upnav" class="grid-container">
        <ul>
            <li><a href='index.php'>Create Booking</a></li>
            <li><a href='logmanagebooking.php'>Manage Booking</a></li>
            <li><a href='viewhistory.php'>View Past Bookings</a></li>
            <li><a href='contactus.php'>Contact Us</a></li>
        </ul>
    </nav>
</header>

<div id="system">
    <main class="grid-container">

    <div id="syscon">
        <?php
        $firstname = $_SESSION['firstname'];
        $lastname = $_SESSION['lastname'];
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
            <table id="bookingdetails"  class="grid-container">
                <tr>
                    <td id="tablehead"> Here are the details of your booking </td>
                </tr>
                <tr>
                    <td>Booking Date(s):
                        <?php
                        if(is_null($enddate)){
                            echo " ".$startdate." ";
                        }else{
                            echo " From: ".$startdate." to: " . $enddate . " ";
                        }
                        ?>
                    </td><br>
                </tr>
                <tr id="pins">
                    <td>Facility(s)</td>
                    <td>Price(s)</td>
                </tr>
                <tr id="pin">
                    <td><?php
                        echo $_SESSION['facili'];
                        $_SESSION['count'] = 0;
                        $facilityarray = array();
                        $facili = $_SESSION['facili'];
                        $facilityarray[] = $facili;
                        $_SESSION['facilityarray'] = $facilityarray;
                        ?>
                    </td>
                    <td><?php
                        $check = $_SESSION['facili'];
                        $getfacilities = "SELECT * FROM samphire_facilities WHERE f_name = '$check'";
                        $result = mysqli_query($db, $getfacilities);
                        $row = mysqli_fetch_array($result);
                        $pricetotal = $row['cost'];
                        echo "£".$row['cost'];
                        ?>
                    </td>
                </tr>
                <tr id="pind">
                    <td>Total: </td>
                    <td><?php echo "£".$pricetotal; ?> </td>
                </tr><br>
            </table>
        </div>



        <div><label>To change facility or add another facility, select facility and click 'Edit':  </label></div><br><br>
        <div>
        <form method="post" action="logfacilitycount.php">
            <input type="hidden" name="bounce" value="bounce">
            <input type="hidden" name="firstfacility" id="firstfacility" value="<?php $_SESSION['facili'] ?>">
            <br><br>
            <input type='submit' name="addfacility" id="addfacility" value='Edit'>
        </form>
        </div><br><br>

        <div id="submitbooking">
            <form method="post" action="createbooking.php">
                <input type="submit" value="Make Reservation">
            </form>
        </div>


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
</div>

</body>
</html>