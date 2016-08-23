<!DOCTYPE html>
<html lang="en">
<?php include ("db_connection.php"); ?>
<?php
session_start();
if(is_null($_SESSION['firstname'])){
    header('location: index.php');
};
$run = 0;
$firstname = "";
$lastname = "";
$startdate = array();
$enddate = array();
$price = "";
$reference = array();
$bookedfacilities = array();
$bookedfacilitiescost = array();
if(isset($_SESSION['custid'])) {
    $custid = $_SESSION['custid'];
    $query = "SELECT * FROM customer_bookings WHERE cust_id = '$custid'";
    $run = mysqli_query($db, $query);
    if (mysqli_num_rows($run) < 1) {
        $msg = 'No result';
    } else {
        $k = 1;
        while ($o = mysqli_fetch_array($run)) {
            $custid = $o['cust_id'];
            $query2 = "SELECT * FROM customers WHERE cust_id = '$custid'";
            $run2 = mysqli_query($db, $query2);
            $fetch = mysqli_fetch_array($run2);
            $firstname = $fetch['firstname'];
            $lastname = $fetch['lastname'];
            $startdate = $o['startdate'];
            $enddate = $o['enddate'];
            $price = $o['price'];
            $reference[] = $o['reference'];

            $fid = $o['f_id'];
            $query3 = "SELECT * FROM samphire_facilities WHERE f_id = '$fid'";
            $run3 = mysqli_query($db, $query3);
            $fetch2 = mysqli_fetch_array($run3);
            $bookedfacilities[] = $fetch2['f_name'];
            $bookedfacilitiescost[] = $fetch2['cost'];
        }
    }
}
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
            <li><a href='contactus.php'>Contact Us</a></li>
        </ul>
    </nav>
</header>
<div id="system">
    <main class="grid-container"><br><br><br>
        <div id="screens" class="grid-container">
            <?php
            echo "
                    <div id='customers' class='grid-container'><br><table class='grid-container' id='bookingdetail'>
                    <caption>Here's a list bookings made by:  <h3>". $firstname ."  ".$lastname."</h3></caption>
                    <tr><th>Reference No</th><th>Facility</th><th>Facility price</th><th>Start date</th><th>End date</th><th>Booking Total</th></tr>";
            $i = 0;
            foreach($reference as $referee){
                echo "<tr>"."<td>". $referee ."<td>". $bookedfacilities[$i] ."<td>". $bookedfacilitiescost[$i] ."<td>". $startdate[$i] ."<td>". $enddate[$i]."<tr>";
                $i++;
            }
            echo "</table></div>";
            echo "<div id=a></div><br>";
            ?>
        </div>
    </main>
</div>
</body>
</html>