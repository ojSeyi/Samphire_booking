<?php
session_start();
include ("db_connection.php");
if(is_null($_SESSION['login'])){
    header('Location: index.php');
};
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

<?php include ("db_connection.php"); ?>
<?php session_start();
if(isset($_SESSION['login'])){
    header('Location: home1.php');
}; ?>

<body>

<header class="grid-container">
    <img src="assets/images/logo_2016.jpg" id="logo"/>
    <div id="log">
        <div id="form">
            <form method="post" action="login.php">
                <input type="text" name="username" id="usernamebox" placeholder="Username" required/>
                <input type="password" name="password" id="passwordbox" placeholder="Password" required/>
                <input type="submit" value="Login" name="login" id="loginb"/>
            </form>
        </div>
        <div id="pagetitle"><h4>Samphire-Subsea</h4><p>Facilities Booking System</p></div>
    </div>
    <nav id="upnav" class="grid-container">
        <ul>
            <li><a href='index.php'>Create Booking</a></li>
            <li><a href='locatebooking.php'>Manage Booking</a></li>
            <li><a href='contactus.php'>Contact Us</a></li>
            <li><a href='registration.php'>Register</a></li>
        </ul>
    </nav>
</header>


<div id="system">
    <main class="grid-container">
        <h1>Welcome to Samphire-Subsea Facility Booking</h1>
        <div id="syscon">
            <form>
            <table id="registration" class="grid-container">
                <caption>Please enter all your correct details below to Register</caption>
                <tr>
                    <td>
                        <labe>

                        </labe>
                    </td>
                    <td>

                    </td>
                    <td>
                        <div id="usernamecheck"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <labe>

                        </labe>
                    </td>
                    <td>

                    </td>
                    <td>
                        <div id="passwordcheck"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <labe>

                        </labe>
                    </td>
                    <td>

                    </td>
                </tr>
                <tr>
                    <td>
                        <labe>

                        </labe>
                    </td>
                    <td>

                    </td>
                </tr>
                <tr>
                    <td>
                        <labe>

                        </labe>
                    </td>
                    <td>

                    </td>
                </tr>
                <tr>
                    <td>
                        <labe>

                        </labe>
                    </td>
                    <td>

                    </td>
                </tr>
                <tr>
                    <td>
                        <labe>

                        </labe>
                    </td>
                    <td>

                    </td>
                </tr>
                <tr>
                    <td>
                        <labe>

                        </labe>
                    </td>
                    <td>

                    </td>
                </tr>
                <tr>
                    <td>
                        <labe>

                        </labe>
                    </td>
                    <td>

                    </td>
                </tr>
            </table>
            </form>
            <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
            <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
            <script type="text/javascript" src="JS/global.js"></script>
        </div>

    </main>
</div>

</body>
</html>

$fetchbookings = mysqli_query($db, $bookingcommand);
if(mysqli_num_rows($fetchbookings) > 0){
while ($ross = mysqli_fetch_array($fetchbookings, MYSQLI_ASSOC)) {
$facilities[] =  $ross['f_id'];
}
}else{

}