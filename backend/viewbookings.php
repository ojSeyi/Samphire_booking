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
        <div id="system">
            <div id="screen" class="grid-container">
                <table id="bookingdetails" class="grid-container">
                    <?php
                    if($k == 1){
                    echo "<tr>
                        <td>
                                Username:
                            <br><br>
                        </td>
                        <td>
                            ".$username."<br><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                                Password:
                            <br><br>
                        </td>
                        <td>
                            ".$password."<br><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                                First name:
                            <br><br>
                        </td>
                        <td>
                            ".$firstname."<br><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                                Last name:
                            <br><br>
                        </td>
                        <td>
                            ".$lastname."<br><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                                Email:
                            <br><br>
                        </td>
                        <td>
                            ".$email."<br><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                                Mobile number:
                            <br><br>
                        </td>
                        <td>
                            ".$mobile."<br><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                                Address:
                            <br><br>
                        </td>
                        <td>
                            ".$address."<br><br>
                        </td>
                    </tr>";}
                    ?>
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
        </div>
    </section>
</main>




</body>
</html>