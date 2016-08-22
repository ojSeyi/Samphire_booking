<?php
session_start();
include ('db_connection.php');
if(is_null($_SESSION['admin'])){
    header('location: adminlogin.php');
}
$run = 0;
$firstnamee = array();
$lastname = array();
$startdate = "";
$enddate = "";
$confirmation = array();
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
            $confirmation[] =$o['reference'];
            $bookedfacilitiescost[] = $o['price'];
            $query2 = "SELECT * FROM customers WHERE cust_id = '$custid'";
            $run2 = mysqli_query($db, $query2);
            $fetch = mysqli_fetch_array($run2);
            $firstname[] = $fetch['firstname'];
            $lastname[] = $fetch['lastname'];
            $fid = $o['f_id'];
            $query3 = "SELECT * FROM samphire_facilities WHERE f_id = '$fid'";
            $run3 = mysqli_query($db, $query3);
            $fetch2 = mysqli_fetch_array($run3);
            $bookedfacilities[] = $fetch2['f_name'];
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
            $confirmation[] =$o['reference'];
            $bookedfacilitiescost[] = $o['price'];
            $query2 = "SELECT * FROM customers WHERE cust_id = '$custid'";
            $run2 = mysqli_query($db, $query2);
            $fetch = mysqli_fetch_array($run2);
            $firstname[] = $fetch['firstname'];
            $lastname[] = $fetch['lastname'];
            $fid = $o['f_id'];
            $query3 = "SELECT * FROM samphire_facilities WHERE f_id = '$fid'";
            $run3 = mysqli_query($db, $query3);
            $fetch2 = mysqli_fetch_array($run3);
            $bookedfacilities[] = $fetch2['f_name'];
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
                <?php
                echo "
                    <div id='customers' class='grid-container'><br><table id='bookingdetail'>
                    <caption>Here's a list bookings from date:  <h2>". $startdate ."</h2> - <h2>".$enddate."</h3></caption>
                    <tr><th>first name</th><th>Last name</th><th>Reference No</th><th>Facility</th><th>Booking Total</th></tr>";
                $i = 0;
                foreach($firstnamee as $firstname){
                    echo "<tr>"."<td>". $firstname[$i] ."<td>". $lastname[$i] ."<td>". $confirmation[$i] ."<td>". $bookedfacilities[$i] ."<td>". $bookedfacilitiescost[$i]."<tr>";
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
            <div id='customers' class='grid-container'>

            </div>
        </div>
    </section>
</main>




</body>
</html>