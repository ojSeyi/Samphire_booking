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

if(isset($_POST['username'])){
    $username = $_POST['username'];
    $query = "SELECT * FROM customer_login WHERE username = '$username'";
    $run = mysqli_query($db, $query);
    $fetch = mysqli_fetch_array($run);
    $logid = $fetch['log_id'];
    $query2 = "SELECT * FROM customers WHERE log_id = '$logid'";
    $run2 = mysqli_query($db, $query);
    $fetch2 = mysqli_fetch_array($run2);
    $firstname = $fetch2['firstname'];
    $lastname = $fetch2['lastname'];
    $email = $fetch2['email'];
    $mobile = $fetch2['mobile'];
    $address = $fetch2['address'];

}elseif(isset($_POST['firstname'])){
    $firstname = $_POST['firstname'];
    $query = "SELECT * FROM customers WHERE firstname = '$firstname'";
    $run = mysqli_query($db, $query);
    $fetch = mysqli_fetch_array($run);

}elseif(isset($_POST['lastname'])){
    $lastname = $_POST['lastname'];
    $query = "SELECT * FROM customers WHERE lastname = '$lastname'";
    $run = mysqli_query($db, $query);
    $fetch = mysqli_fetch_array($run);

}elseif(isset($_POST['email'])) {
    $email = $_POST['email'];
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
    $fetch = mysqli_fetch_array($run2);
    $username = $fetch2['username'];
    $password = $fetch2['password'];
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
                        <table id='bookingdetails' class='grid-container'>
                        <tr>
                        <td>
                                Username:
                            <br><br>
                        </td>
                        <td>
                            ".$username."<br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                                Password:
                            <br><br>
                        </td>
                        <td>
                            ".$password."<br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                                First name:
                            <br><br>
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
                    </table><br><br>";}else{

                    }
                    ?>
                <form method="post" action="viewcustomers.php">
                <table id="bookingdetails" class="grid-container">
                    <caption>Enter any of the items below to find the customer<br></caption>
                    <tr>
                        <th>Note that not all information in this form is required<br></th>
                    </tr>
                    <tr>
                        <td>
                            <label for="usernamecheck">
                                Username:
                            </label>
                        </td>
                        <td>
                            <input type="text" name="username" id="usernamea">
                        </td>
                        <td>
                            <div id="usernamecheck"></div>
                        </td>
                    </tr>
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
                    <tr>
                        <td>
                            <label for="emailcheck">
                                Email:
                            </label>
                        </td>
                        <td>
                            <input type="email" name="email" id="emaila">
                        </td>
                        <td>
                            <div id="emailcheck"></div>
                        </td>
                    </tr>
                    <tr id="search">
                        <td><label>Click to view All Customers</label></td>
                        <td><input type="hidden" name="all" value="all" required><br></td>
                        <td><input type="submit" name="searchperson" value="Search" required><br></td>

                    </tr>

                </table>
                </form>
            </div>

        </div>
    </section>
</main>






</body>
</html>