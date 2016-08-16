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
<main class="grid-container">
    <section id="bannerbox">
        <img src="assets/images/banner1.jpg" id="bannerimage"/>
    </section>

    <div id="syscon" class="grid-70">
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
                    <td>
                        <?php $facilityarrays = $_SESSION['facilityarray'];?>
                        <?php
                        foreach ($facilityarrays as $showfacility) {
                            echo $showfacility ."</br>";
                        }
                        ?>
                    </td>
                    <td>  <?php
                        $facilityarrays = $_SESSION['facilityarray'];
                        foreach ($facilityarrays as $showcost) {
                            $checkcost = $showcost;
                            $getfacilities = "SELECT * FROM samphire_facilities WHERE f_name = '$checkcost'";
                            $result = mysqli_query($db, $getfacilities);
                            $cost = mysqli_fetch_array($result);
                            echo $cost['cost'] . "<br>";
                        }
                        ?>
                    </td>
                </tr><br><br>
                <tr>
                    <td>Total: </td>
                    <td><?php
                        $totalcost = 0;
                        foreach ($facilityarrays as $showcost) {
                            $checkcost = $showcost;
                            $getfacilities = "SELECT * FROM samphire_facilities WHERE f_name = '$checkcost'";
                            $result = mysqli_query($db, $getfacilities);
                            $cost = mysqli_fetch_array($result);
                            $totalcost = $totalcost + $cost['cost'];
                        }
                        echo $totalcost;
                        ?>
                    </td>
                </tr>
                <tr>
                    <?php
                    if($_SESSION['newfacilityunavailable'] == 1 || $_SESSION['newfacilityunavailable'] == 2){

                        if($_SESSION['newfacilityunavailable'] == 1){
                            $unavailabledate = $_SESSION['unavailabledate'];
                            $rejectfacility = $_SESSION['unavailablefacility'];
                            echo "<div id='filled dates'><label>The $rejectfacility is not unavailable on: $unavailabledate</label><br>";
                        }elseif($_SESSION['newfacilityunavailable'] == 2){
                            $unavailabledates =  $_SESSION['unavailabledates'];
                            $_SESSION['unavailablefacility'] = $rejectfacility;
                            echo "<div id='filled dates'><label>The $rejectfacility is not unavailable on the following dates: </label><br>";
                            echo "<table><tr>";
                            foreach ($unavailabledates as $showdate) {
                                echo "<td>" . $showdate . "</td>";
                            }
                            echo "</tr></table></div>";
                        }

                    }
                    ?>
                </tr>
            </table>
        </div>

        <br><br>
        <div><label>To add another facility, select facility and click 'add':  </label></div><br><br><br><br>
        <div>
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
        </div><br><br><br><br>

        <div id="removefacility">
            <form method="post" action="logremovefacility.php">
                <input type="hidden" name="flow" value="flow">
                <input type="submit" name ="removefacility" value="Remove">
            </form>
        </div><br><br><br><br>


        <div id="submitbooking">
            <form method="post" action="createbooking.php">
                <input type="submit" value="Make Reservation">
            </form>
        </div>

        <script type="text/javascript" src='http://code.jquery.com/jquery-1.8.0.min.js'></script>
        <script type="text/javascript" src='JS/facilityarray.js'></script>



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

    <aside class="grid-30">
        <nav class="grid-30">
            <ul>
                <li><a href='showbugs.php'>All Bug Items</a></li>
                <li><a href='showbugs.php?bugcategory=android'>Android Bug Items</a></li>
                <li><a href='showbugs.php?bugcategory=ios'>iOS Bug Items</a></li>
                <li><a href='showbugs.php?bugcategory=windows'>Windows Bug Items</a></li>
                <li><a href='addbug.php'>Insert Bug Items</a></li>
            </ul>
        </nav>
    </aside>
</main>

</body>
</html>