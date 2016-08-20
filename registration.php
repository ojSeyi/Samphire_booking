<?php
session_start();
include ("db_connection.php");
if(isset($_SESSION['login'])){
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
            <div id="registrationdiv">
            <form method="post" action="processregistration.php">
            <table id="registration" class="grid-container">
                <caption>Please enter all your correct details below to Register<br></caption>
                <tr>
                    <th>Note that all information on this form is required<br></th>
                </tr>
                <tr>
                    <td>
                        <labe>
                            Username:
                        </labe><br>
                    </td>
                    <td>
                        <input type="text" name="username" required><br>
                    </td>
                    <td>
                        <div id="usernamecheck"></div><br>
                    </td>
                </tr>
                <tr>
                    <td>
                        <labe>
                            Password:
                        </labe><br>
                    </td>
                    <td>
                        <input type="password" name="password" required><br>
                    </td>
                    <td>
                        <div id="passwordcheck"></div><br>
                    </td>
                </tr>
                <tr>
                    <td>
                        <labe>
                            First name:
                        </labe><br>
                    </td>
                    <td>
                        <input type="text" name="firstname" required><br>
                    </td>
                </tr>
                <tr>
                    <td>
                        <labe>
                            Last name:
                        </labe><br>
                    </td>
                    <td>
                        <input type="text" name="lastname" required><br>
                    </td>
                </tr>
                <tr>
                    <td>
                        <labe>
                            Email:
                        </labe><br>
                    </td>
                    <td>
                        <input type="text" name="email" required><br>
                    </td>
                </tr>
                <tr>
                    <td>
                        <labe>
                            Mobile number:
                        </labe><br>
                    </td>
                    <td>
                        <input type="tel" name="number" required><br>
                    </td>
                </tr>
                <tr>
                    <td>
                        <labe>
                            Address:
                        </labe><br>
                    </td>
                    <td>
                        <input type="text" name="address" required><br>
                    </td>
                </tr>
                <tr>
                    <td>
                        <labe>
                            Join us ------->
                        </labe><br>
                    </td>
                    <td>
                        <input type="submit" name="register" value="register" required><br>
                    </td>
                </tr>
            </table>
            </form>
            </div>
            <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
            <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
            <script type="text/javascript" src="JS/global.js"></script>
        </div>

    </main>
</div>

</body>
</html>
