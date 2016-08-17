<!DOCTYPE html>
<html lang="en">
<?php include ("db_connection.php"); ?>
<?php
session_start();
if(is_null($_SESSION['facili']) && is_null($_SESSION['start'])){
    header('location: index.php');
};
?>
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
<head>
    <meta charset="UTF-8">
    <title>Samphire Subsea Facilities Booking</title>
</head>
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
            <li><a href='showbugs.php?bugcategory=android'>Manage Booking</a></li>
            <li><a href='showbugs.php?bugcategory=ios'>Contact Us</a></li>
            <li><a href='showbugs.php?bugcategory=windows'>Register</a></li>
        </ul>
    </nav>
</header>

<div id="system">
    <main class="grid-container">

    <div id="syscon">

        <div id="biglogin">
            <table id="biglogintable">
                <tr>
                    <td>
                        <table id="innerlogintable">
                            <tr>
                                <td>
                                    <p>If you have a username and password please login</p>
                                </td>
                            </tr>
                            <tr>
                                <form method="post" action="latelogin.php">
                                    <table>
                                        <tr>
                                            <td>
                                                Username:
                                            </td>
                                            <td>
                                                <input type="text" name="bigusername" id="bigusername" placeholder="Username..." required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Password:
                                            </td>
                                            <td>
                                                <input type="password" name="bigpassword" id="bigpassword" placeholder="password..." required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <input type="submit" name="login" value="Login">
                                        </tr>
                                    </table>
                                </form>
                            </tr>
                        </table>
                    </td>
                    <td>

                    </td>
                </tr>
            </table>
        </div>

    </div>

</main>
</div>
<nav id="outnav">
    <ul>
        <li><a href='index.php'>Create Booking</a></li>
        <li><a href='showbugs.php?bugcategory=android'>Manage Booking</a></li>
        <li><a href='showbugs.php?bugcategory=ios'>Contact Us</a></li>
        <li><a href='showbugs.php?bugcategory=windows'>Register</a></li>
    </ul>
</nav>
</body>
</html>
