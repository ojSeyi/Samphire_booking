<?php
session_start();
include ('db_connection.php');
if(is_null($_SESSION['admin'])){
    header('location: adminlogin.php');
}

$username = "";
$password = "";
$firstname = "";
$lastname = "";
$email = "";
$mobile = "";
$address = "";
$k = 0;

$emailsarray = array();
$firstnamearray = array();
$lastnamearray = array();
$logidarray = array();
$usernamearray = array();
$passwordarray = array();
$mobilearray = array();
$addressarray = array();

if(isset($_POST['username'])){
    $username = $_POST['username'];
    $username = stripcslashes($username);
    $username = mysqli_real_escape_string($db, $username);
    $query = "SELECT * FROM customer_login WHERE username = '$username'";
    $run = mysqli_query($db, $query);
    if($run){
        $fetch = mysqli_fetch_array($run);
        $logid = $fetch['log_id'];
        $password = $fetch['password'];
        $query2 = "SELECT * FROM customers WHERE log_id = '$logid'";
        $run2 = mysqli_query($db, $query2);
        if($run2){
            $fetch2 = mysqli_fetch_array($run2);
            $firstname = $fetch2['firstname'];
            $lastname = $fetch2['lastname'];
            $email = $fetch2['email'];
            $mobile = $fetch2['mobile'];
            $address = $fetch2['address'];
            $k=1;
        }

    }
}elseif(isset($_POST['firstname']) && isset($_POST['lastname'])){
    $firstname = $_POST['firstname'];
    $firstname = stripcslashes($firstname);
    $firstname = mysqli_real_escape_string($db, $firstname);
    $lastname = $_POST['lastname'];
    $lastname = stripcslashes($lastname);
    $lastname = mysqli_real_escape_string($db, $lastname);
    $query = "SELECT * FROM customers WHERE firstname = '$firstname' AND lastname = '$lastname'";
    $run = mysqli_query($db, $query);
    while($fetch = mysqli_fetch_array($run)){
        $a = $fetch['log_id'];
        $logidarray[] = $fetch['log_id'];
        $firstnamearray[] = $fetch['firstname'];
        $lastnamearray[] = $fetch['lastname'];
        $emailsarray[] = $fetch['email'];
        $mobilearray[] = $fetch['mobile'];
        $addressarray[] = $fetch['address'];
        $query2 = "SELECT * FROM customer_login WHERE log_id = '$a'";
        $run2 = mysqli_query($db, $query2);
        $fetch2 = mysqli_fetch_array($run2);
        $usernamearray[] = $fetch2['username'];
        $passwordarray[] = $fetch2['password'];
        $k = 2;
    }


}elseif(isset($_POST['email'])) {
    $email = $_POST['email'];
    $email = stripcslashes($email);
    $email = mysqli_real_escape_string($db, $email);
    $query = "SELECT * FROM customers WHERE email = '$email'";
    $run = mysqli_query($db, $query);
    $fetch = mysqli_fetch_array($run);
    $firstname = $fetch['firstname'];
    $lastname = $fetch['lastname'];
    $mobile = $fetch['mobile'];
    $address = $fetch['address'];
    $logid = $fetch['log_id'];
    $query2 = "SELECT * FROM customer_login WHERE log_id = '$logid'";
    $run2 = mysqli_query($db, $query2);
    $fetch2 = mysqli_fetch_array($run2);
    $username = $fetch2['username'];
    $password = $fetch2['password'];
    $k=1;
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
        <div id="system" class="grid-container">
            <div id="screen" class="grid-container">
                    <?php
                    if($k == 1){
                        echo "
                        <div id='customers'><br><table id='bookingdetai' class='grid-container'>
                        <caption>Here are the full details of username:  <h4>" . $username . "</h4></caption>
                    <tr>
                        <td>
                                Password:
                            <br>
                        </td>
                        <td>
                            ".$password."<br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                                First name:
                            <br>
                        </td>
                        <td>
                            ".$firstname."<br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                                Last name:
                            <br>
                        </td>
                        <td>
                            ".$lastname."<br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                                Email:
                            <br>
                        </td>
                        <td>
                            ".$email."<br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                                Mobile number:
                            <br>
                        </td>
                        <td>
                            ".$mobile."<br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                                Address:
                            <br>
                        </td>
                        <td>
                            ".$address."<br>
                        </td>
                    </tr>
                    </table></div><br><br>";
                    echo "<div id=a></div><br>";
                    }elseif($k == 2){
                        echo "
                            <div id='customers' class='grid-container'><br><table id='bookingdetail'>
                            <caption>Here's a list of customers with the name:  <h2>". $firstnamearray[0]." ".$lastnamearray[0]."</h2></caption>
                            <tr><th>Username</th><th>Password</th><th>Email</th><th>Mobile</th><th>Address</th></tr>";
                            $i = 0;
                            foreach($firstnamearray as $firstname){
                            echo "<tr>"."<td>". $usernamearray[$i] ."<td>". $passwordarray[$i] ."<td>". $emailsarray[$i] ."<td>". $mobilearray[$i] ."<td>". $addressarray[$i]."<tr>";
                            $i++;
                            }
                        echo "</table></div>";
                        echo "<div id=a></div><br>";
                        $_SESSION['usernamearray'] = $usernamearray;
                        $_SESSION['passwordarray'] = $passwordarray;
                        $_SESSION['firstnamearray'] = $firstnamearray;
                        $_SESSION['lastnamearray'] = $lastnamearray;
                        $_SESSION['emailarray'] = $emailsarray;
                        $_SESSION['mobilearray'] = $mobilearray;
                        $_SESSION['addressarray'] = $addressarray;
                    }
                    ?>

                <table id="bookingdetails" class="grid-container">
                    <caption>Enter any of the items below to find the customer<br></caption>
                    <tr>
                        <th>Note that not all information in this form is required<br></th>
                    </tr>
                    <tr>
                        <form method="post" action="viewcustomers.php">
                            <table>
                                <tr>
                                    <td>
                                        <label>
                                            Username:
                                        </label>
                                    </td>
                                    <td>
                                        <input type="text" name="username" id="usernamea">
                                    </td>
                                </tr>
                                <tr id="search">
                                    <td><label>Click to view a custumer using username</label></td>
                                    <input type="hidden" name="all" value="all" required>
                                    <td><input type="submit" name="searchperson" value="Search" required><br></td>
                                </tr>
                            </table>
                        </form><br>
                    </tr>
                    <tr>
                        <form method="post" action="viewcustomers.php">
                            <table>
                                <tr>
                                    <td>
                                        <label>
                                First name:
                                        </label>
                                    </td>
                                    <td>
                                        <input type="text" name="firstname" min="2">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>
                                            Last name:
                                        </label>
                                    </td>
                                    <td>
                                        <input type="text" name="lastname">
                                    </td>
                                </tr>
                                <tr id="search">
                                    <td><label>Click to view all custumers with these names</label></td>
                                    <input type="hidden" name="all" value="all" required>
                                    <td><input type="submit" name="searchperson" value="Search" required><br></td>
                                </tr>
                            </table>
                        </form><br>
                    </tr>
                    <tr>
                        <form method="post" action="viewcustomers.php">
                            <table>
                                <tr>
                                    <td>
                                        <label>
                                            Email:
                                        </label>
                                    </td>
                                    <td>
                                        <input type="email" name="email">
                                    </td>
                                </tr>
                                <tr id="search">
                                    <td><label>Click to view a custumer using email</label></td>
                                    <input type="hidden" name="all" value="all" required>
                                    <td><input type="submit" name="searchperson" value="Search" required><br></td>
                                </tr>
                            </table>
                        </form>
                    </tr>
                    <tr></tr>

                </table>
            </div>

        </div>
    </section>
</main>






</body>
</html>