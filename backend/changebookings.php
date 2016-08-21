<?php
session_start();
include ('db_connection.php');
if(is_null($_SESSION['admin'])){
    header('location: adminlogin.php');
}
$_SESSION['reference'] = $_POST['confirmation'];
$run = 0;
$firstname = "";
$lastname = "";
$startdate = "";
$enddate = "";
$price = "";
$bookedfacilities = array();
$bookedfacilitiescost = array();
if(isset($_POST['confirmation'])){
    $reference = $_POST['confirmation'];
    $reference = stripcslashes($reference);
    $reference = mysqli_real_escape_string($db, $reference);
    $query = "SELECT * FROM customer_bookings WHERE reference = '$reference'";
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
        $_SESSION['confirmation'] = $reference;
    }

}else{
    $reference = $_SESSION['confirmation'];
    $query = "SELECT * FROM customer_bookings WHERE reference = '$reference'";
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
            $startdate = $row['startdate'];
            $enddate = $row['enddate'];
            $price = $row['price'];

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
        <div id="upnava" class="grid-container">
            <ul>
                <li><a href='index.php'>Search Reference Number</a></li>
                <li><a href='locatebooking.php'>Search by dates</a></li>
                <li><a href='contactus.php'>Search by Facility</a></li>
            </ul>
        </div>
        <div id="system">
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
                    <form method="post" action="viewbookings.php">
                        <tr>
                            <td><label>Enter reference number: </label></td>
                            <td><input type="text" name="confirmation" required><br></td>
                            <td><input type="submit" value="search"><br></td>
                        </tr>
                    </form>
                </table>
            </div>
            <br>
            <div id='customers' class='grid-container'>

            </div>
        </div>
    </section>
</main>




</body>
</html>