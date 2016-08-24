<?php
session_start();
include ('db_connection.php');
if(is_null($_SESSION['admin'])){
    header('location: adminlogin.php');
}
$run = 0;
$firstnamee = array();
$lastname = array();
$startdate = array();
$enddate = array();
$price = array();
$facility = "";
$facilitycost = "";
$confirmation = array();
$bookedfacilities = array();
$bookedfacilitiescost = array();
if(isset($_POST['facility'])){
    $facility = $_POST['facility'];
    $facility = stripcslashes($facility);
    $facility = mysqli_real_escape_string($db, $facility);
    $query6 = "SELECT * FROM samphire_facilities WHERE f_name = '$facility'";
    $run6 = mysqli_query($db, $query6);
    $fetch6 = mysqli_fetch_array($run6);
    $fid = $fetch6['f_id'];
    $facilitycost = $fetch2['cost'];
    $query = "SELECT * FROM customer_bookings WHERE f_id = '$fid'";
    $run = mysqli_query($db, $query);
    if(mysqli_num_rows($run) < 1){
        $msg = 'No result';
    }else{
        $k = 1;
        while($o = mysqli_fetch_array($run)){
            $custid = $o['cust_id'];
            $startdate[] = $o['startdate'];
            $enddate[] = $o['enddate'];
            $price[] = $o['price'];
            $confirmation[] =$o['reference'];
            $query2 = "SELECT * FROM customers WHERE cust_id = '$custid'";
            $run2 = mysqli_query($db, $query2);
            $fetch = mysqli_fetch_array($run2);
            $firstnamee[] = $fetch['firstname'];
            $lastname[] = $fetch['lastname'];
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
    <section id="play" class="grid-70">
        <div id="g" class="grid-container"><h2>Admin Booking Editor</h2></div>
        <div id="upnava" class="grid-container">
            <ul>
                <li><a href='adminbookcancel.php'>Cancel a booking</a></li>
                <li><a href='changebookings.php'>Search Reference Number</a></li>
                <li><a href='editbookings.php'>Search by dates</a></li>
                <li><a href='modifybookings.php'>Search by Facility</a></li>
            </ul>
        </div>
        <div id="system">
            <div id="gl" class="grid-container"><h3>View by facility</h3></div>
            <div id="screen" class="grid-container">
                <?php
                echo "
                    <div id='customers' class='grid-container'><br><table class='grid-container' id='bookingdetail'>
                    <caption>Here's a list bookings for facility:  <h2>". $facility ."</h2> at the price:  <h3>".$facilitycost."</h3></caption>
                    <tr><th>first name</th><th>Last name</th><th>Reference No</th><th>Start date</th><th>End date</th></tr>";
                $i = 0;
                foreach($firstnamee as $firstname){
                    echo "<tr>"."<td>". $firstname ."<td>". $lastname[$i] ."<td>". $confirmation[$i] ."<td>". $startdate[$i] ."<td>". $enddate[$i]."<tr>";
                    $i++;
                }
                echo "</table></div>";
                echo "<div id=a></div><br>";
                ?>
            </div>
            <div id="search">
                <table>
                    <form method="post" action="modifybookings.php">
                        <tr>
                            <td><label>Select a facility: </label></td>
                            <td><select name="facility" size="1" required>
                                    <?php
                                    $getfacilities = "SELECT * FROM samphire_facilities";
                                    $result = mysqli_query($db, $getfacilities);
                                    while ($row = mysqli_fetch_array($result))
                                        echo "<option>". $row['f_name'] . "</option>";
                                    ?>
                                </select><br><br><br></td>
                        </tr>
                        <tr>
                            <td></td>
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