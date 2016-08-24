<?php
session_start();
include ('db_connection.php');
if(is_null($_SESSION['admin'])){
    header('location: adminlogin.php');
}
$k = 0;
$y = 0;
if(isset($_POST['rfacility'])){
    $input = $_POST['rfacility'];
    $input = stripcslashes($input);
    $input = mysqli_real_escape_string($db, $input);
    $removecmd = "DELETE FROM samphire_facilities WHERE f_name = '$input'";
    $run = mysqli_query($db, $removecmd);
}elseif(isset($_POST['afacility'])){
    $input = $_POST['afacility'];
    $input = stripcslashes($input);
    $input = mysqli_real_escape_string($db, $input);
    $cost = $_POST['cost'];
    $get = "SELECT * FROM samphire_facilities";
    $geta = mysqli_query($db, $get);
    while($r = mysqli_fetch_array($geta)){
        $w = $r['f_name'];
        if($w == $input){
            $k = 1;
        }
    }
    if($k == 1){

        $y = 0;
    }else{
        $addcmd = "INSERT INTO samphire_facilities (f_name, cost) VALUES ('$input', '$cost')";
        $run = mysqli_query($db, $addcmd);
        $y = 7;
    }
}

$facilities = array();
$prices = array();
$getall = "SELECT * FROM samphire_facilities";
$get = mysqli_query($db, $getall);
while($f = mysqli_fetch_array($get)){
    $facilities[] = $f['f_name'];
    $prices[] = $f['cost'];
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
            <li><a href='addremoveadmin.php'>Add/Remove Facility</a></li>
        </ul>
    </nav>
    <section class="grid-70">
        <div id="system" class="grid-container">
            <div id="screen" class="grid-container">
                <table id="bookingdetails" class="grid-container">
                    <caption>List of All Facilities on the system</caption>
                    <tr>
                        <th>Facility</th>
                        <th>Price</th>
                    </tr>
                    <?php
                    $s = 0;
                    foreach ($facilities as $facility) {
                        echo "<tr><td>".$facility ."</td>"."<td>".$prices[$s] ."</td>"."</tr>";
                        $s++;
                    }
                    if($y == 0){
                        echo "<tr></tr><tr><h4>The facility you just tried to add is already on the system</h4></tr>";
                    }
                    ?>
                    <tr></tr>
                </table>
            </div>
            <div id="upnava" class="grid-container">
                <ul>
                    <li><span class="fake-link" id="ad">Add Facility</span></li>
                    <li><span class="fake-link" id="de">Remove Facility</span></li>
                </ul>
            </div>
            <div id="search01" style="display: block">
                <table>
                    <form method="post" action="addremoveadmin.php">
                        <tr>
                            <td><label>Enter new facility name: </label></td>
                            <td><input type="text" name="afacility" required><br></td>
                        </tr>
                        <tr>
                            <td><label>Enter new facility price: </label></td>
                            <td><input type="number" name="cost" required><br></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" value="Add"><br></td>
                        </tr>
                    </form>
                </table>
            </div>
            <div id="search02" style="display: none">
                <table>
                    <form method="post" action="addremoveadmin.php">
                        <tr>
                            <td><label>Select a facility: </label></td>
                            <td><select name="rfacility" size="1" required>
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
                            <td><input type="submit" value="Remove"><br></td>
                        </tr>
                    </form>
                </table>
            </div>
            <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
            <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
            <script type="text/javascript" src="JS/global.js"></script>
        </div>
    </section>
</main>

</body>
</html>
