<?php
session_start();
include ('db_connection.php');
if(isset($_SESSION['admin'])){
    header('location: admin.php');
}

if(isset($_POST['bigusername'])){
    $username = $_POST['bigusername'];
    $password = $_POST['bigpassword'];
    $username = stripcslashes($username);
    $password = stripcslashes($password);
    $username = mysqli_real_escape_string($db, $username);
    $password = mysqli_real_escape_string($db, $password);

    $login = $_POST['login'];
    $_SESSION['admin'] = $login;

    $login = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($db, $login) or die("Invalid Query");
    if (mysqli_num_rows($result) == 1) {
        $_SESSION['firstname'] = $username;
        header('Location: admin.php');
    } else {
        header('Location: adminlogin.php');
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
<body class="grid-container">
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
</header
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
    <div id="login" class="grid-container">
        <form method="post" action="adminlogin.php">
            <table>
                <tr>
                    <label>Please enter a valid username and password</label><br><br>
                </tr>
                <tr>
                    <td>
                        <label>Username: </label>
                    </td>
                    <td>
                        <input type="text" name="bigusername" id="bigusername" placeholder="Username..." required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Password: </label>
                    </td>
                    <td>
                        <input type="password" name="bigpassword" id="bigpassword" placeholder="password..." required><br>
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" name="login" value="Login"></td>
                </tr>
            </table>
        </form>
    </div>
    </section>
</main>





</body>
</html>