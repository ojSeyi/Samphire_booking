<?php
session_start();
include ('db_connection.php');
if(is_null($_SESSION['admin'])){
    header('location: adminlogin.php');
}
$run = 0;
$firstname = "";
$lastname = "";
$startdate = "";
$enddate = "";
$price = "";
$bookedfacilities = array();
$bookedfacilitiescost = array();
if(isset($_POST['startdate']) && is_null($_POST['enddate'])){
    $startdate = $_POST['startdate'];
    $startdate = stripcslashes($startdate);
    $startdate = mysqli_real_escape_string($db, $startdate);
    $query = "SELECT * FROM customer_bookings WHERE startdate = '$startdate'";
    $run = mysqli_query($db, $query);
    if(mysqli_num_rows($run) < 1){
        $msg = 'No result';
    }else{
        $k = 1;
        while($o = mysqli_fetch_array($run)){
            $custid = $o['cust_id'];
            $query2 = "SELECT * FROM customers WHERE cust_id = '$custid'";
            $run2 = mysqli_query($db, $query2);
            $fetch = mysqli_fetch_array($run2);
            $firstname = $fetch['firstname'];
            $lastname = $fetch['lastname'];
            $startdate = $o['startdate'];
            $enddate = $o['enddate'];
            $price = $o['price'];

            $fid =$o['f_id'];
            $query3 = "SELECT * FROM samphire_facilities WHERE f_id = '$fid'";
            $run3 = mysqli_query($db, $query3);
            $fetch2 = mysqli_fetch_array($run3);
            $bookedfacilities[] = $fetch2['f_name'];
            $bookedfacilitiescost[] = $fetch2['cost'];
        }
    }

}elseif(isset($_POST['startdate']) && isset($_POST['enddate'])){
    $startdate = $_POST['startdate'];
    $startdate = stripcslashes($startdate);
    $startdate = mysqli_real_escape_string($db, $startdate);
    $enddate = $_POST['enddate'];
    $enddate = stripcslashes($enddate);
    $enddate = mysqli_real_escape_string($db, $enddate);
    $query = "SELECT * FROM customer_bookings WHERE startdate = '$startdate' AND enddate = '$enddate'";
    $run = mysqli_query($db, $query);
    if(mysqli_num_rows($run) < 1){
        $msg = 'No result';
    }else{
        $k = 1;
        while($o = mysqli_fetch_array($run)){
            $custid = $o['cust_id'];
            $query2 = "SELECT * FROM customers WHERE cust_id = '$custid'";
            $run2 = mysqli_query($db, $query2);
            $fetch = mysqli_fetch_array($run2);
            $firstname = $fetch['firstname'];
            $lastname = $fetch['lastname'];
            $startdate = $o['startdate'];
            $enddate = $o['enddate'];
            $price = $o['price'];

            $fid =$o['f_id'];
            $query3 = "SELECT * FROM samphire_facilities WHERE f_id = '$fid'";
            $run3 = mysqli_query($db, $query3);
            $fetch2 = mysqli_fetch_array($run3);
            $bookedfacilities[] = $fetch2['f_name'];
            $bookedfacilitiescost[] = $fetch2['cost'];
        }
    }
}


?>
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
<body>
<header>
    <img src="assets/images/logo_2016.jpg" id="logo"/>
    <div id="log">
        <div id="logout">
            <form method="post" action="adminlogout.php">
                <label><?php echo $_SESSION['firstname'];?></label>
                <input type="submit" name="logout" value="logout" id="logoutbutton"/>
            </form>
        </div>
        <div id="pagetitle"><h4>Samphire-Subsea</h4><p>Facilities Booking System - Administrator</p></div>
</header>

<main>
    <nav class="grid-30">
        <ul>
            <li><a href='viewbookings.php'>View Bookings</a></li>
            <li><a href='changebookings.php'>Change Bookings</a></li>
            <li><a href='cancelbookings.php'>Cancel Bookings</a></li>
            <li><a href='refreshsystem.php'>Refresh System</a></li>
            <li><a href='viewcustomers.php'>View Customers</a></li>
        </ul>
    </nav>
    <section class="grid-70">
        <div id="g" class="grid-container"><h2>Admin Booking Editor</h2></div>
        <div id="upnava" class="grid-container">
            <ul>
                <li><a href='changebookings.php'>Search Reference Number</a></li>
                <li><a href='editbookings.php'>Search by dates</a></li>
                <li><a href='modifybookings.php'>Search by Facility</a></li>
            </ul>
        </div>
        <div id="system">
            <div id="gl" class="grid-container"><h3>View by dates</h3></div>
            <div id="screen" class="grid-container">
                <table id="bookingdetails" class="grid-container">
                    <tr>
                        <td id="o">Customer Name: </td>
                        <td id="o"><?php echo $firstname . " " . $lastname; ?></td>
                    </tr>
                    <tr id="ref">
                        <td>Booking Reference Number:</td>
                        <td><?php echo $reference ?></td>
                    </tr>
                    <tr>
                        <td>Booking Date(s): </td>
                        <?php
                        if($enddate == $startdate){
                            echo "<td>".$startdate."</td>";
                        }else{
                            echo "<td> From: ".$startdate." to: " . $enddate . "</td>";
                        }
                        ?>
                    </tr>
                    <tr id="pins">
                        <td>Facility(s)</td>
                        <td>Price(s)</td>
                    </tr>
                    <tr id="pin">
                        <td>
                            <?php
                            foreach ($bookedfacilities as $showfacility) {
                                echo $showfacility ."<br>";
                            }
                            ?>
                        </td>
                        <td>  <?php
                            foreach ($bookedfacilities as $showcost) {
                                $checkcost = $showcost;
                                $getfacilities = "SELECT * FROM samphire_facilities WHERE f_name = '$checkcost'";
                                $result = mysqli_query($db, $getfacilities);
                                $cost = mysqli_fetch_array($result);
                                echo "£".$cost['cost'] . "<br>";
                            }
                            ?>
                        </td>
                    </tr><br><br>
                    <tr id="pind">
                        <td>Total: </td>
                        <td><?php
                            $totalcost = 0;
                            foreach ($bookedfacilities as $showcost) {
                                $getfacilities = "SELECT * FROM samphire_facilities WHERE f_name = '$showcost'";
                                $result = mysqli_query($db, $getfacilities);
                                $cost = mysqli_fetch_array($result);
                                $totalcost = $totalcost + $cost['cost'];
                            }
                            echo "£".$totalcost;
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="search">
                <table>
                    <form method="post" action="editbookings.php">
                        <tr>
                            <td><label>Enter start date: </label></td>
                            <td><input type="text" id="startdate" name="startdate" required><br></td>
                        </tr>
                        <tr>
                            <td><label>Enter end date if there is one: </label></td>
                            <td><input type="text" id="enddate" name="enddate"><br></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" value="search"><br></td>
                        </tr>
                    </form>
                </table>
            </div>
            <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
            <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
            <script type="text/javascript" src="JS/global.js"></script>
            <br>
            <div id='customers' class='grid-container'>

            </div>
        </div>
    </section>
</main>




</body>
</html>