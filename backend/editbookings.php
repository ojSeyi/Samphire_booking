<?php
session_start();
include ('db_connection.php');
if(is_null($_SESSION['admin'])){
    header('location: adminlogin.php');
}
$k = 0;
$run = 0;
$firstnamee = array();
$lastname = array();
$startdate = "";
$enddate = "";
$custid = "";
$confirmation = array();
$bookedfacilities = array();
$bookedfacilitiescost = array();

if(isset($_POST['enddate'])){
    if(($_POST['enddate'] < $_POST['startdate']) && ($_POST['enddate'] != $_POST['startdate'])) {
        $_POST['enddate'] = null;
    }else{
        $enddate = date("Y-m-d",strtotime($_POST['enddate']));
    }
}
if(isset($_POST['startdate'])){
    $startdate = date("Y-m-d",strtotime($_POST['startdate']));
}


if(isset($_POST['startdate']) && is_null($_POST['enddate'])){
    $query = "SELECT * FROM customer_bookings WHERE startdate = '$startdate'";
    $run = mysqli_query($db, $query);
    if(mysqli_num_rows($run) < 1){
        $msg = 'No result';
    }else{
        $k = 1;
        while($o = mysqli_fetch_array($run)){
            $custid = $o['cust_id'];
            $confirmation[] =$o['reference'];
            $bookedfacilitiescost[] = $o['price'];
            $query2 = "SELECT * FROM customers WHERE cust_id = '$custid'";
            $run2 = mysqli_query($db, $query2);
            $fetch = mysqli_fetch_array($run2);
            $firstnamee[] = $fetch['firstname'];
            $lastname[] = $fetch['lastname'];
            $fid = $o['f_id'];
            $query3 = "SELECT * FROM samphire_facilities WHERE f_id = '$fid'";
            $run3 = mysqli_query($db, $query3);
            $fetch2 = mysqli_fetch_array($run3);
            $bookedfacilities[] = $fetch2['f_name'];
        }
        $_SESSION['bookedfacilities'] = $bookedfacilities;
        $_SESSION['bookedfacilitiescost'] = $bookedfacilitiescost;
    }

}elseif(isset($_POST['startdate']) && isset($_POST['enddate'])){
    $query = "SELECT * FROM customer_bookings WHERE startdate = '$startdate' AND enddate = '$enddate'";
    $run = mysqli_query($db, $query);
    if(mysqli_num_rows($run) < 1){
        $msg = 'No result';
    }else{
        $k = 1;
        while($o = mysqli_fetch_array($run)){
            $custid = $o['cust_id'];
            $confirmation[] =$o['reference'];
            $bookedfacilitiescost[] = $o['price'];
            $query2 = "SELECT * FROM customers WHERE cust_id = '$custid'";
            $run2 = mysqli_query($db, $query2);
            $fetch = mysqli_fetch_array($run2);
            $firstnamee[] = $fetch['firstname'];
            $lastname[] = $fetch['lastname'];
            $fid = $o['f_id'];
            $query3 = "SELECT * FROM samphire_facilities WHERE f_id = '$fid'";
            $run3 = mysqli_query($db, $query3);
            $fetch2 = mysqli_fetch_array($run3);
            $bookedfacilities[] = $fetch2['f_name'];
        }
        $_SESSION['bookedfacilities'] = $bookedfacilities;
        $_SESSION['bookedfacilitiescost'] = $bookedfacilitiescost;
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
            <div id="gl" class="grid-container"><h3>View by dates</h3></div>
            <div id="screen" class="grid-container">
                <?php
                echo "
                    <div id='customers' class='grid-container'><br><table class='grid-container' id='bookingdetail'>
                    <caption>Here's a list bookings from date:  <h2>". $startdate ."</h2> - <h2>".$enddate."</h3></caption>
                    <tr><th>first name</th><th>Last name</th><th>Reference No</th><th>Facility</th><th>Booking Total</th><th>End date</th></tr>";
                $i = 0;
                foreach($firstnamee as $firstname){
                    echo "<tr>"."<td>". $firstname ."<td>". $lastname[$i] ."<td>". $confirmation[$i] ."<td>". $bookedfacilities[$i] ."<td>". $bookedfacilitiescost[$i] ."<td>". $enddate."<tr>";
                    $i++;
                }
                echo "</table></div>";
                echo "<div id=a></div><br>";
                ?>
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
            <?php if($k == 1) {
                echo
                "<div id='customers' class='grid-container'>
                <table>
                    <form method='post' action='editor2.php'>
                        <tr>
                            <td><label>Select a facility to REMOVE: </label></td>
                            <td><select name='rfacility' size='1' required>";
                $getfacilities = "SELECT * FROM samphire_facilities";
                $result = mysqli_query($db, $getfacilities);
                while ($row = mysqli_fetch_array($result))
                    echo "<option>" . $row['f_name'] . "</option>";
                echo
                "</select></td>
                        </tr>
                        <tr>
                            <td><label>Please enter a valid reference number: </label></td>
                            <td><input type='text' name='confirmation' required><br></td>
                        </tr>
                        <tr>
                            <td><input type='hidden' name='iliya' value='iliya'></td>
                            <td><input type='submit' name='removefacility2' value='Remove'><br></td>
                        </tr>
                        <tr>

                        </tr>
                        <tr>
                            <td><label>Select a facility to ADD: </label></td>
                            <td><select name='afacility' size='1' required>";
                $getfacilities = "SELECT * FROM samphire_facilities";
                $result = mysqli_query($db, $getfacilities);
                while ($row = mysqli_fetch_array($result))
                    echo "<option>" . $row['f_name'] . "</option>";
                echo
                "</select></td>
                        </tr>
                        <tr>
                            <td><label>Please enter a valid reference number: </label></td>
                            <td><input type='text' name='confirmation' required><br></td>
                        </tr>
                        <tr>
                            <td><input type='hidden' name='iliya' value='iliya'></td>
                            <td><input type='submit' name='removefacility2' value='Add'><br></td>
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