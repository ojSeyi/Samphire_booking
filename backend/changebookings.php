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

    }

}elseif(isset($_SESSION['reference'])){
    $reference = $_SESSION['reference'];
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

    }
}

$kilo = 0;
$y = 0;
if(isset($_POST['rfacility'])){
    $reference = $_SESSION['reference'];
    $input = $_POST['rfacility'];
    $input = stripcslashes($input);
    $input = mysqli_real_escape_string($db, $input);
    $getfacid = "SELECT * FROM samphire_facilities WHERE f_name = $input";
    $hitit = mysqli_query($db, $getfacid) or die('lol');
    $arr = mysqli_fetch_array($hitit);
    $x = $arr['f_id'];
    $removecmd = "DELETE FROM samphire_bookings WHERE f_id = '$x' AND reference = $reference";
    $run = mysqli_query($db, $removecmd)or die('lol2');
    $y = 3;
}elseif(isset($_POST['afacility'])){
    $cus = "";
    $facid = "";
    $startdate = "";
    $enddate = "";
    $priceee = "";
    $ku = "";
    $newt = $priceee + $ku;
    $reference = $_SESSION['reference'];
    $input = $_POST['afacility'];
    $input = stripcslashes($input);
    $input = mysqli_real_escape_string($db, $input);
    $cost = $_POST['cost'];
    $getfacid = "SELECT * FROM samphire_facilities WHERE f_name = $input";
    $hitit = mysqli_query($db, $getfacid)or die('lol3');
    $arr = mysqli_fetch_array($hitit);
    $x = $arr['f_id'];
    $ku = $arr['cost'];
    $get = "SELECT * FROM samphire_bookings WHERE reference = $reference";
    $geta = mysqli_query($db, $get)or die('lol4');
    while($r = mysqli_fetch_array($geta)){
        $cus = $r['cust'];
        $startdate = $r['startdate'];
        $enddate = $r['enddate'];
        $priceee = $r['price'];
        $w = $r['f_id'];
        if($w == $x){
            $kilo = 1;
        }
    }
    if($kilo == 1){

        $y = 0;
    }else{
        $addcmd = "INSERT INTO samphire_bookings (reference, f_id, cust_id, startdate, endate, price) VALUES ('$reference', '$x', '$cus', '$startdate', $enddate, '$newt')";
        $run = mysqli_query($db, $addcmd)or die('lol5');
        $sqll = "UPDATE samphire_bookings SET price='$newt' WHERE reference= $reference";
        $runsql = mysqli_query($db, $sqll) or die('lol6');
        $y = 7;
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
            <li><a href='addremoveadmin.php'>Add/Remove Facility</a></li>
        </ul>
    </nav>
    <section id="play" class="grid-70">
        <div id="g" class="grid-container"><h2>Admin Booking Editor</h2></div>
        <div id="upnava" class="grid-container">
            <ul>
                <li><a href='changebookings.php'>Search Reference Number</a></li>
                <li><a href='editbookings.php'>Search by dates</a></li>
                <li><a href='modifybookings.php'>Search by Facility</a></li>
            </ul>
        </div>
        <div id="system">
            <div id="gl" class="grid-container"><h3>View by Reference number</h3></div>
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
                    <form method="post" action="changebookings.php">
                        <tr>
                            <td><label>Enter reference number: </label></td>
                            <td><input type="text" name="confirmation" required><br></td>
                            <td><input type="submit" value="search"><br></td>
                        </tr>
                    </form>
                </table>
            </div>
            <br>
            <?php if($k == 1){
            echo
            "<div id='customers' class='grid-container'>
                <table>
                    <form method='post' action='changebookings.php'>
                        <tr>
                            <td><label>Select a facility to add: </label></td>
                            <td><select name='afacility' size='1' required>";
            $getfacilities = "SELECT * FROM samphire_facilities";
            $result = mysqli_query($db, $getfacilities);
            while ($row = mysqli_fetch_array($result))
                echo "<option>". $row['f_name'] . "</option>";
            echo
            "</select></td>
                        </tr>
                        <tr>
                            <td><input type='hidden' name='iliya' value='iliya'></td>
                            <td><input type='submit' name='removefacility2' value='Add'><br></td>
                        </tr>
                    </form>
                    <br>
                    <form method='post' action='changebookings.php'>
                        <tr>
                            <td><label>Select a facility to remove: </label></td>
                            <td><select name='rfacility' size='1' required>";
            foreach ($bookedfacilities as $showfacility) {
                echo "<option>" . $showfacility . "</option>";
            }
            echo
            "</select></td>
                        </tr>
                        <tr>
                            <td><input type='hidden' name='iliya' value='iliya'></td>
                            <td><input type='submit' name='removefacility2' value='Remove'><br></td>
                        </tr>
                    </form>
                </table>
            </div>";
            }?>
        </div>
    </section>
</main>




</body>
</html>